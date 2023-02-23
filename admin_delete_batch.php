<?php
require("database_connection.php");
if(isset($_POST['delete'])){
  $batch_id=$_POST['batch_id'];
  $query="DELETE FROM batch_details WHERE batch_id='$batch_id'";
  $result=mysqli_query($connection,$query);
  if($result==1){
    header("location:admin_view_batch_details.php?msg=Time Table delete  success'");
  }else{
    header("location:admin_view_batch_details.php");
  }
}



?>