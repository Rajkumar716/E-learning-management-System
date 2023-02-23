<?php

if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once("database_connection.php" );


if(isset($_POST['add_batch'])){
    $course_name=$_POST['course_name'];
    $batch_year=$_POST['course_year'];
    $batch_number=$_POST['course_batch'];
    $seat_count=$_POST['seat_count'];

    $batch_status="De-Activate";
    $seat_count_status="AVAILABLE";



    $check="SELECT * FROM batch_details WHERE batch_number='$batch_number' AND batch_start_year='$batch_year' AND course_name='$course_name'";
    $check_result=mysqli_query($connection,$check);
    if(mysqli_affected_rows($connection)==1){
        header("location:admin_add_batch_details.php?error=Already Create these Details with a Batch...........");
    }else{

        $insert_data="INSERT INTO batch_details (batch_id,batch_number,batch_start_year,course_name,batch_status,seat_count,seat_count_status) VALUES(NULL,'$batch_number','$batch_year','$course_name','$batch_status','$seat_count','$seat_count_status')";
       $check_insert= mysqli_query($connection,$insert_data);
        if($check_insert==1){
            header("location:admin_view_batch_details.php?msg=New Batch Created Successfully.......");
        }else{
            header("location:admin_view_batch_details.php?error=New Batch Created Fails.......");
        }

    }
}

?>