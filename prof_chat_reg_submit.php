<?php
session_start();
require('database_connection.php');
if(isset($_POST['create'])){
    $user_id=$_POST['user_id'];
    $user_name=$_POST['user_name'];

    $query="SELECT * FROM professor_registration WHERE prof_id='$user_id'";
    mysqli_query($connection,$query);
    if(mysqli_affected_rows($connection)==1){
        $query1="SELECT * FROM professor_registration WHERE prof_fullname='$user_name'";
        mysqli_query($connection,$query1);
        if(mysqli_affected_rows($connection)==1){
               $today_date=date("Y-m-d H:m:s");
               $login_as="Professor";
              $sql="INSERT INTO chat_user (chat_id,user_id,user_name,login_as,login_status,last_login) VALUES('NULL','$user_id','$user_name','$login_as','0','$today_date')";
              $result=mysqli_query($connection,$sql);
              if($result==1){
                header("location:prof_join_chat.php?msg=Your Chating Account Create Successfully.........");

              }else{
                header("location:prof_chat_reg.php?fail=Your Chatting Account Create Failed........");
 
              }
              
   
        }else{
          header('location:prof_chat_reg.php?user=There is No User Name Registered.............');
        }
    }else{
      header("location:prof_chat_reg.php?id=There is No Id Registered.........");
    }
}


?>