<?php
require_once('database_connection.php');

use PHPMailer\PHPMailer\PHPMailer;

$query = "UPDATE `exam_registration` SET `payment_status` = 'PAID',`Accept`='ACCEPTED' WHERE `exam_registration`.`reg_id` ={$_POST['reg_id']}";

mysqli_query($connection, $query);
//    echo  mysqli_affected_rows($connection);
if (mysqli_affected_rows($connection) == 1) {
    header('location:admin_student_exam_form.php?msg=This Studnt Exam registration Payment Successfull And Accepted........');
    $query1="SELECT * FROM exam_registration where reg_id='$_POST[reg_id]'";
    $result=mysqli_query($connection,$query1);
    while($row=mysqli_fetch_assoc($result)){
        $email=$row['student_email'];
        $_SESSION['student_email']=$email;
        $register_id=$row['reg_id'];
        $_SESSION['reg_id']=$register_id;
        $course_name=$row["course_name"];
        $_SESSION['course_name']=$course_name;
        $batch_number=$row['batch_number'];
        $_SESSION['batch_number']=$batch_number;

        $semester=$row['semester'];
        $_SESSION['semester']=$semester;
        $status=$row['Accept'];
        $_SESSION['Accept']=$status;
    }
    if(isset($_SESSION['student_email'])){
      $email=$_SESSION['student_email'];
      $subject='YOUR Exam Registration For The Course';
      $register_id=$_SESSION['reg_id'];
      $course_name=$_SESSION['course_name'];
      $semester=$_SESSION['semester'];
      $batch_number=$_SESSION['batch_number'];
      $status=$_SESSION['Accept'];
    
      require_once "PHPMailer/PHPMailer.php";
      require_once "PHPMailer/SMTP.php";
      require_once "PHPMailer/Exception.php";
  
  
      $mail=new PHPMailer();
  
  
          //smtp setting
  
      $mail->isSMTP();
      $mail->Host="smtp.gmail.com";
      $mail->SMTPAuth = true;
      $mail->Username ="TanElms12@gmail.com";
      $mail->Password ="kxjqcyxycdbkeyte";
      $mail->Port=587;
      $mail->SMTPSecure ='tsl';
  
  
  
      //email setting
      $mail->isHTML(true);
      $mail->setFrom($email,"E_LEARNING MANAGEMENT SYSTEM");
      $mail->addAddress($_SESSION['student_email']);
      $mail->Subject=(($subject));
      $mail->Body =nl2br("Your Course Exam Registtration Details \r\n Course Name is: ".$course_name."\r\n"." batch Number: ".$batch_number."\r\n"." Exam Register Id: ".$register_id."\r\n"." Semester :".$semester."\r\n"."Exam Approve Status: ".$status);
  
      if($mail->send()){
          $status="success";
          $response="Email is sent";
      }else{
          $status="failed";
          $response="somthing went wrong: </br>".$mail->$Errorinfo;
      }
      exit(json_encode(array("status"=>$status, "response"=>$response)));
  
}else{
    header('location:admin_student_exam_form.php?msg=This Studnt Exam registration Payment Already Successfull Paid And Accepted........'); 
}
}
