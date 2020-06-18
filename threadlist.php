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
    $id = $_GET['catid'];
        $sql = "SELECT * FROM `categories` WHERE category_id=$id";
        $result = mysqli_query($conn, $sql);
        while($row=mysqli_fetch_assoc($result))
        {
            $catname= $row['category_name'];
            $catdesc= $row['category_description'];
        }
    ?>

    <?php
     $showalert = false;
     $method = $_SERVER['REQUEST_METHOD'];
     if($method == 'POST')
     {
         //Insert thread into database
         $th_title = $_POST['title'];
         $th_desc = $_POST['desc'];
         $u_id = $_POST['id'];
         $th_title = str_replace("<","&lt;",$th_title);
         $th_title = str_replace(">","&gt;",$th_title);
         $th_desc = str_replace("<","&gt;",$th_desc);
         $th_desc = str_replace(">","&gt;",$th_desc);
         $sql = "INSERT INTO `threads` (`thread_title`,`thread_desc`,`thread_cat_id`,`thread_user_id`,`time`)
         VALUES ('$th_title','$th_desc','$id','$u_id',current_timestamp())";
         $result = mysqli_query($conn, $sql);
         $showalert = true;
         if($showalert)
         {
             echo '
             <div class="alert alert-warning alert-dismissible fade show" role="alert">
             <strong>Success!</strong>Your thread has been added Please wait for community to response.
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
             </div>
             ';
         }

     }

   ?>



    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname;?> forums</h1>
            <p class="lead"><?php echo $catdesc;?>.</p>
            <hr class="my-4">
            <p>Please maintain the diginity here.Do not abuse other,this forum site is for the use of general purpose.
            </p>
            
        </div>

        <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
   {     
       echo '<div class="container">
            <h1>Start a Discussion</h1>

            <form action="'.$_SERVER["REQUEST_URI"].'" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Problem Title</label>
                    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">keep your title as short and crisp as
                        possible.</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ellaborate your Concern</label>
                    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
                </div>
                <input type="hidden" name="id" value="'.$_SESSION['id'].'">
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>';
   }
   else{
echo '<div class="container">
<h1>Start a Discussion</h1>
        <p class="lead">You are not logged in. Please login to be able to start a discussion <a href="index.php">Login</a></p>

';
   }


        ?>

        <div class="container">
            <h1>Browse Question</h1>

            <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while($row=mysqli_fetch_assoc($result))
        {
            $noResult = false;
            $title = $row['thread_title'];
            $desc = $row['thread_desc'];
            $tid = $row['thread_id'];
            $thread_time = $row['time'];
            $thread_user_id = $row['thread_user_id'];
            $sql2 = "SELECT u_fname,u_lname FROM `users` WHERE sno='$thread_user_id' ";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);


            echo '<div class="media my-3">
                <img src="images/user.png" width="50px" class="mr-3" alt="...">
                <div class="media-body">'.
               '<h5 class="mt-0"><a href="thread.php?threadid='.$tid.'">'.$title.'</a></h5>
                    '.$desc.'.
                </div>'.
               ' <p class="font-weight-bold my-0">Asked by '.$row2['u_fname'].' '.$row2['u_lname'].' at '. $thread_time .'</p>
                    
            </div>';
            echo '<hr>';
        }
        if($noResult)
        {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-5">No Threads Found</p>
              <p class="lead">Be the first person to ask a question.</p>
            </div>
          </div>';
        }

        ?>
        </div>
        </div>
        </div>


          
        <?php include '_footer.php';?>


            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous">
            </script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
                integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
                crossorigin="anonymous">
            </script>
</body>

</html>