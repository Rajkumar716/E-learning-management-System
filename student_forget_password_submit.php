<?php
session_start();
require("database_connection.php");

if(isset($_POST['change'])){
   
    $course_username=$_POST['course_username'];
    $new_password=sha1($_POST['new_password']);
    $course_userid=$_POST['course_userid'];

    $query="SELECT * FROM `course`";
    $res=mysqli_query($connection,$query);             
    while($row=mysqli_fetch_array($res)){
       
        $cour_username=$row['curse_login_username'];
        $_SESSION['curse_login_username']=$cour_username;

        $course_id=$row['course_id'];
        $_SESSION['course_id']=$course_id;


    }
    if($course_username ==$cour_username && $course_userid==$course_id){
        $query="UPDATE course SET login_password='$new_password' WHERE curse_login_username='$course_username' AND course_id='$course_userid'";
        mysqli_query($connection,$query);
        if(mysqli_affected_rows($connection)==1){
            header("location:student_login.php?msg=FOrget Password Reset is Successfull........");
  
        }else{
            header("location:student_forget_password.php?error=FOrget Password Reset is Failed........");
        }
        

    }else{
        header("location:student_forget_password.php?error=Your Course User Name OR User Id Not Match");
    }
}


?>