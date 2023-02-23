<?php
require("database_connection.php");
if(isset($_POST['delete'])){
  $tableid=$_POST['table_id'];
  $query="DELETE FROM time_table WHERE table_id='$tableid'";
  $result=mysqli_query($connection,$query);
  if($result==1){
    header("location:admin_add_timetable.php?msg=Time Table delete  success'");
  }else{
    header("location:admin_add_timetable.php");
  }
}



?>