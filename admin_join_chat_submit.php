<?php 
if(isset($_POST['join'])){
    session_start();
   require("db/users.php");
   $objUser=new users;
   $objUser->setUid($_POST['uid']);
$objUser->setName($_POST['uname']);
$objUser->setLoginStatus(1);
$objUser->setLastLogin(date('Y-m-d h:i:s'));
    $userData = $objUser->getUserByUid();
    if(is_array($userData) && count($userData)>0){
       $objUser->setId($userData['chat_id']);
       if($objUser->updateLoginStatus()){
           echo "user login....";
           $_SESSION['user'][$userData['chat_id']]=$userData;
           header("location:admin_chatroom.php");
       }else{
           echo "failed to login....";
       }
    }else{
       if($objUser->save()){
           $lastId = $objUser->$dbConn->lastInsertId();
           $objUser->setId($lastId);
           $_SESSION['user'][$userData['chat_id']]=(array) $objUser;
           echo "User Register....";
           header("location:admin_chatroom.php");
       }else{
        header("location:admin_join_chat.php?error=Chating login faild");
       }
    }

}
?>