<?php
session_start();
require('database_connection.php');
if (isset($_POST['create'])) {
  $user_id = $_POST['user_id'];
  $user_name = $_POST['user_name'];

  $query = "SELECT * FROM course WHERE course_id='$user_id'";
  mysqli_query($connection, $query);
  if (mysqli_affected_rows($connection) == 1) {
    $query1 = "SELECT * FROM course WHERE curse_login_username='$user_name'";
    mysqli_query($connection, $query1);
    if (mysqli_affected_rows($connection) == 1) {
      $today_date = date("Y-m-d H:m:s");
      $login_as = "student";
      $sql = "INSERT INTO chat_user (chat_id,user_id,user_name,login_as,login_status,last_login) VALUES('NULL','$user_id','$user_name','$login_as','0','$today_date')";
      $result = mysqli_query($connection, $sql);
      if ($result == 1) {
        header("location:student_join_chat.php?msg=Chat Account Created SuccessFully......");
      } else {
        header("location:student_chat_reg.php?alert=Chat Account not Created.........");
      }
    } else {
      header("location:student_chat_reg.php?infro=There is no Name Registered....");
    }
  } else {
    header("location:student_chat_reg.php?infro=There is no ID Registered....");
  }
}
