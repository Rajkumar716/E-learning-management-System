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
    <title>ADMIN::PROFESSOR REGISTRATION</title>
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

                    <div class="row g-3 mb-3 row-deck">

                        <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                            <div class="alert alert-primary p-3 mb-0 w-100">
                                <form class="row g-1 p-4 p-md-4" action="admin_prof_reg_submit.php" method="POST"
                                    id="myform">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>Create Professor account</h1>

                                    </div>
                                    <?php
                                    if (session_status() == PHP_SESSION_NONE) {
                                        session_start();
                                    }
                                    if (isset($_SESSION['data_error'])) {
                                        //    print_r($_SESSION['data_error']);
                                        foreach ($_SESSION['data_error'] as $d_error) {

                                            echo '<div class="alert alert-danger" role="alert">';
                                            echo $d_error;
                                            echo '</div>';
                                        }
                                        unset($_SESSION['data_error']);
                                    }
                                    echo "<hr>";
                                    if (isset($_SESSION['form_data'])) {
                                        // print_r($_SESSION['form_data']);
                                        //  unset($_SESSION['form_data']);
                                    }
                                    if (isset($_GET['msg'])) {
                                        echo '<div class="alert alert-success" role="alert">';
                                        echo $_GET['msg'];
                                        echo '</div>';
                                    }
                                     if (isset($_GET['error'])) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $_GET['error'];
                                        echo '</div>';
                                        unset($_GET['data_error']);
                                    }
                                    

                                    ?>

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="John"
                                                name="prof_name" id="prof_name" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control form-control-lg"
                                                placeholder="Parker@gmail.com" name="prof_email" id="prof_email"
                                                required>
                                        </div>
                                    </div>
                                 

                                
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Dath Of Birth</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="MM/DD/YYYY" name="prof_dob" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="address" name="prof_address" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="phone number" name="prof_number" maxlength="10"
                                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">NIC Number</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="nic number" name="prof_nic" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Teach Degree</label>

                                            <select name="course_name" class="form-control form-control-lg " required>
                                                <option value="" selected disabled>-----Select Course-----</option>
                                                <?php
                                                        $res=mysqli_query($connection,"select course_name from course_details");
                                                          while($row=mysqli_fetch_array($res)){
                                                            $course_name=$row["course_name"];
                                                            $_SESSION['course_name']=$course_name;

                                                              echo "<option value='$row[course_name]'>";
                                                                  echo $row["course_name"];
                                                             echo "</option>";
                                                           }
                                                     ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Professor Type</label>

                                            <select name="prof_time" class="form-control form-control-lg " required>
                                                <option value="" selected disabled>-----Select Type-----</option>
                                                <option value="FULL-TIME" >FULL TIME</option>
                                                <option value="PART-TIME" >PART TIME</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12 text-center mt-4">

                                        <button type="submit"
                                            class="btn btn-lg btn-block btn-light lift text-uppercase">REGISTER</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div><!-- Row End -->



                </div>
            </div>



        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
    function sendEmail() {
        var name = $("#prof_name");
        var email = $("#prof_email");

        var prof_password = $("#prof_password");

        if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(prof_password)) {
            $.ajax({
                url: 'admin_prof_reg_submit.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name.val(),
                    email: email.val(),

                    prof_password: prof_password.val()

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