<?php
session_start();
require("database_connection.php");

if(isset($_POST['change'])){
    $professor_id=$_POST['prof_id'];
    $new_password=sha1($_POST['new_password']);
    $prof_email=$_POST['prof_username'];

    $query="SELECT * FROM `professor_registration`";
    $res=mysqli_query($connection,$query);             
    while($row=mysqli_fetch_array($res)){
        $prof_id=$row['prof_id'];
        $_SESSION['prof_id']=$prof_id;
        $prof_gmail=$row['prof_email'];
        $_SESSION['prof_email']=$prof_gmail;
       


    }
    if($professor_id ==$prof_id && $prof_email==$prof_gmail){
        $query="UPDATE professor_registration SET prof_password='$new_password' WHERE prof_id='$professor_id' AND prof_email='$prof_email'";
        mysqli_query($connection,$query);
        if(mysqli_affected_rows($connection)==1){
         header("location:prof_login.php?msg=Your Password Reset Successfully..........");
        }else{
            header("location:prof_login.php?msg=Your Password Reset Fails..........");
        }
 
    }else{
       header("location:prof_forget_password.php?error=Your User Name OR Id Wrong.........");
    }
}


?>