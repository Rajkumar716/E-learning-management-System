<?php
 if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once("database_connection.php" );

print_r($_POST);
echo "<hr>";
$mandortry=['subject_id','subject_name','deadline_date','course_name'];
$register_error=[];
$form_error=[];
foreach($mandortry as $mandortries){
    echo $_POST[$mandortries]."<hr>";
    
    if(empty($_POST[$mandortries])){
          $register_error[]=$mandortries." fields required .";
    }else {
        $form_error[$mandortries]=$_POST[$mandortries];
    }
}
if(count($register_error)>0){
    if(count($form_error)>0){
        $_SESSION['form_data']=$form_error;
    }
      $_SESSION['data_error']=$register_error;
      header('location:admin_assignment_upload_set.php');
}
if(count($register_error)==0){
    // echo "no error found .";
   
        $subjectid=$_POST['subject_id'];
        $subjectname=$_POST['subject_name'];
        $deadline_date=$_POST['deadline_date'];
        $course_name=$_POST['course_name'];
        $course_year=$_POST['course_year'];
        $course_batch=$_POST['course_batch'];

        $check="SELECT * FROM course_assignment_set WHERE subject_id='$subjectid' AND course_name='$course_name' AND batch_year='$course_year' AND batch_number='$course_batch'";
        mysqli_query($connection,$check);
        if(mysqli_affected_rows($connection)==1){
                  $register_error[]="This specific Id Subject Assignment Already set for this years Course Batch.....";
                   $_SESSION['data_error']=$register_error;
                   header('location:admin_assignment_upload_set.php'); 
        }else{

            $query="INSERT INTO `course_assignment_set`(`subject_id`,`batch_year`,`batch_number`,`subject_name`,`course_name`,`deadline_date`) 
            VALUES ('$subjectid','$course_year','$course_batch','$subjectname','$course_name','$deadline_date')";
             mysqli_query($connection,$query);
             if(mysqli_affected_rows($connection)==1){
                 echo "account created success";
                 header('location:admin_assignment_upload_set.php?msg=Assignment Upload Set Successfully');
                 

  

                 
             }else{
                 echo "Assignment Set fails";
                 $register_error[]="ssignment Set fails.";
                   $_SESSION['data_error']=$register_error;
                   header('location:admin_assignment_upload_set.php');
             }

        }
           
        
        
        
        
   
}else{
    print_r($register_error);
}
?>