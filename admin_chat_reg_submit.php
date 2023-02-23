<?php
session_start();
require('database_connection.php');
if(isset($_POST['create'])){
    $user_id=$_POST['user_id'];
    $user_name=$_POST['user_name'];

    $query="SELECT * FROM admin_registration WHERE admin_id='$user_id'";
    mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection)==1){
        $query1="SELECT * FROM admin_registration WHERE admin_fullname='$user_name'";
        mysqli_query($connection,$query1);
        if(mysqli_affected_rows($connection)==1){
               $today_date=date("Y-m-d H:m:s");
               $login_as="admin";
              $sql="INSERT INTO chat_user (chat_id,user_id,user_name,login_as,login_status,last_login) VALUES('NULL','$user_id','$user_name','$login_as','0','$today_date')";
              $result=mysqli_query($connection,$sql);
              if($result==1){
                 header("location:admin_join_chat.php?msg=Chat User Account Created Successfully............");
              }else{
                header("location:admin_chat_reg.php?error=Chat User Account Created Failed Try Again.........");
              }
        }else{
          header("location:admin_chat_reg.php?error=This User Name No Longer Registered..........");

        }
    }else{
      header("location:admin_chat_reg.php?error=This User Id No Longer Registered...................");

    }
}


?>