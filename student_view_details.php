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
    <title>STUDENT::STUDENT VIEW DETAILS</title>
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
                <a href="#" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <img src="assets/images/STUDENT.png" alt="">
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

                        <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                            <div class="alert alert-primary p-3 mb-0 w-100">
                                <?php
                                    
                                  $res=mysqli_query($connection,"select * from student_registration where student_id='$studentid'");
                                  while($row=mysqli_fetch_array($res)){
                                           $studentname= $row['student_fullname'];
                                           $_SESSION['student_fullname']=$studentname;
                                           $studentgmail= $row['student_email'];
                                           $_SESSION['student_email']=$studentgmail;
                                           $studentaddress= $row['student_address'];
                                           $_SESSION['student_address']=$studentaddress;
                                           $studentnumber= $row['student_phonenumber'];
                                           $_SESSION['student_phonenumber']=$studentnumber;
                                           $studentdob= $row['student_dob'];
                                           $_SESSION['student_dob']=$studentdob;
                                           $studentnic= $row['student_nic'];
                                           $_SESSION['student_nic']=$studentnic;
                                           $studentstatus= $row['student_status'];
                                           $_SESSION['student_status']=$studentstatus;
                                         
                                
                                  
                                }


                                 ?>
                                <form class="row g-1 p-4 p-md-4" action="student_details_update.php" method="POST"
                                    id="myform">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>STUDENT PERSONAL DETAILS VIEW</h1>

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
                                            <label class="form-label">Full Name</label>
                                            <input type="text" class="form-control form-control-lg" placeholder="John"
                                                name="student_name" id="student_name"
                                                value="<?php echo $studentname;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control form-control-lg"
                                                placeholder="Parker" name="student_email" id="student_email"
                                                value="<?php echo $studentgmail; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Status</label>
                                            <input type="text" class="form-control form-control-lg"
                                                name="student_status" id="student_status"
                                                value="<?php echo $studentstatus;  ?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Dath Of Birth</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="address" name="student_dob"
                                                value="<?php echo $studentdob;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="address" name="student_address"
                                                value="<?php echo $studentaddress;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Phone Number</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="phone number" name="student_number"
                                                value="<?php echo $studentnumber; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">NIC Number</label>
                                            <input type="text" class="form-control form-control-lg"
                                                placeholder="nic number" name="student_nic"
                                                value="<?php echo $studentnic; ?>" disabled>
                                        </div>
                                    </div>
                                  


                                    <div class="col-12 text-center mt-4">

                                        <button type="submit"
                                            class="btn btn-lg btn-block btn-light lift text-uppercase">EDIT</button>
                                            
                                        <a type="button"
                                            class="btn btn-lg btn-block btn-light lift text-uppercase" href="student_details_print.php">PRINT</a>
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