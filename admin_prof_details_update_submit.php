<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');
use PHPMailer\PHPMailer\PHPMailer;
echo $prof_id=$_SESSION['prof_id'];

if(isset($_POST['update_details'])){
   echo $prof_name=$_POST['prof_name'];
   echo $prof_email=$_POST['prof_email'];
   echo $prof_dob=$_POST['prof_dob'];
   echo $prof_address=$_POST['prof_address'];
   echo $prof_number=$_POST['prof_number'];
   echo $prof_nic=$_POST['prof_nic'];
   echo $prof_teach=$_SESSION['teach_degree'];
   echo $prof_time=$_POST['prof_time'];
   echo "</br>";

   $query="UPDATE professor_registration SET prof_fullname='$prof_name',prof_email='$prof_email',prof_dob='$prof_dob',
   prof_address='$prof_address',prof_nic='$prof_nic',prof_phone='$prof_number',prof_type='$prof_time' WHERE prof_id='$prof_id'";
   mysqli_query($connection,$query);

   
                         
   if(mysqli_affected_rows($connection)==1){
          
          $check_chat="UPDATE chat_user SET user_name='$prof_name' WHERE user_id='$prof_id'";
          mysqli_query($connection,$check_chat);
          header("location:admin_view_prof_details.php?msg=Details Update Success.....");

          if (isset($prof_email) ) {
            $email = $prof_email;
            $subject = 'PROFESSOR PERSONAL DETAILS HAS BEEN UPDATED SUCCESSFULLY FOR THE E-LEARNING SYSTEM';
            $persona_email=$prof_email;
            $course_username=$prof_email;
            $name = $prof_name;
            

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
            $mail->addAddress($prof_email);
            $mail->Subject = (($subject));
            $mail->Body = nl2br("Your Person And Course Updated Details \r\n Professor Name is: " . $name .
            "\r\n Your Account Login User Name :".$prof_email. 
            "\r\n Your Date of Birth :" . $prof_dob . "\r\n" . "Your Address: " . $prof_address.
            "\r\n" . "Your Phone Number: " . $prof_number.
            "\r\n" . "Your Nic Number: " . $prof_nic.
            "\r\n" . "Your Teaching Course: " . $prof_teach);

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
    header("location:admin_view_prof_details.php?msg=Details Already up to Date .....");
   }
   


}
