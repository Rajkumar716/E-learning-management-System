<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once("database_connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\HttpFoundation\Session\Session;

if (isset($_POST['register'])) {
    if (empty($_POST['course_name']) && empty($_POST['course_duration']) && empty($_POST['course_student_username']) && empty($_POST['course_student_password']) && empty($_POST['course_cost']) && empty($_POST['course_start_date'])) {
        header("location:admin_student_course_reg.php?error=Please Fill the Text Feilds......");
    } else {
        function rand_string($length)
        {

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars), 0, $length);
        }
        $loginpassword = rand_string(8);

        $course_name = $_SESSION['course_name'];
        $student_name = $_SESSION['student_fullname'];
        $course_duration = $_POST['course_duration'];
        // $course_student_email=$_POST['course_student_email'];
        $course_student_username = $_SESSION['student_email'];
        $course_student_password = sha1($loginpassword);
        $course_batch = $_POST['course_batch'];
        $course_cost = $_SESSION['course_cost'];
        $course_provider = $_SESSION['course_provider'];
        $course_start_date = $_POST['course_start_date'];
        $status = "Activate";
        $random = rand(10, 1000000);
        $random_id = $random;
        $course_start_year=$_POST['course_year'];

        $check_seat_Count="SELECT * FROM `batch_details` where batch_number='$_POST[course_batch]' AND course_name='$course_name' AND batch_start_year='$course_start_date'";
        $select_result1=mysqli_query($connection,$check_seat_Count);
        while($select_row1 = mysqli_fetch_assoc($select_result1)){
            $seat_count=$select_row1['seat_count'];
            $_SESSION['seat_count']= $seat_count;
        }
        if($seat_count==0){
            
            header("location:admin_student_course_reg.php?error=This Course For This Batch Year Seats Are Finished Please Try Another Batch......");
        }else{
            $query1 = "SELECT * FROM `course` where student_email='$_SESSION[student_email]' AND course_name='$course_name'";
            mysqli_query($connection, $query1);
            if (mysqli_affected_rows($connection) == 1) {
    
    
                header("location:admin_student_course_reg.php?msg=This Email Address Already Used For This Course......");
            } else {
    
                $query = "INSERT INTO `course`(`course_id`,`course_name`,`course_duration`,`student_id`,`student_name`,`student_email`,`curse_login_username`,`login_password`,`course_started_year`,`course_batch`,`course_cost`,`course_provider`,`course_status`,`course_start_date`) 
                VALUES ('$random_id','$course_name','$course_duration','$_SESSION[student_id]','$student_name','$_SESSION[student_email]','$course_student_username','$course_student_password','$course_start_year','$course_batch','$course_cost','$course_provider','$status','$course_start_date')";
                mysqli_query($connection, $query);
                if (mysqli_affected_rows($connection) == 1) {
    
                    header("location:admin_view_course_details.php?msg=Your course Account has been Created And Gmail Notification send Successfully");
                    $total_seat_count=$seat_count-1;
                     echo $total_seat_count;
                    $update_seat_count="UPDATE batch_details SET seat_count='$total_seat_count' WHERE batch_number='$_POST[course_batch]' AND course_name='$course_name' AND batch_start_year='$course_start_date'";
                    mysqli_query($connection,$update_seat_count);
    
                    if($total_seat_count==0){
                        $update_seat_count="UPDATE batch_details SET seat_count_status='UN-AVAILABLE' WHERE batch_number='$_POST[course_batch]' AND course_name='$course_name' AND batch_start_year='$course_start_date'";
                        mysqli_query($connection,$update_seat_count);
                    }
    
                    if (isset($_SESSION['course_name']) && isset($_SESSION['student_email'])) {
                        $email = $_SESSION['student_email'];
                        $subject = 'YOUR COURSE ACCOUNT HAS BEEN CREATED SUCCESSFULLY FOR THE E-LEARNING SYSTEM';
                        $loginpassword = $loginpassword;
                        $name = $_SESSION['course_name'];
    
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
                        $mail->addAddress($_SESSION['student_email']);
                        $mail->Subject = (($subject));
                        $mail->Body = nl2br("Your Course Login Details \r\n Course Name is: " . 
                        $name ."\r\n course  Id:".$random_id.
                        "\r\n course Start Year :".$course_start_year."\r\n Course Batch Number :".
                        $course_batch. "\r\n Login Username is: " . $loginusername . "\r\n" . 
                        "Login Password is: " . $loginpassword);
    
                        if ($mail->send()) {
                            $status = "success";
                            $response = "Email is sent";
                        } else {
                            $status = "failed";
                            $response = "somthing went wrong: </br>" . $mail->$Errorinfo;
                        }
                        exit(json_encode(array("status" => $status, "response" => $response)));
                    }
                } else {
                    header("location:admin_student_course_reg.php?msg=Your Course Registration Failed");
                }
            }

        }


    
      
    }
}
