<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once('database_connection.php');
//  echo $_SESSION["prof_gmail"];
if(!isset($_SESSION['prof_gmail'])){
    header("location:prof_login.php");
}


$res=mysqli_query($connection,"select * from professor_registration where 	prof_email='$_SESSION[prof_gmail]'");
while($row=mysqli_fetch_array($res)){

$profid=$row["prof_id"];
$_SESSION['prof_id']=$profid;
$prof_name=$row['prof_fullname'];
$_SESSION['prof_fullname']=$prof_name;
}
$result=0;
$msg=mysqli_query($connection,"select * from notification where  read_status='No' and reciever_status='professor'");
$result=mysqli_num_rows($msg);

$private_result=0;
$private_msg=mysqli_query($connection,"select * from notification where  read_status='No' and reciever_status='professor' and reciever_id='$profid'");
$private_result=mysqli_num_rows($private_msg);

$public_result=0;
$public_msg=mysqli_query($connection,"select * from notification where  read_status='No' and reciever_status='professor' and reciever_id='0'");
$public_result=mysqli_num_rows($public_msg);



?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::PROFESSOR CHAT JOIN</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/parsleyjs/css/parsley.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">

        <!-- sidebar -->
        <div class="sidebar px-4 py-4 py-md-5 me-0" style="background-color: rgb(148, 77, 255);">
            <div class="d-flex flex-column h-100">
                <a href="index.html" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <svg width="35" height="35" fill="currentColor" class="bi bi-clipboard-check"
                            viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path
                                d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                            <path
                                d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                        </svg>
                    </span>
                    <span class="logo-text">MY-DASHBOARD</span>
                </a>
                <!-- Menu: main ul -->

                <ul class="menu-list flex-grow-1 mt-3">
                    <li><a class="ms-link" href="prof_view_details.php"><i class="icofont-user-male"></i>
                            <span>Presonal Detail</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_password_change.php"><i class="icofont-edit"></i><span>Password
                                Change</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link " href="prof_view_course_details.php"><i class="icofont-contrast"></i>
                            <span>Course Details</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_student_details.php"><i
                                class="icofont-users-social"></i><span>View Student Details</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_materials.php"><i class="icofont-files-stack"></i><span>View
                                Study Material</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="prof_view_student_upload.php"><i
                                class="icofont-file-psd"></i><span>View Student Uploads</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_student_grade.php"><i class="icofont-result-sport"></i>
                            <span>View Student Grade</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_timetable.php"><i class="icofont-table"></i> <span>View
                                Time-Table</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_join_chat.php"> <i class="icofont-chat"></i><span>Join
                                Chat</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_send_notification.php"> <i
                                class="icofont-notification"></i><span>Send
                                Notification</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_send_notification.php"><i
                                class="icofont-bullseye"></i><span>View
                                Send
                                Notification</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_public_notification.php"><i
                                class="icofont-eye-open"></i><span>View Public Notification</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_private_notification.php"><i
                                class="icofont-eye-blocked"></i><span>View Private Notification</span><span
                                class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                </ul>


            </div>
        </div>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <div class="header">
                <nav class="navbar py-4">
                    <div class="container-xxl">

                        <!-- header rightbar icon -->
                        <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">

                            <div class="dropdown notifications zindex-popover">
                                <a class="nav-link dropdown-toggle pulse" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    <i class="icofont-alarm fs-5"></i>
                                    <span class="pulse-ring"></span>
                                </a>
                                <div id="NotificationsDiv"
                                    class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
                                    <div class="card border-0 w380">
                                        <div class="card-header border-0 p-3">
                                            <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                                <span>Notifications</span>
                                                <span class="badge text-white"><?php echo $result;  ?></span>
                                            </h5>
                                        </div>
                                        <div class="tab-content card-body">
                                            <div class="tab-pane fade show active">
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="prof_view_private_notification.php" class="d-flex">

                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span
                                                                    class="font-weight-bold">PRIVATE NOTIFICATION</span>
                                                                <small><?php echo $private_result; ?></small>
                                                            </p>

                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2">
                                                    <a href="prof_view_public_notification.php" class="d-flex">

                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span
                                                                    class="font-weight-bold">PUBLIC NOTIFICATION</span>
                                                                <small class=""><?php echo $public_result; ?></small>
                                                            </p>

                                                        </div>
                                                    </a>
                                                </li>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                <div class="u-info me-2">
                                    <?php
                                    echo $_SESSION['prof_fullname'];
                                    ?>

                                </div>
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"
                                    data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail"
                                        src="assets/images/profile_av.png" alt="profile">
                                </a>
                                <div
                                    class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="assets/images/profile_av.png"
                                                    alt="profile">
                                                <div class="flex-fill ms-3">
                                                    <?php
                                                    
                                                    echo $_SESSION['prof_fullname']


                                                      ?>

                                                </div>
                                            </div>

                                            <div>
                                                <hr class="dropdown-divider border-dark">
                                            </div>
                                        </div>
                                        <div class="list-group m-2 ">

                                            <a href="prof_logout.php"
                                                class="list-group-item list-group-item-action border-0 "><i
                                                    class="icofont-logout fs-6 me-3"></i>Signout</a>
                                            <div>
                                                <hr class="dropdown-divider border-dark">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- menu toggler -->
                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button"
                            data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>

                        <!-- main menu Search-->
                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

                        </div>

                    </div>
                </nav>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">


                    <div class="row align-item-center">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div
                                    class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">JOIN CHAT</h6>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="prof_join_chat_submit.php">
                                        <?php
                                        
                                         if (isset($_GET['msg'])) {
                                            echo '<div class="alert alert-success" role="alert">';
                                            echo $_GET['msg'];
                                            echo '</div>';
                                        }
                                        if (isset($_GET['error'])) {
                                            echo '<div class="alert alert-danger" role="alert">';
                                            echo $_GET['error'];
                                            echo '</div>';
                                        }

                                        ?>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-8">
                                                <label for="firstname" class="form-label">User ID</label>
                                                <input type="text" class="form-control" id="user_id" name="uid"
                                                    required>
                                            </div>
                                            <div class="col-md-8">
                                                <label for="lastname" class="form-label">User Name</label>
                                                <input type="text" class="form-control" id="user_name" name="uname"
                                                    required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="lastname" class="form-label">IF YOU NEW USER?</label>
                                                <a href="prof_chat_reg.php" class="mt-4 form-label"
                                                    style="text-decoration:underline;">Register</a>

                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mt-4" name="join">JOIN</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



        </div>

    </div>

    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/plugin/parsleyjs/js/parsley.js"></script>


    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <script>
    $(function() {
        // initialize after multiselect
        $('#basic-form').parsley();
    });
    </script>

</body>

</html>