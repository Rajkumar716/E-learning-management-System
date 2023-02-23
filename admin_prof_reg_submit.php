<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once("database_connection.php" );
use PHPMailer\PHPMailer\PHPMailer;
print_r($_POST);
echo "<hr>";
$mandortry=['prof_name','prof_email','prof_address','prof_number','prof_nic','prof_dob'];
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
    header('location:admin_professor_register.php');
}
if(count($register_error)==0){
    echo "no error found .";
        
        $prof_name=$_POST['prof_name'];
        
        $prof_gmail=$_POST['prof_email'];
        $teach_course=$_POST['course_name'];
        $prof_address=$_POST['prof_address'];
        $prof_number=$_POST['prof_number'];
        $prof_nic=$_POST['prof_nic'];
        $prof_dob=$_POST['prof_dob'];
        $prof_date=date('y-m-d');
        $prof_type=$_POST['prof_time'];
        $status="Activate";
        $random=rand(10,1000000);
        $random_id=$random;
        function rand_string( $length ) {

            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            return substr(str_shuffle($chars),0,$length);
            
            }
            
          $password= rand_string(8);
          $prof_password=sha1($password);


        $query1="SELECT * FROM `professor_registration` where prof_email='$prof_gmail'";
        mysqli_query($connection,$query1);
        if(mysqli_affected_rows($connection)==1){
            $register_error[]="this gmail address already used .";
            $_SESSION['data_error']=$register_error;
            header('location:admin_professor_register.php');
        }else{

            $dob = $_POST['prof_dob'] ?? '';
            $message = '';

            if (empty($dob)){

             $message="Please submit your date of birth.";
              header('location:admin_professor_register.php?error=Please submit your date of birth.');
          }
          elseif (!preg_match('~^([0-9]{2})/([0-9]{2})/([0-9]{4})$~', $dob, $parts)){

              $message = 'The date of birth is not a valid date in the format MM/DD/YYYY';
             
              header('location:admin_professor_register.php?error=The date of birth is not a valid date in the format MM/DD/YYYY');
          }
          elseif (!checkdate($parts[1],$parts[2],$parts[3])){
            $message = 'The date of birth is invalid. Please check that the month is between 1 and 12, and the day is valid for that month.';
            
            header('location:admin_professor_register.php?=The date of birth is invalid. Please check that the month is between 1 and 12, and the day is valid for that month.');
        }
        if ($message == '') {

           $dob =  new DateTime($dob);

           $minInterval = DateInterval::createFromDateString('24 years');
           $maxInterval = DateInterval::createFromDateString('60 years');

           $minDobLimit = ( new DateTime() )->sub($minInterval);
           $maxDobLimit = ( new DateTime() )->sub($maxInterval);

           if ($dob <= $maxDobLimit){
            $message = 'You must be below 60 Years to Register for Professor';
            
            header('location:admin_professor_register.php?error=You must be below 60 Years to Register for Professor');
           }
            
        elseif ($dob >= $minDobLimit) {
           $message = 'You must be above 24 years of age to Register for Professor.';
          
           header('location:admin_professor_register.php?error=You must be above 24 years of age to Register for Professor');
       }
   }


   if ($message == '') {
       $today = new DateTime();
       $diff = $today->diff($dob);
       $message = $diff->format('You are %Y years, %m months and %d days old.');
       $NIC=$prof_nic;
       if(  preg_match('/^([0-9]{9}[x|X|v|V]|[0-9]{12})$/', $NIC))
        {
            $query="INSERT INTO `professor_registration`(`prof_id`,`prof_fullname`,`prof_email`,`prof_password`,`teach_degree`,`prof_type`,`prof_dob`,`prof_nic`,`prof_address`,`prof_phone`,`prof_status`,`prof_reg`) 
       VALUES ('$random_id','$prof_name','$prof_gmail','$prof_password','$teach_course','$prof_type','$prof_dob','$prof_nic','$prof_address','$prof_number','$status','$prof_date')";
       mysqli_query($connection,$query);
       if(mysqli_affected_rows($connection)==1){
         echo "account created success";
         header('location:admin_professor_register.php?msg=account created and Email send success');




         if(isset($_POST['prof_name']) && isset($_POST['prof_email'])){
            $email=$_POST['prof_email'];
            $subject='YOUR PROFESSOR ACCOUNT HAS BEEN CREATED SUCCESSFULLY FOR THE E-LEARNING SYSTEM';
            $pro_password=$password;
            $name=$_POST['prof_name'];


            require_once "PHPMailer/PHPMailer.php";
            require_once "PHPMailer/SMTP.php";
            require_once "PHPMailer/Exception.php";


            $mail=new PHPMailer();


                        //smtp setting

            $mail->isSMTP();
            $mail->Host="smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username ="masterxy360@gmail.com";
            $mail->Password ="qgdpxwkzwahpjbyu";
            $mail->Port=587;
            $mail->SMTPSecure ='tsl';



                    //email setting
            $mail->isHTML(true);
            $mail->setFrom($email,"E_LEARNING MANAGEMENT SYSTEM");
            $mail->addAddress($_POST['prof_email']);
            $mail->Subject=(($subject));
            $mail->Body =nl2br("Your Login Details......"."\r\n User ID :".$random_id.
            "\r\n Username is: ".$email.
            "\r\n"."Your Password is: ".$password.
            "\r\n"."Your Name is: ".$prof_name.
            "\r\n"."Your teaching Course is: ".$teach_course.
            "\r\n"."Your Date of Birth is: ".$$prof_dob.
            "\r\n"."Your Nic Number is: ".$prof_nic.
            "\r\n"."Your Address is: ".$prof_address.
            "\r\n"."Your Phone Number is: ".$prof_number);

            if($mail->send()){
                $status="success";
                $response="Email is sent";
            }else{
                $status="failed";
                $response="somthing went wrong: </br>".$mail->Errorinfo;
            }
            exit(json_encode(array("status"=>$status, "response"=>$response)));


        }



    }else{
     echo "account created fails";
     $register_error[]="account created fails.";
     $_SESSION['data_error']=$register_error;
     header('location:admin_professor_register.php');
 }
        }
        else
       {
        header('location:admin_professor_register.php?error=You Are Enter Wrong NIC Format.....');
       }
        

      
}
}





}





else{
    print_r($register_error);
}
?>