<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');
//  echo $_SESSION["admingmail"];
if (!isset($_SESSION['admingmail'])) {
    header("location:admin_login.php");
}

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADMIN::VIEW BATCH DETAILS</title>
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
                            <span>Student Register</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link " href="admin_view_student_details.php"><i class="icofont-info-square"></i>
                            <span>Student
                                Details</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>

                    <li><a class="ms-link" href="admin_professor_register.php"><i
                                class="icofont-user-male"></i><span>Professor
                                Register</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="admin_view_prof_details.php"><i
                                class="icofont-info-square"></i><span>Professor Details</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_batch_details.php"><i
                                class="icofont-interface"></i><span>Batch Details</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_course_details.php"><i class="icofont-read-book-alt"></i>
                            <span>Course Details</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="admin_student_exam_form.php"><i class="icofont-papers"></i>
                            <span>Student Exam Register</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>



                    <li><a class="ms-link" href="admin_upload_study_material.php"><i class="icofont-upload"></i>
                            <span>Upload Material</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_material.php"><i class="icofont-eye-alt"></i> <span>View
                                Materials</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>


                    <li><a class="ms-link" href="admin_assignment_upload_set.php"><i class="icofont-upload-alt"></i>
                            <span>Assignment
                                Upload Set</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_assginment_set.php"><i class="icofont-link-alt"></i>
                            <span>View Assignment Set</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_upload_assignment.php"><i class="icofont-eye-open"></i>
                            <span>View Assignment
                                Upload</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
                    <li><a class="ms-link" href="admin_add_timetable.php"><i class="icofont-clock-time"></i> <span>Time
                                Table Set</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_join_chat.php"> <i
                                class="icofont-wechat"></i><span>Chat</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_send_notification.php"> <i
                                class="icofont-notification"></i><span>Send
                                Notification</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>
                    <li><a class="ms-link" href="admin_view_send_notification.php"> <i
                                class="icofont-ui-text-loading"></i><span>View
                                Notification</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li>

                </ul>


            </div>
        </div>
        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <div class="header">
                <nav class="navbar py-4">
                    <div class="container-xxl">
                        <form class="navbar-left navbar-form nav-search mr-md-3" action="" method="POST">
                            <div class="input-group">

                                <input type="text" placeholder="Search ..." class="form-control" name="search_input"
                                    required>
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-search pr-1" name="search_btn">
                                        <i class="icofont-search-2"></i>
                                    </button>
                                </div>

                            </div>

                        </form>

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
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"
                                    data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/user.png"
                                        alt="profile">
                                </a>
                                <div
                                    class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="assets/images/user.png"
                                                    alt="profile">
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
                                            <a href="admin_logout.php"
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


                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

                        </div>

                    </div>
                </nav>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 row-cols-xxl-4">
                        <div class="col">
                            <div class="card bg-primary">
                                <div class="card-body text-white d-flex align-items-center">
                                    <i class="icofont-data fs-3"></i>
                                    <div class="d-flex flex-column ms-3">
                                        <a class="btn bg-secondary text-light btn-lg lift" href="admin_add_batch_details.php" target="_blank">Create New Batch</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-3 mb-3 row-deck">

                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <div class="info-header">
                                        <h6 class="mb-0 fw-bold ">All Batch Detials</h6>
                                    </div>
                                    <?php
                                    error_reporting(0);

                                    if (isset($_GET['msg'])) {
                                        echo '<div class="alert alert-info" role="alert">';
                                        echo $_GET['msg'];
                                        echo '</div>';
                                    }
                                    if (isset($_GET['error'])) {
                                        echo '<div class="alert alert-info" role="alert">';
                                        echo $_GET['error'];
                                        echo '</div>';
                                    }

                                    ?>
                                </div>
                                <div class="card-body">
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Batch Number</th>
                                                <th>Batch Started Year</th>
                                                <th>Course Name</th>
                                                <th>Batch Status</th>

                                                <th>Seat Count</th>
                                                <th>Seat Count Status</th>

                                                <th>Action</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (isset($_POST['search_btn'])) {
                                                $search_query = "SELECT * FROM `batch_details` WHERE batch_id like('$_POST[search_input]%') OR batch_number like('$_POST[search_input]%') ";
                                                $search_result = mysqli_query($connection, $search_query);
                                                while ($row = mysqli_fetch_assoc($search_result)) {

                                                    echo "<tr>";
                                                    echo "<td>{$row['batch_number']}</td>";
                                                    echo "<td>{$row['batch_start_year']}</td>";
                                                    echo "<td>{$row['course_name']}</td>";
                                                    echo "<td>{$row['batch_status']}</td>";

                                                    echo "<td>{$row['seat_count']}</td>";
                                                    echo "<td>{$row['seat_count_status']}</td>";
                                                 

                                                    echo "<form action='admin_batch_status_update.php' method='post'>";
                                                    echo "<input type='hidden' value='{$row['batch_id']}' name='batch_id'>";

                                                    if ($row['batch_status'] == 'Activate') {
                                                        echo "<td><button type='submit' class='btn btn-success' value='De-Activate' name='set_status'>DE-ACTIVATE</button></td>";
                                                    } else {
                                                        echo "<td><button type='submit' class='btn btn-success' name='set_status' value='Activate'>ACTIVATE</button></td>";
                                                    }
                                                    echo "</form>";
                                                    echo "<form action='admin_delete_batch.php' method='post'>";
                                                    echo "<input type='hidden' value='{$row['batch_id']}' name='batch_id'>";


                                                    echo "<td><button type='submit' class='btn btn-danger' name='delete' value='delete'>DELETE</button></td>";

                                                    echo "</form>";
                                                    echo "</tr>";
                                                }
                                            } else {
                                                $query = "SELECT * FROM `batch_details` ";
                                                $result = mysqli_query($connection, $query);

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<tr>";
                                                    echo "<td>{$row['batch_number']}</td>";
                                                    echo "<td>{$row['batch_start_year']}</td>";
                                                    echo "<td>{$row['course_name']}</td>";
                                                    echo "<td>{$row['batch_status']}</td>";

                                                    echo "<td>{$row['seat_count']}</td>";
                                                    echo "<td>{$row['seat_count_status']}</td>";

                                                    echo "<form action='admin_batch_status_update.php' method='post'>";
                                                    echo "<input type='hidden' value='{$row['batch_id']}' name='batch_id'>";

                                                    if ($row['batch_status'] == 'Activate') {
                                                        echo "<td><button type='submit' class='btn btn-success' value='De-Activate' name='set_status'>DE-ACTIVATE</button></td>";
                                                    } else {
                                                        echo "<td><button type='submit' class='btn btn-success' name='set_status' value='Activate'>ACTIVATE</button></td>";
                                                    }
                                                    echo "</form>";
                                                    echo "<form action='admin_delete_batch.php' method='post'>";
                                                    echo "<input type='hidden' value='{$row['batch_id']}' name='batch_id'>";


                                                    echo "<td><button type='submit' class='btn btn-danger' name='delete' value='delete'>DELETE</button></td>";

                                                    echo "</form>";
                                                    echo "</tr>";
                                                }
                                            }

                                            ?>


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
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