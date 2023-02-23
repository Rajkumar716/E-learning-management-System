<?php
require_once('database_connection.php');

if(isset($_POST['set_status']) && !empty($_POST['set_status'])){
    $query="UPDATE `batch_details` SET `batch_status` = '{$_POST['set_status']}' WHERE `batch_details`.`batch_id` ={$_POST['batch_id']}";
   
    mysqli_query($connection,$query);
//    echo  mysqli_affected_rows($connection);
   if(mysqli_affected_rows($connection)==1){
       header('location:admin_view_batch_details.php?msg=status update successful');

   }elseif(mysqli_affected_rows($connection)==0){
    header('location:admin_view_batch_details.php?msg=status is up-to-date');

   }
}


?>