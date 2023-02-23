<?php
session_start();
require("database_connection.php");
if(isset($_POST['upload'])){
    $subjectid=$_SESSION['subject_id'];
    $subjectname=$_SESSION['subject_name'];
     $deadlinedate=$_SESSION["deadline_date"];
     $course_name=$_SESSION['course_name'];
     
    $courseid=$_SESSION['course_id'];
    $submission_date=date("Y-m-d");
    $location="uploads/";
    $file_new_name=date("dmy").time().$_FILES['file']['name'];
    $file_name=$_FILES['file']['name'];
    $file_temp=$_FILES['file']['tmp_name'];
    $file_size=$_FILES['file']['size'];

    if($file_size>31457280){
        echo "<script>alert('file size is too large')</script>";
        header("location:student_upload_assignment.php");
         }else{
            $select="SELECT * FROM `course_subject_assignments` WHERE student_course_id='$courseid' AND subject_id='$subjectid'";
            mysqli_query($connection,$select);
            if(mysqli_affected_rows($connection)==1){
                $query1="UPDATE course_subject_assignments SET subject_name='$subjectname',course_name='$course_name',file='$file_name',new_file='$file_new_name',deadline_date='$deadlinedate',status='Submitted',submit_date='$submission_date' WHERE subject_id='$subjectid' AND student_course_id='$courseid'";
                mysqli_query($connection,$query1);
                if(mysqli_affected_rows($connection)==1){
                    move_uploaded_file($file_temp,$location.$file_new_name);
                    header('location:student_view_upload_assignment.php?msg=Assignment Upload Successfully...');
                }
                elseif(mysqli_affected_rows($connection)==0){
                    header('location:student_upload_assignment.php?msg=Assignment Upload Failed...');
                
                   }
            }else{

                $query="INSERT INTO `course_subject_assignments`(`subject_id`,`subject_name`,`course_name`,`student_course_id`,`file`,`new_file`,`deadline_date`,`status` ,`submit_date`) 
                VALUES('$subjectid','$subjectname','$course_name','$courseid','$file_name','$file_new_name','$deadlinedate','Submitted','$submission_date')";
       
               $result= mysqli_query($connection,$query);
                
               if($result==1){
                   
                   move_uploaded_file($file_temp,$location.$file_new_name);
                                                
                  
                   header('location:student_view_upload_assignment.php?msg=Assignment Upload Successfully...');
    
            
               }elseif($result==0){
                header('location:student_upload_assignment.php?msg=Assignment Upload Failed...');
            
               }
            }


            
            

        
     }

}


?>