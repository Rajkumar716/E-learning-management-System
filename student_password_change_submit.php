<?php
session_start();
require_once('database_connection.php');
 if(isset($_POST['pass_update'])){
    $course_id=$_POST['course_id'];
    $old_password=$_POST['course_old_password'];
    $new_password=$_POST['course_new_password'];
    $confirm_password=$_POST['new_password_confirm'];

    $sql="SELECT * FROM `course`";
    $result=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_array($result)){
        $courseid=$row['course_id'];
        $_SESSION['course_id']=$courseid;
        $login_pass=$row['login_password'];
        $_SESSION['login_password']=$login_pass;

    }
    if($_SESSION['course_id']==$course_id){

        if($_SESSION['login_password']==sha1($old_password)){
            if($new_password==$confirm_password){
                $enter_password=sha1($confirm_password);
                $query="UPDATE course SET login_password='$enter_password' WHERE course_id='$course_id'";
                mysqli_query($connection,$query);
                if(mysqli_affected_rows($connection)==1){
                    header("location:student_login.php?msg=Your new Password Updated");

                }elseif(mysqli_affected_rows($connection)==0){
                     header("location:student_elms_password_change?msg=password not changed try again");

                }
            }else{
                header("location:student_elms_password_change.php?msg=Confirm password not match");
            }

        }else{
            header("location:student_elms_password_change.php?msg=old password not match");
        }

    }else{
        header("location:student_elms_password_change.php?msg=course id not match");
    }

}


?>