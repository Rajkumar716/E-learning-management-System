<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');

$student_id = $_SESSION['student_id'];

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>STUDENT COURSE DETAIL PRINT</title>
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



                    <div
                        class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-6 p-md-8 card border-0  text-light"
                            style="max-width: 32rem;background-color:rgb(148, 77, 255)">
                            <!-- Form -->
                            <form class="row g-1 p-4 p-md-4" action="" method="POST">

                                <h1 class="col-12 text-center mb-1 mb-lg">Your Course Details For Print</h1>
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

                                if (isset($_GET['msg'])) {
                                    echo '<div class="alert alert-info" role="alert">';
                                    echo $_GET['msg'];
                                    echo '</div>';
                                }
                                if (isset($_GET['error'])) {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $_GET['error'];
                                    echo '</div>';
                                }

                                ?>


                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Course Name</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="John"
                                            value="<?php echo  $_SESSION['course_name'];  ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Course Id</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="John"
                                            value="<?php echo $_SESSION['course_id'];  ?>" disabled>
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Course Start Year</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo $_SESSION['course_started_year']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Batch Number</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo  $_SESSION['course_batch'];  ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Course Duration</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo  $_SESSION['course_duration'];  ?>" maxlength="10"
                                            disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Course Cost</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo  $_SESSION['course_cost']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Course Status</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo   $_SESSION['course_status']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Course Registration Date</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo  $_SESSION['course_start_date']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Your Email</label>
                                        <input type="text" class="form-control form-control-lg"
                                            value="<?php echo  $_SESSION['student_email']; ?>" disabled>
                                    </div>
                                </div>



                                <div class="col-12 text-center mt-4">
                                    <a href="student_view_course_details.php"
                                        class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
                                        BACK</a>

                                    <button type="button" class="btn btn-lg btn-block btn-light lift text-uppercase"
                                        name="print_details" onclick="window.print()">PRINT</button>

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