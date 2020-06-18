<?php
if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include '_dbconnect.php';
    $email = $_POST['uemail'];
    $pass = $_POST['upass'];
    

    $sql = "SELECT * FROM `users` WHERE u_email='$email'";
    $result = mysqli_query($conn,$sql);

    $numRows = mysqli_num_rows($result);
    if($numRows==1)
    {
     $row = mysqli_fetch_assoc($result);
     $fname = $row['u_fname'];
     $lname = $row['u_lname'];
     $id = $row['sno'];

         if(password_verify($pass, $row['u_pass']))
         {
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['ufname']=$fname;
          $_SESSION['ulname']=$lname;
          $_SESSION['id']=$id;
          header("Location: /forum/index.php?loginsuccess=true");
         }
         else{
           header("Location: /forum/index.php?loginsuccess=false");

         }
       
     }
    

}



?>