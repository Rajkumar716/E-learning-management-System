<?php
 if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION['admingmail'])){
     header("location:admin_dashboard.php");
}

print_r($_POST);

     if(isset($_POST['admin_email'] ) && !empty($_POST['admin_email'] && isset($_POST['admin_password']) && !empty($_POST['admin_password']))){
        require_once('database_connection.php')  ;
         $gmail=$_POST['admin_email'];
         $password=sha1($_POST['admin_password']) ;
         $res=mysqli_query($connection,"select * from admin_registration where admin_email='$gmail' && admin_password='$password' ");
         $count=mysqli_num_rows($res);
         if($count==0){
            
            $error[]="Your password or Email is Wrong.";
            $_SESSION['data_error']=$error;
            header("location:admin_login.php");
         }else{
            $res=mysqli_query($connection,"select * from admin_registration where admin_status='Activate'");
            $count=mysqli_num_rows($res);
            
            if($count==0){
               
               $error[]="Your Account was De-Activate";
               $_SESSION['data_error']=$error;
               header("location:admin_login.php");
            }else{
               $_SESSION["admingmail"]=$gmail;
               header('location:admin_student_register.php');
            }
         }
     }else{
         echo "gmail and password should not be empty .";
         $error[]="gmail and password should not be empty .";
         $_SESSION['data_error']=$error;
         header("location:admin_login.php");
     }
?>