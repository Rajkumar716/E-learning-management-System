<?php
session_start();
require_once("database_connection.php");

if(isset($_POST['grade'])){
 $subject_id=$_SESSION['subject_id'];
 $subject_name=$_SESSION['subject_name'];
 $course_name=$_SESSION['course_name'];
 $student_id=$_SESSION['student_course_id'];
 $file_name=$_SESSION['file'];
 $deadline=$_SESSION['deadline_date'];
 $submit_date=$_SESSION['submit_date'];
 echo $grade=$_POST['assign_grade'];
 

$query="UPDATE course_subject_assignments SET grade='$grade' WHERE subject_id='$subject_id' AND student_course_id='$student_id'";
mysqli_query($connection,$query);
if(mysqli_affected_rows($connection)==1){
   header("location:prof_view_student_upload.php");
}elseif(mysqli_affected_rows($connection)==0){
   header("location:prof_assignment_grade.php");
}






}


?>