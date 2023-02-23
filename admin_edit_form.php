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

    <title>::ADMIN TIME TABLE EDIT</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
    <style>
        body {
            background-color: rgb(194, 153, 255);
        }
    </style>
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">


                        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0  text-light" style="max-width: 32rem;background-color:rgb(148, 77, 255)">
                                <?php
                                $tableid = $_POST['table_id'];
                                $query = "SELECT * FROM `time_table` WHERE table_id='$tableid'";
                                $result = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $tableid = $row['table_id'];
                                    $_SESSION['table_id'] = $tableid;
                                    $coursename = $row['course_name'];
                                    $_SESSION['course_name'] = $coursename;
                                    $batch = $row['batch'];
                                    $_SESSION['batch'] = $batch;
                                    $subject_name = $row['subject_name'];
                                    $_SESSION['subject_name'] = $subject_name;
                                    $prof_name = $row['prof_name'];
                                    $_SESSION['prof_name'] = $prof_name;
                                    $date = $row['date'];
                                    $_SESSION['date'] = $date;
                                    $starttime = $row['start_time'];
                                    $_SESSION['start_time'] = $starttime;
                                    $endtime = $row['end_time'];
                                    $_SESSION['end_time'] = $endtime;
                                    $course_started_year=$row['course_started_year'];
                                    $_SESSION['course_started_year']=$course_started_year;
                                }


                                ?>
                                <!-- Form -->
                                <form class="row g-1 p-6 p-md-6" action="admin_timetable_edit_submit.php" method="POST">

                                    <h1 class="col-12 text-center ">EDIT TIME TABLE</h1>



                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">COURSE NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="course_name" value="<?php echo $coursename;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">COURSE Start Year</label>
                                            <input type="text" class="form-control form-control-lg" name="course_year" value="<?php echo $course_started_year;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">BATCH NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="batch_name" value="<?php echo $batch;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">SUBJECT NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="subject_name" value="<?php echo $subject_name;  ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">PROFESSOR NAME</label>
                                            <input type="text" class="form-control form-control-lg" name="prof_name" value="<?php echo $prof_name;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">DATE</label>
                                            <input type="date" class="form-control form-control-lg" name="date" value="<?php echo $date;  ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">START TIME</label>
                                            <input type="time" class="form-control form-control-lg" name="start_time" value="<?php echo $starttime;  ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">END TIME</label>
                                            <input type="time" class="form-control form-control-lg" name="end_time" value="<?php echo $endtime;  ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="edit_table">EDIT</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <a href="admin_add_timetable.php" class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
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
    <script src="../assets/bundles/libscripts.bundle.js"></script>

</body>

</html>