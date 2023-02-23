<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');
//  echo $_SESSION["prof_gmail"];
if (!isset($_SESSION['prof_gmail'])) {
    header("location:prof_login.php");
}


$res = mysqli_query($connection, "select * from professor_registration where 	prof_email='$_SESSION[prof_gmail]'");
while ($row = mysqli_fetch_array($res)) {

    $profid = $row["prof_id"];
    $_SESSION['prof_id'] = $profid;
    $prof_name = $row['prof_fullname'];
    $_SESSION['prof_fullname'] = $prof_name;
}
$result = 0;
$msg = mysqli_query($connection, "select * from notification where  read_status='No' and reciever_status='professor'");
$result = mysqli_num_rows($msg);

$private_result = 0;
$private_msg = mysqli_query($connection, "select * from notification where  read_status='No' and reciever_status='professor' and reciever_id='$profid'");
$private_result = mysqli_num_rows($private_msg);

$public_result = 0;
$public_msg = mysqli_query($connection, "select * from notification where  read_status='No' and reciever_status='professor' and reciever_id='0'");
$public_result = mysqli_num_rows($public_msg);


?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PROFESSOR VIEW DETAILS</title>
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
                        <svg width="35" height="35" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z" />
                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z" />
                        </svg>
                    </span>
                    <span class="logo-text">MY-DASHBOARD</span>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">
                    <li><a class="ms-link" href="prof_view_details.php"><i class="icofont-user-male"></i>
                            <span>Presonal Detail</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_password_change.php"><i class="icofont-edit"></i><span>Password
                                Change</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link " href="prof_view_course_details.php"><i class="icofont-contrast"></i>
                            <span>Course Details</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_student_details.php"><i class="icofont-users-social"></i><span>View Student Details</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_materials.php"><i class="icofont-files-stack"></i><span>View
                                Study Material</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="prof_view_student_upload.php"><i class="icofont-file-psd"></i><span>View Student Uploads</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_student_grade.php"><i class="icofont-result-sport"></i>
                            <span>View Student Grade</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_timetable.php"><i class="icofont-table"></i> <span>View
                                Time-Table</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_join_chat.php"> <i class="icofont-chat"></i><span>Join
                                Chat</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_send_notification.php"> <i class="icofont-notification"></i><span>Send
                                Notification</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_send_notification.php"><i class="icofont-bullseye"></i><span>View
                                Send
                                Notification</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_public_notification.php"><i class="icofont-eye-open"></i><span>View Public Notification</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="prof_view_private_notification.php"><i class="icofont-eye-blocked"></i><span>View Private Notification</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
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
                                <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="icofont-alarm fs-5"></i>
                                    <span class="pulse-ring"></span>
                                </a>
                                <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-sm-end p-0 m-0">
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
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">PRIVATE NOTIFICATION</span>
                                                                <small><?php echo $private_result; ?></small>
                                                            </p>

                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2">
                                                    <a href="prof_view_public_notification.php" class="d-flex">

                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">PUBLIC NOTIFICATION</span>
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
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/profile_av.png" alt="profile">
                                </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="assets/images/profile_av.png" alt="profile">
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

                                            <a href="prof_logout.php" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-6 me-3"></i>Signout</a>
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

                    <div class="row g-3 mb-3 row-deck">

                        <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9" style="background-color:rgb(191, 0, 255) ;">
                            <div class="alert alert-primary p-3 mb-0 w-100">
                                <?php

                                $res = mysqli_query($connection, "select * from professor_registration where prof_id='$profid'");
                                while ($row = mysqli_fetch_array($res)) {
                                    $profname = $row['prof_fullname'];
                                    $_SESSION['prof_fullname'] = $profname;
                                    $profgmail = $row['prof_email'];
                                    $_SESSION['prof_email'] = $profgmail;
                                    $profaddress = $row['prof_address'];
                                    $_SESSION['prof_address'] = $profaddress;
                                    $profnumber = $row['prof_phone'];
                                    $_SESSION['prof_phone'] = $profnumber;
                                    $profdob = $row['prof_dob'];
                                    $_SESSION['prof_dob'] = $profdob;
                                    $profnic = $row['prof_nic'];
                                    $_SESSION['prof_nic'] = $profnic;
                                    $profstatus = $row['prof_status'];
                                    $_SESSION['prof_status'] = $profstatus;
                                    $prof_type=$row['prof_type'];
                                    $_SESSION['prof_type']=$prof_type;
                                    $teach_degree=$row['teach_degree'];
                                    $_SESSION['teach_degree']=$teach_degree;
                                }


                                ?>
                                <form class="row g-1 p-4 p-md-4" action="prof_details_update.php" method="POST" id="myform">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>PROFESSOR  DETAILS VIEW</h1>

                                    </div>
                                    <?php
                                    if (isset($_GET['msg'])) {
                                        echo '<div class="alert alert-info" role="alert">';
                                        echo $_GET['msg'];
                                        echo '</div>';
                                    }
                                    ?>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Your Id</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="John" name="prof_id" id="prof_id" value="<?php echo $_SESSION['prof_id'];  ?>" disabled>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="John" name="prof_name" id="prof_name" value="<?php echo $profname;  ?>" disabled>
                                        </div>
                                    </div>
                                 
                                 

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Dath Of Birth</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="Date OF Birth" name="prof_dob" value="<?php echo $profdob;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="address" name="prof_address" value="<?php echo $profaddress;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="phone number" name="prof_number" value="<?php echo $profnumber; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">NIC Number</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="nic number" name="prof_nic" value="<?php echo $profnic; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Account Status</label>
                                            <input type="text" class="form-control form-control-lg" name="prof_status" id="prof_status" value="<?php echo $profstatus;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Teach Degree</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="Parker" name="prof_email" id="prof_email" value="<?php echo $teach_degree; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Professor Type</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="Parker" name="prof_email" id="prof_email" value="<?php echo $prof_type; ?>" disabled>
                                        </div>
                                    </div>


                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase">EDIT</button>
                                        <a type="button" class="btn btn-lg btn-block btn-light lift text-uppercase" href="prof_details_print.php">PRINT</a>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div><!-- Row End -->



                </div>
            </div>



        </div>
    </div>


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