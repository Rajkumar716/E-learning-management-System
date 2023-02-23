<?php
session_start();
require("database_connection.php");

if(isset($_POST['send_notification'])){
    $reciever_id=$_POST['reciever_id'];
    $reciever_status=$_POST['reciever_status'];
   $message=$_POST['message'];
    $send_date=date('Y-m-d');
   $prof_name=$_SESSION['prof_fullname'];
   $prof_id=$_SESSION['prof_id'];

    $sql="INSERT INTO notification(sender_id,sender_name,sender_status,reciever_id,reciever_status,message,send_date,read_status) VALUES('$prof_id','$prof_name','professor','$reciever_id','$reciever_status','$message','$send_date','No')";
    $result=mysqli_query($connection,$sql);
    if($result==1){
      header("location:prof_view_send_notification.php");
    }else{
      header("location:prof_send_notification.php");
    }


}

?>