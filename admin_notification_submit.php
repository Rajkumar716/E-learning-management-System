<?php
session_start();
require("database_connection.php");
$_SESSION['admingmail'];
$query = "SELECT * FROM admin_registration WHERE admin_email='$_SESSION[admingmail]'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
   $sender_name = $row['admin_fullname'];
   $_SESSION['admin_fullname'] = $sender_name;
   $sender_id = $row['admin_id'];
   $_SESSION['admin_id'] = $sender_id;
}

if (isset($_POST['send_notification'])) {
   $reciever_id = $_POST['reciever_id'];
   $reciver_status = $_POST['reciever_status'];
   $message = $_POST['message'];
   $send_date = date("Y/m/d");


   $sql = "INSERT INTO notification(sender_id,sender_name,sender_status,reciever_id,reciever_status,message,send_date,read_status) VALUES('$sender_id','$sender_name','admin','$reciever_id','$reciver_status','$message','$send_date','No')";
   $submit = mysqli_query($connection, $sql);
   if ($submit == 1) {
      header("location:admin_send_notification.php?msg=Notification Send Succuessfully....");
   } else {
      header("location:admin_send_notification.php");
   }
}
