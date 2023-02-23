<?php
require_once('database_connection.php');

if(isset($_POST['set_status']) && !empty($_POST['set_status'])){
    $query="UPDATE `professor_registration` SET `prof_status` = '{$_POST['set_status']}' WHERE `professor_registration`.`prof_id` ={$_POST['prof_id']}";
   
    mysqli_query($connection,$query);
//    echo  mysqli_affected_rows($connection);
   if(mysqli_affected_rows($connection)==1){
       header('location:admin_view_prof_details.php?msg=status update successful');

   }elseif(mysqli_affected_rows($connection)==0){
    header('location:admin_view_prof_details.php?msg=status is up-to-date');

   }
}


?>