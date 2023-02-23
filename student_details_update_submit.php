<?php
session_start();
require_once('database_connection.php');
$student_id= $_SESSION['student_id'];
$student_name=$_POST['student_name'];


                            
$student_dob= $_POST['student_dob'];
                           
$student_address=$_POST['student_address'];
                           
$student_number=$_POST['student_number'];
$phone_number=(int)$student_number;                         
if(isset($_POST['update_details'])){
                              
                           
    $query="UPDATE student_registration SET student_fullname='$student_name',student_address='$student_address',student_phonenumber='$phone_number',student_dob='$student_dob' WHERE student_id='$student_id'";
                          
    mysqli_query($connection,$query);
                         
    if(mysqli_affected_rows($connection)==1){
        $query1="UPDATE course SET student_name='$student_name' WHERE student_id='$student_id'";
        mysqli_query($connection,$query1);
      
            
           
           
        header("location:student_view_details.php?msg=Your Details Update Successfully........");           
                           
    }elseif(mysqli_affected_rows($connection)==0){
         header("location:student_view_details.php?msg=Your Details Already Up to Date........");                     
                         
    }
                            

                          
}
                          
                          
?>