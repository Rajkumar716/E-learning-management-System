<?php
session_start();

if(isset($_POST['leave-chat']) ){
    require("db/users.php");
    $objUser=new users;
    $objUser->setLoginStatus(0);
    $objUser->setLastLogin(date('Y-m-d h:i:s'));
    $objUser->setId($_SESSION['userid']);

    if($objUser->updateLoginStatus()){
       echo "success";
     
       header("location:student_join_chat.php");

    }else{
        ?>
<script>
alert("Chat Leaving Failed...");
location = "student_chatroom.php";
</script>

<?php
    }
}
?>