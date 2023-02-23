<?php
session_start();
require_once('database_connection.php');
$prof_id= $_SESSION['prof_id'];
$prof_name=$_POST['prof_name'];

$prof_gmail=$_POST['prof_email'];
                            
$prof_dob= $_POST['prof_dob'];
                           
$prof_address=$_POST['prof_address'];
                           
$prof_number=$_POST['prof_number'];
                           
if(isset($_POST['update_details'])){
                              
                           
    $query="UPDATE professor_registration SET prof_fullname='$prof_name',prof_address='$prof_address',prof_phone='$prof_number',prof_dob='$prof_dob' WHERE prof_id='$prof_id'";
                          
    mysqli_query($connection,$query);
                         
    if(mysqli_affected_rows($connection)==1){
        $check_chat="UPDATE chat_user SET user_name='$prof_name' WHERE user_id='$prof_id'";
        mysqli_query($connection,$check_chat);
                               
        header("location:prof_view_details.php?msg=Your Details Update Successfully.........");


                           
    }elseif(mysqli_affected_rows($connection)==0){
                              
        header("location:prof_view_details.php?msg=Your Details Already Up To Date........");              
    }
                            

                          
}
                          
                          
?>