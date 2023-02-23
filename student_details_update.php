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

    <title>STUDENT DETAIL UPDATE</title>
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



                    <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                        <div class="w-100 p-6 p-md-8 card border-0  text-light" style="max-width: 32rem;background-color:rgb(148, 77, 255)">
                            <!-- Form -->
                            <form class="row g-1 p-4 p-md-4" action="student_details_update_submit.php" method="POST">

                                <h1 class="col-12 text-center mb-1 mb-lg">Details Update</h1>
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
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="John" name="student_name" value="<?php echo $_SESSION['student_fullname'];  ?>" required>
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="MM/DD/YYYY" name="student_dob" value="<?php echo  $_SESSION['student_dob']; ?>" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control form-control-lg" name="student_address" value="<?php echo $_SESSION['student_address'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control form-control-lg" name="student_number" 
                                        value="<?php echo $_SESSION['student_phonenumber'];  ?>" maxlength="10"
                                           required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-2">
                                        <label class="form-label">Passport number</label>
                                        <input type="text" class="form-control form-control-lg" name="student_number" 
                                        value="<?php echo $_SESSION['student_phonenumber'];  ?>" maxlength="10"
                                           required>
                                    </div>
                                </div>


                                <div class="col-12 text-center mt-4">

                                    <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="update_details">UPDATE</button>
                                </div>
                                <div class="col-12 text-center mt-4">
                                    <a href="student_view_details.php" class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
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