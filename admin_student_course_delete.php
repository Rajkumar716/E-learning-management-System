<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');
//  echo $_SESSION["admingmail"];
if (!isset($_SESSION['admingmail'])) {
    header("location:admin_login.php");
}

if(isset($_POST['course_delete'])){
    echo $course_id=$_POST['course_id'];

    $query="DELETE FROM course WHERE course_id='$course_id'";
    mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection)==1){
        $chek_chat="DELETE FROM chat_user WHERE user_id='$course_id'";
        mysqli_query($connection,$chek_chat);
        header("location:admin_view_student_details.php?msg=Course Details Delete Success.......");

    }elseif(mysqli_affected_rows($connection)==0){
        header("location:admin_view_course_details.php?msg=Delete Faild......");
    }
}

?>