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

$id=$_SESSION['id'];




?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PROFESSOR PASSWORD CHANGE</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/datatables/responsive.dataTables.min.css">
    <link rel="stylesheet" href="assets/plugin/datatables/dataTables.bootstrap5.min.css">
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>
<STYle>
body {
    background-color: rgb(235, 204, 255);
}
</STYle>

<body>

    <div id="mytask-layout" class="theme-indigo">



        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <div class="header">
                <nav class="navbar py-4">
                    <div class="container-xxl">

                        <!-- header rightbar icon -->
                        <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">


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
                                                     echo $_SESSION['prof_fullname'];
                                                   
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


                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

                        </div>

                    </div>
                </nav>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <?php
                        $query="SELECT * FROM `course_subject_assignments` WHERE id='$id'";
                        $result=mysqli_query($connection,$query);
                        
                        while($row=mysqli_fetch_assoc($result)){
                            $subject_id=$row['subject_id'];
                            $_SESSION['subject_id']=$subject_id;
                            $subject_name=$row['subject_name'];
                            $_SESSION['subject_name']=$subject_name;
                            $student_id=$row['student_course_id'];
                            $_SESSION['student_course_id']=$student_id;
                            $file_name=$row['file'];
                            $_SESSION['file']=$file_name;
                            $deadline=$row['deadline_date'];
                            $_SESSION['deadline_date']=$deadline;
                            $submit_date=$row['submit_date'];
                            $_SESSION['submit_date']=$submit_date;
                            $course_name=$row['course_name'];
                            $_SESSION['course_name']=$course_name;


                        }


                       ?>


                        <div
                            class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-12 card border-0  text-light"
                                style="max-width: 32rem;background-color:rgb(148, 77, 255)">
                                <!-- Form -->
                                <form class="row g-1 p-4 p-md-4" action="prof_assign_grade_submit.php" method="POST"
                                    enctype="multipart/form-data">

                                    <h1 class="col-12 text-center ">GRADE THE ASSIGNMENT</h1>



                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">SUBJECT ID</label>
                                            <input type="text" class="form-control form-control-lg" name="subject_id"
                                                value="<?php echo $subject_id;  ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">SUBJECT NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="subject_name"
                                                value="<?php echo $subject_name;  ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">COURSE NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="course_name"
                                                value="<?php echo $course_name;  ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">STUDENT ID</label>
                                            <input type="text" class="form-control form-control-lg" name="student_id"
                                                value="<?php echo $student_id;  ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">ASSIGNMENT NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="assign_name"
                                                value="<?php echo $file_name;  ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">DEAD-LINE DATE</label>
                                            <input type="date" class="form-control form-control-lg" name="dead_line"
                                                value="<?php echo $deadline;  ?>" required disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">SUBMITTED DATE</label>
                                            <input type="date" class="form-control form-control-lg"
                                                name="submitted_date" value="<?php echo $submit_date;  ?>" requireds disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Course Batch</label>
                                            <select name="assign_grade" id="cars" class="form-control form-control-lg ">
                                                <option value="" selected disabled>-----Select Grade----</option>
                                                <option value="A+">A+</option>
                                                <option value="A">A</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B">B</option>
                                                <option value="B-">B-</option>
                                                <option value="C+">C+</option>
                                                <option value="C">C</option>
                                                <option value="C-">C-</option>
                                                <option value="F">F</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase"
                                            name="grade">GRADE</button></br></br>
                                            <a href="prof_view_student_upload.php" class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
                                            BACK</a>
                                    </div>

                                </form>
                                <!-- End Form -->

                            </div>
                        </div>
                    </div> <!-- End Row -->
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