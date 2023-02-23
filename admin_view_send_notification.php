<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');
//  echo $_SESSION["admingmail"];
if (!isset($_SESSION['admingmail'])) {
    header("location:admin_login.php");
}
$query = "SELECT * FROM admin_registration WHERE admin_email='$_SESSION[admingmail]'";
$result = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $sender_name = $row['admin_fullname'];
    $_SESSION['admin_fullname'] = $sender_name;
    $sender_id = $row['admin_id'];
    $_SESSION['admin_id'] = $sender_id;
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADMIN::STUDENT REGISTRATION</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
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
                        <img src="assets/images/man-icon.png" alt="">
                    </span>
                    <span class="logo-text">My-Task</span>
                </a>
                <!-- Menu: main ul -->

                <ul class="menu-list flex-grow-1 mt-3">

                <li><a class="ms-link" href="admin_student_register.php"><i class="icofont-user-male"></i>
                            <span>Student Register</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link " href="admin_view_student_details.php"><i class="icofont-info-square"></i>
                            <span>Student
                                Details</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>

                    <li><a class="ms-link" href="admin_professor_register.php"><i class="icofont-user-male"></i><span>Professor
                                Register</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="admin_view_prof_details.php"><i class="icofont-info-square"></i><span>Professor Details</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_batch_details.php"><i
                                class="icofont-interface"></i><span>Batch Details</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_course_details.php"><i class="icofont-read-book-alt"></i>
                            <span>Course Details</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="admin_student_exam_form.php"><i class="icofont-papers"></i>
                            <span>Student Exam Register</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>



                    <li><a class="ms-link" href="admin_upload_study_material.php"><i class="icofont-upload"></i>
                            <span>Upload Material</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_material.php"><i class="icofont-eye-alt"></i> <span>View
                                Materials</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>


                    <li><a class="ms-link" href="admin_assignment_upload_set.php"><i class="icofont-upload-alt"></i>
                            <span>Assignment
                                Upload Set</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_assginment_set.php"><i class="icofont-link-alt"></i>
                            <span>View Assignment Set</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_upload_assignment.php"><i class="icofont-eye-open"></i>
                            <span>View Assignment
                                Upload</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="admin_add_timetable.php"><i class="icofont-clock-time"></i> <span>Time
                                Table Set</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_join_chat.php"> <i class="icofont-wechat"></i><span>Chat</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_send_notification.php"> <i class="icofont-notification"></i><span>Send
                                Notification</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_send_notification.php"> <i class="icofont-ui-text-loading"></i><span>View
                                Notification</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>


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


                            </div>
                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                <div class="u-info me-2">
                                    <?php

                                    $res = mysqli_query($connection, "select * from admin_registration where admin_email='$_SESSION[admingmail]'");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo " <p class='mb-0 text-end line-height-sm '><span class='font-weight-bold'>";
                                        echo $row["admin_fullname"];
                                        echo "</span></p>";
                                    }


                                    ?>
                                    <small>Admin Profile</small>
                                </div>
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/user.png" alt="profile">
                                </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="assets/images/user.png" alt="profile">
                                                <div class="flex-fill ms-3">
                                                    <?php

                                                    $res = mysqli_query($connection, "select * from admin_registration where admin_email='$_SESSION[admingmail]'");
                                                    while ($row = mysqli_fetch_array($res)) {
                                                        echo "<p class='mb-0'><span class='font-weight-bold'>";
                                                        echo $row["admin_fullname"];
                                                        echo "</span></p>";
                                                    }


                                                    ?>
                                                    <small class=""><?php echo $_SESSION['admingmail'];  ?></small>
                                                </div>
                                            </div>

                                            <div>
                                                <hr class="dropdown-divider border-dark">
                                            </div>
                                        </div>
                                        <div class="list-group m-2 ">
                                            <a href="admin_logout.php" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a>
                                            <div>
                                                <hr class="dropdown-divider border-dark">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- menu toggler -->
                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>


                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

                        </div>

                    </div>
                </nav>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="card mb-3">
                        <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                            <h6 class="mb-0 fw-bold ">Admin View Send Notification</h6>
                            <?php
                            if (session_status() == PHP_SESSION_NONE) {
                                session_start();
                            }
                            if (isset($_GET['error'])) {
                                echo '<div class="alert alert-danger" role="alert">';
                                echo $_GET['alert'];
                                echo '</div>';
                            }

                            if (isset($_GET['msg'])) {
                                echo '<div class="alert alert-success" role="alert">';
                                echo $_GET['msg'];
                                echo '</div>';
                            }

                            ?>
                        </div>

                        <?php
                        $sql = "SELECT * FROM `notification` WHERE `sender_id`='$sender_id'";
                        $RESULT = mysqli_query($connection, $sql);
                        while ($row = mysqli_fetch_assoc($RESULT)) {
                            if ($row['reciever_id'] == 0) {
                                $reciever = 'Public';
                            } else {
                                $reciever = $row['reciever_id'];
                            }
                            echo '<div class="col">';
                            echo '<div class="card teacher-card">';
                            echo '<div class="card-body  d-flex">';
                            echo '<div class="teacher-info border-start ps-xl-4 ps-md-3 ps-sm-4 ps-4 w-100">';
                            echo '<h6 class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">' . 'SEND NAME :' . $row['sender_name'] . '<br>' . 'SEND STATUS :' . $row['sender_status'] . '</h6>';
                            echo '<h6 class="py-1 fw-bold small-11 mb-0 mt-1 text-muted">' . 'RECIEVER ID :' . $reciever . '<br>' . 'RECIEVER STATUS :' . $row['reciever_status'] . '</h6>';
                            echo '<div class="video-setting-icon mt-3 pt-3 border-top">';
                            echo '<p>' . 'MESSAGE :' . $row['message'] . '</p>';
                            echo '</div>';
                            echo '<div class="d-flex flex-wrap align-items-center ct-btn-set">';
                            echo '<form action="admin_notification_delete.php" method="POST">';
                            echo "<input type='hidden' value='{$row['notification_id']}' name='notification_id'>";
                            echo "<button type='submit' class='btn btn-danger' value='delete' name='delete'>DELETE</button>";
                            echo '</form>';

                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo "<br><br>";
                        }




                        ?>
                    </div>
                </div>


            </div>
        </div>



    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>

    <!-- Plugin Js-->
    <script src="assets/bundles/apexcharts.bundle.js"></script>
    <script src="assets/bundles/dataTables.bundle.js"></script>

    <!-- Jquery Page Js -->
    <script src="../js/template.js"></script>
    <script src="../js/page/index.js"></script>

</body>

</html>