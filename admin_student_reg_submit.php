<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("database_connection.php");

use PHPMailer\PHPMailer\PHPMailer;

print_r($_POST);
echo "<hr>";
$mandortry = ['student_name', 'student_email', 'student_address', 'student_number', 'student_nic', 'student_dob'];
$register_error = [];
$form_error = [];
foreach ($mandortry as $mandortries) {
    echo $_POST[$mandortries] . "<hr>";

    if (empty($_POST[$mandortries])) {
        $register_error[] = $mandortries . " fields required .";
    } else {
        $form_error[$mandortries] = $_POST[$mandortries];
    }
}
if (count($register_error) > 0) {
    if (count($form_error) > 0) {
        $_SESSION['form_data'] = $form_error;
    }
    $_SESSION['data_error'] = $register_error;
    header('location:admin_student_register.php');
}
if (count($register_error) == 0) {
    echo "no error found .";
   

        $student_name = $_POST['student_name'];

        $student_gmail = $_POST['student_email'];

        $student_address = $_POST['student_address'];
        $student_number = $_POST['student_number'];
        $student_nic = $_POST['student_nic'];
        $student_dob = $_POST['student_dob'];
        $student_date = date('y-m-d');
        $status = "Activate";
        $random = rand(10, 1000000);
        $random_id = $random;

        $dob = $_POST['student_dob'] ?? '';
        $message = '';


        if (empty($dob)) {

            $message = "Please submit your date of birth.";
            header('location:admin_student_register.php?error=Please submit your date of birth.');
        } elseif (!preg_match('~^([0-9]{2})/([0-9]{2})/([0-9]{4})$~', $dob, $parts)) {

            $message = 'The date of birth is not a valid date in the format MM/DD/YYYY';

            header('location:admin_student_register.php?error=The date of birth is not a valid date in the format MM/DD/YYYY');
        } elseif (!checkdate($parts[1], $parts[2], $parts[3])) {
            $message = 'The date of birth is invalid. Please check that the month is between 1 and 12, and the day is valid for that month.';

            header('location:admin_student_register.php?error=The date of birth is invalid. Please check that the month is between 1 and 12, and the day is valid for that month.');
        }
        if ($message == '') {

            $dob =  new DateTime($dob);

            $minInterval = DateInterval::createFromDateString('18 years');
            $maxInterval = DateInterval::createFromDateString('40 years');

            $minDobLimit = (new DateTime())->sub($minInterval);
            $maxDobLimit = (new DateTime())->sub($maxInterval);

            if ($dob <= $maxDobLimit) {
                $message = 'You must be below 40 Years to Register for Professor';

                header('location:admin_student_register.php?error=You must be below 40 Years to Register for Professor');
            } elseif ($dob >= $minDobLimit) {
                $message = 'You must be above 18 years of age to Register for Professor.';

                header('location:admin_student_register.php?error=You must be above 18 years of age to Register for Professor');
            }
        }
        if ($message == '') {
            $today = new DateTime();
            $diff = $today->diff($dob);
            $message = $diff->format('You are %Y years, %m months and %d days old.');
            $NIC=$student_nic;
            if(  preg_match('/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/', $NIC))
             {
                $query1 = "SELECT * FROM `student_registration` where student_email='$student_gmail'";
                mysqli_query($connection, $query1);
                if (mysqli_affected_rows($connection) == 1) {
                    $register_error[] = "this gmail address already used .";
                    $_SESSION['data_error'] = $register_error;
                    header('location:admin_student_register.php');
                } else {
                    $query = "INSERT INTO `student_registration`(`student_id`,`student_fullname`,`student_email`,`student_address`,`student_phonenumber`,`student_dob`,`student_nic`,`student_status`,`student_registration`) 
                    VALUES ('$random_id','$student_name','$student_gmail','$student_address','$student_number','$student_dob','$student_nic','$status','$student_date')";
                    mysqli_query($connection, $query);
                    if (mysqli_affected_rows($connection) == 1) {
                        echo "account created success";
                         header('location:admin_student_register.php?msg=account created and Email send success');
        
        
        
        
                        if (isset($_POST['student_name']) && isset($_POST['student_email'])) {
                            $email = $_POST['student_email'];
                            $subject = 'YOUR PERSONAL DETAILS HAS BEEN ADDED SUCCESSFULLY FOR THE E-LEARNING SYSTEM';
                            $student_id = $random_id;
                            $name = $_POST['student_name'];
        
        
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
                            $mail->addAddress($_POST['student_email']);
                            $mail->Subject = (($subject));
                            $mail->Body =nl2br( "Your Presonal Details Has been Registered Through The System And Your Account Will be Create With In 24 Hours".
                            "\r\n"."Your Common Student Id :".$student_id.
                            "\r\n"."Your Full Name :".$student_name.
                            "\r\n"."Your Address :".$student_address.
                            "\r\n"."Your Phone Number :".$student_number.
                            "\r\n"."Your Date Of Birth :".$student_dob.
                            "\r\n"."Your Nic Number :".$student_nic);
        
                            if ($mail->send()) {
                                $status = "success";
                                $response = "Email is sent";
                            } else {
                                $status = "failed";
                                $response = "somthing went wrong: </br>" . $mail->Errorinfo;
                            }
                            exit(json_encode(array("status" => $status, "response" => $response)));
                        }
                    } else {
                        echo "account created fails";
                        $register_error[] = "account created fails.";
                        $_SESSION['data_error'] = $register_error;
                        header('location:admin_student_register.php');
                    }
                }

             }else{
                header('location:admin_student_register.php?error=You Are Entered Wrong NIC Format');
             }
        }

       
    
} else {
    print_r($register_error);
}
