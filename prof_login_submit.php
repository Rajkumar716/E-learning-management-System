<?php
 if(session_status()==PHP_SESSION_NONE){
    session_start();
}

// if(isset($_SESSION['admingmail'])){
//      header("location:admin_dashboard.php");
// }

print_r($_POST);

     if(isset($_POST['prof_email'] ) && !empty($_POST['prof_email'] && isset($_POST['prof_password']) && !empty($_POST['prof_password']))){
        require_once('database_connection.php')  ;
         $gmail=$_POST['prof_email'];
         $password=sha1($_POST['prof_password']) ;
         $res=mysqli_query($connection,"select * from professor_registration where 	prof_email='$gmail' && prof_password='$password' ");
         $count=mysqli_num_rows($res);
         if($count==0){
            
            $error[]="Your password or Email is Wrong.";
            $_SESSION['data_error']=$error;
            header("location:prof_login.php");
         }else{
            $res=mysqli_query($connection,"select * from professor_registration where prof_status='Activate'");
            $count=mysqli_num_rows($res);
            
            if($count==0){
               
               $error[]="Your Account was De-Activate";
               $_SESSION['data_error']=$error;
               header("location:prof_login.php");
            }else{
               $_SESSION["prof_gmail"]=$gmail;
               header('location:prof_view_details.php');
            }
         }
     }else{
         echo "gmail and password should not be empty .";
         $error[]="gmail and password should not be empty .";
         $_SESSION['data_error']=$error;
         header("location:prof_login.php");
     }
?>