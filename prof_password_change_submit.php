<?php
session_start();
require_once('database_connection.php');
 if(isset($_POST['pass_update'])){
    $prof_id=$_POST['prof_id'];
    $old_password=$_POST['course_old_password'];
    $new_password=$_POST['course_new_password'];
    $confirm_password=$_POST['new_password_confirm'];

    $sql="SELECT * FROM `professor_registration`";
    $result=mysqli_query($connection,$sql);
    while($row=mysqli_fetch_array($result)){
        $courseid=$row['prof_id'];
        $_SESSION['prof_id']=$courseid;
        $login_pass=$row['prof_password'];
        $_SESSION['prof_password']=$login_pass;

    }
    if($_SESSION['prof_id']==$prof_id){

        if($_SESSION['prof_password']==sha1($old_password)){
            if($new_password==$confirm_password){
                $enter_password=sha1($confirm_password);
                $query="UPDATE professor_registration SET prof_password='$enter_password' WHERE prof_id='$prof_id'";
                mysqli_query($connection,$query);
                if(mysqli_affected_rows($connection)==1){
                    header("location:prof_login.php?msg=Your new Password Updated");

                }elseif(mysqli_affected_rows($connection)==0){
                     header("location:prof_password_change?msg=password not changed try again");

                }
            }else{
                header("location:prof_password_change.php?msg=Confirm password not match");
            }

        }else{
            header("location:prof_password_change.php?msg=old password not match");
        }

    }else{
        header("location:prof_password_change.php?msg=Id not match");
    }

}


?>