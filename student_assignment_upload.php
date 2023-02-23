<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once('database_connection.php');
// //  echo $_SESSION["coursegmail"];
if(!isset($_SESSION['coursegmail'])){
    header("location:student_login.php");
}

$res=mysqli_query($connection,"select * from course where 	curse_login_username='$_SESSION[coursegmail]'");
while($row=mysqli_fetch_array($res)){

$studentid=$row["student_id"];
$_SESSION['student_id']=$studentid;

$course_id=$row['course_id'];
$_SESSION['course_id']=$course_id;

$course_name=$row['course_name'];
$_SESSION['course_name']=$course_name;

$course_year=$row['course_started_year'];
$_SESSION['course_started_year']=$course_year;

$batch_number=$row['course_batch'];
$_SESSION['course_batch']=$batch_number;


}
$result=0;


$private_result=0;
$private_msg=mysqli_query($connection,"select * from notification where  read_status='No' and reciever_status='student' and reciever_id='$course_id'");
$private_result=mysqli_num_rows($private_msg);

$public_result=0;
$public_msg=mysqli_query($connection,"select * from notification where  read_status='No' and reciever_status='student' and reciever_id='0'");
$public_result=mysqli_num_rows($public_msg);

$result=$public_result+$private_result;



?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>STUDENT UPLOAD ASSIGNMENT</title>
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
                    <li><a class="ms-link" href="student_view_details.php"><i class="icofont-user-male"></i>
                            <span>Personal Details</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link " href="student_elms_password_change.php"><i class="icofont-ui-edit"></i>
                            <span>Password Change</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_view_course_details.php"><i class="icofont-book"></i><span>View
                                Course Details</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_exam_register.php"><i class="icofont-clip-board"></i><span>Exam
                                Register</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_view_exam_reg.php"><i class="icofont-read-book"></i><span>View
                                Exam
                                Register</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_assignment_upload.php"><i
                                class="icofont-upload"></i><span>Assignment Upload</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li><br>
                    <li><a class="ms-link" href="student_view_upload_assignment.php"><i
                                class="icofont-eye-alt"></i><span>View Submited
                                Task</span><span class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_view_assignment_grade.php"><i
                                class="icofont-eye"></i><span>View
                                Assignment Grade</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a></li><br>


                    <li><a class="ms-link" href="student_view_study_material.php"><i class="icofont-files-stack"></i>
                            <span>View Study Materials</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_view_timetable.php"><i class="icofont-table"></i> <span>View
                                Time-Table</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>


                    <li><a class="ms-link" href="student_join_chat.php"><i class="icofont-ui-text-chat"></i>
                            <span>Chat</span><span class="arrow icofont-dotted-down ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_view_private_notification.php"><i
                                class="icofont-ui-settings"></i>
                            <span>View Private Notification</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
                    </li><br>
                    <li><a class="ms-link" href="student_view_public_notification.php"><i
                                class="icofont-facebook-messenger"></i>
                            <span>View Public Notification</span><span
                                class="arrow icofont-dotted-right ms-auto text-end fs-5"></span></a>
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
                                                    <a href="student_view_private_notification.php" class="d-flex">

                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span
                                                                    class="font-weight-bold">PRIVATE NOTIFICATION</span>
                                                                <small><?php echo $private_result; ?></small>
                                                            </p>

                                                        </div>
                                                    </a>
                                                </li>
                                                <li class="py-2">
                                                    <a href="student_view_public_notification.php" class="d-flex">

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
                                    echo $_SESSION['coursegmail'];
                                    ?>

                                </div>
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button"
                                    data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/student1.png"
                                        alt="profile">
                                </a>
                                <div
                                    class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="assets/images/student1.png"
                                                    alt="profile">
                                                <div class="flex-fill ms-3">
                                                    <?php
                                                     echo $_SESSION['coursegmail'];
                                                   
                                                      ?>

                                                </div>
                                            </div>

                                            <div>
                                                <hr class="dropdown-divider border-dark">
                                            </div>
                                        </div>
                                        <div class="list-group m-2 ">

                                            <a href="student_logout.php"
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

                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                                    <div class="info-header">
                                        <h6 class="mb-0 fw-bold ">Student Assignment Upload</h6>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <?php
                                     if(isset($_GET['msg'])){
                                        echo '<div class="alert alert-success" role="alert">' ;
                                        echo $_GET['msg'];
                                        
                                        echo '</div>' ;
                                     }

                                    ?>
                                    <table id="myProjectTable" class="table table-hover align-middle mb-0"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Subject Id</th>
                                                <th>Subject Name</th>
                                                <th>Course Name</th>
                                                <th>Course Start Year</th>
                                                <th>Batch Number</th>
                                                <th>Deadline Date</th>
                                                <th>Upload</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            error_reporting(0);
                                            
                                               $query="SELECT * FROM `course_assignment_set` WHERE course_name='$course_name' AND batch_number='$batch_number' AND batch_year='$course_year'";
                                               $result=mysqli_query($connection,$query);
                                               
                                               while($row=mysqli_fetch_assoc($result)){
                                                

                                               echo "<tr>";
                                               echo "<td>{$row['subject_id']}</td>";
                                               echo "<td>{$row['subject_name']}</td>";
                                               
                                               echo "<td>{$row['course_name']}</td>";
                                               echo "<td>{$row['batch_year']}</td>";
                                               echo "<td>{$row['batch_number']}</td>";
                                               echo "<td>{$row['deadline_date']}</td>";
                                               
                                               
                                               echo "<form action='student_upload_assignment.php' method='post'>";
                                               echo "<input type='hidden' value='{$row['id']}' name='id'>";
                                               
                                           
                                                echo "<td><button type='submit' class='btn btn-success' value='upload' name='upload'>UPLOAD</button></td>";
                 
                                                 
                                               echo "</form>";
                                              
                                               echo "</tr>";

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