<?php
session_start();
require("database_connection.php");

if(isset($_POST['edit_table'])){
    $coursename=$_POST['course_name'];
    $subject_name=$_POST['subject_name'];
    $batch=$_POST['batch_name'];
    $prof_name=$_POST['prof_name'];
    $date=$_POST['date'];
    $starttime=$_POST['start_time'];
    $end_time=$_POST['end_time'];
   $table_id= $_SESSION['table_id'];
   

   $query="UPDATE time_table SET date='$date',start_time='$starttime',end_time='$end_time' WHERE table_id='$table_id'";
   $result=mysqli_query($connection,$query);
   if($result==1){
    header("location:admin_add_timetable.php?msg=table update successfully......");
   }else{
    header("location:admin_add_timetable.php?error=table Update Failed...");
   }

 

}










?>