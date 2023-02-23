<?php
session_start();
require("database_connection.php");

if(isset($_POST['register'])){
  echo  $subject_id=$_POST['subject_id'];
  echo  $semester=$_POST['semester'];
 echo $student_course_id=$_SESSION['course_id'];
 echo $student_email=$_SESSION['student_email'];
 echo $course_name=$_SESSION['course_name'];
 echo $batch_number=$_SESSION['course_batch'];
 $register_date=date("Y-m-d");
$check="SELECT * FROM exam_registration WHERE student_course_id='$student_course_id' AND semester='$semester' AND course_name='$course_name'  ";
mysqli_query($connection,$check);
if(mysqli_affected_rows($connection)==1){
 header("location:student_exam_register.php?danger=You are Already Request for this Exam Registration.......");
}else{
  $sql="INSERT INTO exam_registration(student_course_id,student_email,course_name,batch_number,exam_subject_id,semester,registation_date,payment_status,Accept) 
  VALUES('$student_course_id','$student_email','$course_name','$batch_number','$subject_id','$semester','$register_date','Pending','Pending')";
  $result=mysqli_query($connection,$sql);
  if($result==1){
    header("location:student_exam_register.php?msg=Examination Registration Successfully..........");
  }else{
    header("location:student_exam_register.php?danger=Examination Registration Failed......");
  }

}

 
    
}


?>