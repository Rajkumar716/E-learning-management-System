<?php
session_start();
require("database_connection.php");

if(isset($_POST['add_table'])){
    $course_name=$_POST['course_name'];
    $batch_name=$_POST['batch_name'];
    $subject_name=$_POST['subject_name'];
    $prof_name=$_SESSION['prof_fullname'];
    $course_year=$_POST['course_year'];
    $date=$_POST['date'];
    $start_time=$_POST['start_time'];
    $end_time=$_POST['end_time'];
    
    $query1="SELECT * FROM `time_table` where subject_name='$subject_name' AND prof_name='$prof_name' AND date='$date' AND start_time='$start_time' AND end_time='$end_time' AND course_name=' $course_name' AND batch='$batch_name' AND course_started_year=' $course_year'";
    mysqli_query($connection,$query1);
    if(mysqli_affected_rows($connection)==1){
        header("location:admin_add_timetable_form.php?error=ALREADY ADD THIS TIME SLOT FOR SAME PROFESSOR AND SUBJECT AND START TIME........");

    }else{
        $query="INSERT INTO time_table(course_name,course_started_year,batch,subject_name,prof_name,date,start_time,end_time) 
        VALUES('$course_name','$course_year','$batch_name','$subject_name','$prof_name','$date','$start_time','$end_time')";
        $result=mysqli_query($connection,$query);
        if($result==1){
            header("location:admin_add_timetable.php?msg=New Time Table ADD Successfully........");

        }else{
           header("location:admin_add_timetable_form.php?error=New Time Table Add Failed...........");
        }
    }

   
}







?>