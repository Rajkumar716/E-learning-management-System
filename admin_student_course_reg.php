<?php

session_start();

require_once('database_connection.php');
//  echo $_SESSION["admingmail"];
if (!isset($_SESSION['admingmail'])) {
    header("location:admin_login.php");
}

use PHPMailer\PHPMailer\PHPMailer;

?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ADMIN::STUDENT COURSE REGISTRATION</title>
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
                    <li><a class="ms-link" href="admin_student_course_reg.php"><i class="icofont-university"></i>
                            <span>Course Register</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li>
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

                    <div class="row g-3 mb-3 row-deck">

                        <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                            <div class="alert alert-primary p-3 mb-0 w-100">
                                <form action="" class="row g-1 p-4 p-md-4" method="POST" id="myform">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>Register Student Course</h1>

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
                                    <div class="col-6">


                                        <select name="course_name" class="form-control form-control-lg ">
                                            <option value="hidden">-----Select Course-----</option>'
                                            
                                            <?php
                                            $res = mysqli_query($connection, "select course_name from course_details");
                                            while ($row = mysqli_fetch_array($res)) {
                                                $course_name = $row["course_name"];
                                                $_SESSION['course_name'] = $course_name;

                                                echo "<option value='$row[course_name]'>";
                                                echo $row["course_name"];
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>



                                    </div>
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-lg btn-block btn-primary lift text-uppercase " name="search" id="search">Search</button>
                                    </div>
                                </form>
                                <?php
                                if (isset($_POST['search'])) {
                                    $select_query = "SELECT * FROM course_details WHERE course_name='$_POST[course_name]'";
                                    $select_result = mysqli_query($connection, $select_query);
                                    while ($select_row = mysqli_fetch_assoc($select_result)) {
                                        $course_duration = $select_row['course_duration'];
                                        $_SESSION['course_duration'] = $course_duration;
                                        $course_cost = $select_row['course_cost'];
                                        $_SESSION['course_cost'] = $course_cost;
                                        $course_provider = $select_row['course_provider'];
                                        $_SESSION['course_provider'] = $course_provider;
                                    }


                                    $select_query1="SELECT * FROM batch_details WHERE course_name='$_POST[course_name]' AND batch_status='Activate' ";
                                    $select_result1 = mysqli_query($connection, $select_query1);
                                    while ($select_row1 = mysqli_fetch_assoc($select_result1)) {
                                        $batch_number = $select_row1['batch_number'];
                                        $_SESSION['batch_number'] = $batch_number;
                                        $batch_start_year = $select_row1['batch_start_year'];
                                        $_SESSION['batch_start_year'] = $batch_start_year;
                                        
                                    }
                                }

                               
                                $_SESSION['course_name'] = $_POST['course_name'];

                                $query = "SELECT * FROM student_registration WHERE student_id='$_SESSION[student_id]'";
                                $result = mysqli_query($connection, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $student_gmail = $row["student_email"];
                                    $_SESSION['student_email'] = $student_gmail;
                                    $student_name = $row['student_fullname'];
                                    $_SESSION['student_fullname'] = $student_name;
                                }

                                ?>

                                <form class="row g-1 p-4 p-md-4" action="admin_student_course_reg_submit.php" method="POST" id="myform">

                                    <div class='col-6'>
                                        <div class='mb-2'>
                                            <label class='form-label'>Sudent Gmail</label>

                                            <input type='email' class='form-control form-control-lg' placeholder='enter the gmail' name='studentemail' id='studentemail' value="<?php echo  $student_gmail;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class='col-6'>
                                        <div class='mb-2'>
                                            <label class='form-label'>Sudent Name</label>

                                            <input type='text' class='form-control form-control-lg' placeholder='enter the gmail' name='studentname' id='studentname' value="<?php echo  $student_name;  ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Course Duration</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="Enter the Duration" name="course_duration" value="<?php echo $course_duration;  ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Course Start Year</label>
                                            <select name="course_year" id="cars" class="form-control form-control-lg ">
                                                <option value="" selected disabled>-----Select Year-----</option>
                                                <?php
                                               
                                                    
                                                    echo "<option value='$_SESSION[batch_start_year]'>";
                                                    echo $_SESSION['batch_start_year'];
                                                    echo "</option>";
                                                    
                                                

                                                ?>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Course Batch</label>
                                            <select name="course_batch" id="cars" class="form-control form-control-lg ">
                                                <option value="" selected disabled>-----Select Batch----</option>
                                                <?php
                                               
                                                    
                                               echo "<option value='$_SESSION[batch_number]'>";
                                               echo $_SESSION['batch_number'];
                                               echo "</option>";
                                               
                                           

                                           ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Course Cost</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="enter the total cost" name="course_cost" value="<?php echo $course_cost; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Course Provider Name</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="enter the total cost" name="course_cost" value="<?php echo $course_provider; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Course Start Date</label>
                                            <input type="date" class="form-control form-control-lg" placeholder="enter the start date" name="course_start_date" required>
                                        </div>
                                    </div>



                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="register">REGISTER</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <?php

                    ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        function sendEmail() {
            var name = $("#coursename");
            var email = $("#studentemail");
            var loginusername = $("#loginusername");
            var courseid = $("#courseid");
            var loginpassword = $("#loginpassword");

            if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(loginpassword) && isNotEmpty(loginusername) &&
                isNotEmpty(courseid)) {
                $.ajax({
                    url: 'admin_course_confirmation_submit.php',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name: name.val(),
                        email: email.val(),
                        loginusername: loginusername.val(),
                        courseid: courseid.val(),
                        loginpassword: loginpassword.val()

                    },
                    success: function(response) {
                        $('#myform')[0].reset();
                        // $('.sent_notification').text("message sent successfully.");
                        alert("message sent successfully");

                    }

                });
            }
        }

        function isNotEmpty(caller) {
            if (caller.val() == "") {
                caller.css('border', '1px solid red');
                return false;
            } else {
                caller.css('border', '');
                return true;
            }
        }
    </script>



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