<?php
 if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once("database_connection.php" );
print_r($_POST);
echo "<hr>";
$mandortry=['admin_name','admin_email','admin_password','admin_address','admin_confirmpass','admin_number','admin_nic'];
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
      header('location:admin_reg.php');
}
if(count($register_error)==0){
    echo "no error found .";
    if($_POST['admin_password']==$_POST['admin_confirmpass']){
        echo "confirm password match .";
        
        $admin_name=$_POST['admin_name'];
        
        $admin_gmail=$_POST['admin_email'];
        $admin_password=sha1($_POST['admin_password']);
        $admin_address=$_POST['admin_address'];
        $admin_number=$_POST['admin_number'];
        $admin_nic=$_POST['admin_nic'];
        $current_date=date('y-m-d');
        $status="Activate";

        $query1="SELECT * FROM `admin_registration` where admin_email='$admin_gmail'";
        mysqli_query($connection,$query1);
        if(mysqli_affected_rows($connection)==1){
            $register_error[]="this gmail address already used .";
            $_SESSION['data_error']=$register_error;
            header('location:admin_reg.php');
        }else{
            $query="INSERT INTO `admin_registration`(`admin_id`,`admin_fullname`,`admin_email`,`admin_password`,`admin_address`,`admin_phonenumber`,`admin_nic`,`admin_status`) 
            VALUES (NULL,'$admin_name','$admin_gmail','$admin_password','$admin_address','$admin_number','$admin_nic','$status')";
             mysqli_query($connection,$query);
             if(mysqli_affected_rows($connection)==1){
                 echo "account created success";
                 header('location:admin_dashboard.php?msg=account created success');
             }else{
                 echo "account created fails";
                 $register_error[]="account created fails.";
                   $_SESSION['data_error']=$register_error;
                   header('location:admin_reg.php');
             }
        }
        
        
        
    }else{
        echo "confirm password not match .";
        if(count($form_error)>0){
            $_SESSION['form_data']=$form_error;
        }
        $register_error[]="confirm password not match .";
          $_SESSION['data_error']=$register_error;
          header('location:admin_reg.php');
        
    }
}else{
    print_r($register_error);
}
?>