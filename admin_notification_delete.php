<?php
session_start();
require("database_connection.php");
if(isset($_POST['delete'])){
   echo $notification_id=$_POST['notification_id'];

   $sql="DELETE FROM notification WHERE notification_id='$notification_id'";
   $result=mysqli_query($connection,$sql);
   if($result==1){
    header("location:admin_view_send_notification.php?msg=Delete Successfully");
   }else{
    header("location:admin_view_send_notification.php?error=Delete Successfully");
   }
    
}



?>