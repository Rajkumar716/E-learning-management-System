<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');
use PHPMailer\PHPMailer\PHPMailer;
echo $student_id=$_SESSION['student_id'];

if(isset($_POST['update_details'])){
   echo $student_name=$_POST['student_name'];
   echo $student_email=$_POST['student_email'];
   echo $student_dob=$_POST['student_dob'];
   echo $student_address=$_POST['student_address'];
   echo $student_number=$_POST['student_number'];
   echo $student_nic=$_POST['student_nic'];
   echo "</br>";

   $query="UPDATE student_registration SET student_fullname='$student_name',student_email='$student_email',student_dob='$student_dob',
   student_address='$student_address',student_nic='$student_nic',student_phonenumber='$student_number' WHERE student_id='$student_id'";
   mysqli_query($connection,$query);

   $get="SELECT * FROM course WHERE student_id='$student_id'";
          $get_result=mysqli_query($connection,$get);
          while($row=mysqli_fetch_assoc($get_result)){
                $course_id=$row['course_id'];
              echo  $_SESSION['course_id']=$course_id;
          }
                         
   if(mysqli_affected_rows($connection)==1){
          
          $check="UPDATE course SET student_name='$student_name',student_email='$student_email',curse_login_username='$student_email' WHERE student_id='$student_id'";
          mysqli_query($connection,$check);
          
          $check_chat="UPDATE chat_user SET user_name='$student_email' WHERE user_id='$_SESSION[course_id]'";
          mysqli_query($connection,$check_chat);
          header("location:admin_view_student_details.php?msg=Details Update Success.....");

          if (isset($student_email) ) {
            $email = $student_email;
            $subject = 'STUDENT PERSONAL AND COURSE ACCOUNT DETAILS HAS BEEN UPDATED SUCCESSFULLY FOR THE E-LEARNING SYSTEM';
            $persona_email=$student_email;
            $course_username=$student_email;
            $name = $student_name;
            

            $loginusername = $_SESSION['student_email'];


            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";


            $mail = new PHPMailer();


            //smtp setting

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "TanElms12@gmail.com";
            $mail->Password = "kxjqcyxycdbkeyte";
            $mail->Port = 587;
            $mail->SMTPSecure = 'tsl';



            //email setting
            $mail->isHTML(true);
            $mail->setFrom($email, "E_LEARNING MANAGEMENT SYSTEM");
            $mail->addAddress($student_email);
            $mail->Subject = (($subject));
            $mail->Body = nl2br("Your Person And Course Updated Details \r\n Student Name is: " . $name .
            "\r\n  You Gmail :".$student_email."\r\n Course Login User Name :".$student_email. 
            "\r\n Your Date of Birth " . $student_dob . "\r\n" . "Your Address: " . $student_address.
            "\r\n" . "Your Phone Number: " . $student_number.
            "\r\n" . "Your Nic Number: " . $student_nic );

            if ($mail->send()) {
                $status = "success";
                $response = "Email is sent";
            } else {
                $status = "failed";
                $response = "somthing went wrong: </br>" . $mail->$Errorinfo;
            }
            exit(json_encode(array("status" => $status, "response" => $response)));
        }


   }elseif(mysqli_affected_rows($connection)==0){
    header("location:admin_view_student_details.php?msg=Details Already up to Date .....");
   }
   


}
