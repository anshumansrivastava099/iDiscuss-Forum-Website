<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>iCoding Discuss</title>
</head>

<body>
    <?php include '_dbconnect.php'; ?>
    <?php include '_header.php'; ?>
    <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `threads` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result))
        {
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $thread_user_id = $row['thread_user_id'];
            $sql3 = "SELECT u_fname,u_lname FROM `users` WHERE sno='$thread_user_id' ";
            $result3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($result3);
           
         }
    ?>

    <?php
     $showalert = false;
    
     $method = $_SERVER['REQUEST_METHOD'];
     if($method == 'POST')
     {
         //Insert comment into database
         $comment = $_POST['comment'];
         $comment = str_replace("<","&lt;",$comment);
         $comment = str_replace(">","&gt;",$comment);
         $u_id = $_POST['id'];
        
         $sql = "INSERT INTO `comments` (`comment_content`,`thread_id`,`comment_by`,`comment_time`)
         VALUES ('$comment','$id','$u_id',current_timestamp())";
         $result = mysqli_query($conn, $sql);
         $showalert = true;
         if($showalert)
         {
             echo '
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Success!</strong>Your comment has been added.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             </div>
             ';
         }

     }

   ?>



    <?php
 

    echo '<div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">'.$title.' </h1>
            <p class="lead">'. $desc.'</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p>Posted by: <b>'.$row3['u_fname'].' '.$row3['u_lname'].'</b></p>
        </div>';

        ?>

    <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
   { 
        echo '<div class="container">
            <h1>Post a Comment</h1>

            <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Type your comment...</label>
                    <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                </div>
                <input type="hidden" name="id" value="'.$_SESSION['id'].'">
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>';
   }
   else{
    echo '<div class="container">
    <h1>Post a Comment</h1>
            <p class="lead">You are not logged in. Please login to be able to post a comments  <a href="index.php">Login</a></p>
           
    
    ';
       }
?>


    <div class="container">
        <h1>Discussion</h1>

        <?php
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result))
        {
            $content = $row['comment_content'];
            
            $tid = $row['comment_id'];
            $comment_time = $row['comment_time'];
            $comment_user_id = $row['comment_by'];
            $sql2 = "SELECT u_fname,u_lname FROM `users` WHERE sno='$comment_user_id' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);

        
    

            echo '<div class="media my-3">
                <img src="images/user.png" width="50px" class="mr-3" alt="...">
                <div class="media-body">
                <p class="font-weight-bold my-0">Post by '.$row2['u_fname']. ' '.$row2['u_lname'].' at '. $comment_time .'</p>
                   '.$content.'.
                </div>
            </div>
        ';
        }

        ?>
    </div>
    </div>



    <?php include '_footer.php';?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
</body>

</html>