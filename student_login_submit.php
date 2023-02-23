<?php
 if(session_status()==PHP_SESSION_NONE){
    session_start();
}

// if(isset($_SESSION['admingmail'])){
//      header("location:admin_dashboard.php");
// }

print_r($_POST);

     if(isset($_POST['student_email'] ) && !empty($_POST['student_email'] && isset($_POST['student_password']) && !empty($_POST['student_password']))){
        require_once('database_connection.php')  ;
         $gmail=$_POST['student_email'];
         $password=sha1($_POST['student_password']) ;
         $res=mysqli_query($connection,"select * from course where curse_login_username='$gmail' && login_password='$password' ");
         $count=mysqli_num_rows($res);
         if($count==0){
            
            $error[]="Your password or Email is Wrong.";
            $_SESSION['data_error']=$error;
            header("location:student_login.php");
         }else{
            $res=mysqli_query($connection,"select * from course where course_status='Activate'");
            $count=mysqli_num_rows($res);
            
            if($count==0){
               
               $error[]="Your Account was De-Activate";
               $_SESSION['data_error']=$error;
               header("location:student_login.php");
            }else{
               $_SESSION["coursegmail"]=$gmail;
               header('location:student_view_details.php');
            }
         }
     }else{
         echo "gmail and password should not be empty .";
         $error[]="gmail and password should not be empty .";
         $_SESSION['data_error']=$error;
         header("location:student_login.php");
     }
?>