<?php
$showError = "false";

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    include '_dbconnect.php';
    $username = $_POST['signupemail'];
    $pass = $_POST['signuppassword'];
    $cpass = $_POST['signuppassword2'];
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];



    $exitSql = "SELECT * FROM `users` WHERE u_email='$username'";
    $result = mysqli_query($conn,$exitSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0)
    {
        

        $showError = "Email already in use";
    }
    else{
   

        if($pass == $cpass)
        {
            
           $hash = password_hash($pass, PASSWORD_DEFAULT);
           $sql = "INSERT INTO `users` ( `u_email`, `u_pass`, `u_fname`, `u_lname`) VALUES ('$username', '$hash', '$firstname', '$lastname') ";
           $result2 = mysqli_query($conn,$sql);

           
           if($result2)
           {
          
               $showAlert = true;
               header("Location: /forum/index.php?signupsuccess=true");
               exit();
           }
           
        }
        else{
            $showError = "Passwords do not match";
        }
    }
    header("Location: /forum/index.php?signupsuccess=false&error=$showAlert");


}
?>