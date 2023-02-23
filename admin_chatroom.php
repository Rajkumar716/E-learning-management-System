<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>:: ADMIN-Task::ADMIN CHAT</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <style type="text/css">
    #messages {
        height: 200px;
        background: whitesmoke;
        overflow: auto;
    }

    #chat-room-frm {
        margin-top: 10px;
    }

    body {
        background-color: rgb(230, 230, 255);
    }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center" style="margin-top: 5px; padding-top: 0;">ADMIN CHAT ROOM</h2>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <?php 
					session_start();
                    if(!isset($_SESSION['user'])){
                        header("location:admin_join_chat.php");
                    }
					// print_r($_SESSION);

                    require("db/users.php");
                    require("db/chatrooms.php");
                    $objChatroom=new chatrooms;
                    $chatrooms= $objChatroom->getAllChatRooms();
                    $objUsre=new users;
                    $users=$objUsre->getAllUsers();
				 ?>

                <div class="col-md-8 col-lg-12 ">
                    <div class="alert alert-primary  ">
                        <table class="table table-striped">

                            <thead>
                                <tr>

                                    <td>
                                        <?php 
									foreach ($_SESSION['user'] as $key => $user) {
										$userId = $key;
                                       $_SESSION['userid']=$userId;
										echo '<input type="hidden" name="userId" id="userId" value="'.$key.'">';
										echo "<div>"."User Name:".$user['user_name']."</div>";
										echo "<div>"."User Id:".$user['user_id']."</div>";
									}
								 ?>
                                    </td>

                                    <td align="right" colspan="2">
                                        <form action="admin_leave_chat.php" method="POST">
                                            <input type="submit" class="btn btn-warning" id="leave-chat"
                                                name="leave-chat" value="Leave">
                                        </form>

                                    </td>
                                </tr>
.
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 " >
                    <div class="alert alert-primary  ">
                        <table id="myProjectTable" class="table table-hover align-middle mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>login As</th>
                                    <th>Status</th>
                                    <th>Login Date</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
							foreach ($users as $key => $user) {
								$color = '<div class="btn btn-danger">Offline</div>';
								if($user['login_status'] == 1) {
									$color = '<div class="btn btn-success">Online</div>';
								}
								if(!isset($_SESSION['user'][$user['chat_id']])) {
								echo "<tr>";
                               echo" <td>".$user['user_name']."</td>";
                                echo "<td>".$user['login_as']."</td>";
								echo "<td><span >".$color."</span></td>";
								echo "<td>".$user['last_login']."</td></tr>";
								}
							}
						 ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="col-md-12 col-lg-8">
                <div id="messages">
                    <div class="col-md-12 col-lg-12 ">
                        <div class="alert alert-primary  ">
                            <table id="chats" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th colspan="4" scope="col"><strong>Chat Room</strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                             date_default_timezone_set('Asia/Kolkata');
                             foreach($chatrooms as $key => $chatroom){
                                if($userId==$chatroom['user_id']){
                                    $from="Me";
                                }else{
                                    $from=$chatroom['user_name'];
                                }
                                echo '<tr> <td valign="top"> <div><strong>'.$from. '</strong></div> <div>'.$chatroom['msg'].
                                '</div><td align="right" valign="top">'.date("l jS \of F Y h:i:s A",strtotime($chatroom['created_on'])).'</td></tr>';
                             }


                             ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div></br>
                <div class="col-md-8 col-lg-12">
                    <div class="alert alert-primary p-3 mb-0 w-100">
                        <form id="chat-room-frm" method="post" action="">
                            <div class="form-group">
                                <textarea class="form-control" id="msg" name="msg"
                                    placeholder="Enter Message"></textarea>
                            </div></br>
                            <div class="form-group" align="right">
                                <input type="button" value="Send" class="btn btn-success btn-block" id="send"
                                    name="send">
                            </div>
                        </form>
                    </div>
                </div>

            </div>
</body>
<script type="text/javascript">
$(document).ready(function() {
    var conn = new WebSocket('ws://localhost:8080');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        console.log(e.data);
        var data = JSON.parse(e.data);
        var row =
            '<tr> <td valign="top"> <div><strong>' + data.from + '</strong></div> <div>' + data.msg +
            '</div><td align="right" valign="top">' + data.dt + '</td></tr>';
        $('#chats > tbody').prepend(row);
    };

    conn.onclose = function(e) {
        console.log("Connection Closed!....");
    }

    $("#send").click(function() {
        var userId = $("#userId").val();
        var msg = $("#msg").val();
        var data = {
            userId: userId,
            msg: msg
        };
        conn.send(JSON.stringify(data));
        $("#msg").val("");

    });






});
</script>

</html>