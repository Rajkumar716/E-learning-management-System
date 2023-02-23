<?php
session_start();
require("database_connection.php");
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

    <title>ADMIN ADD NEW BATCH DETAILS</title>
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
                                <!-- Form -->
                               
                                <?php
                                if (isset($_POST['search'])) {
                                    $select_query = "SELECT * FROM professor_registration WHERE teach_degree='$_POST[course_name]'";
                                    $select_result = mysqli_query($connection, $select_query);
                                    while ($select_row = mysqli_fetch_assoc($select_result)) {
                                        $prof_name = $select_row['prof_fullname'];
                                        $_SESSION['prof_fullname'] = $prof_name;
                                    }


                                    $select_query = "SELECT * FROM batch_details WHERE course_name='$_POST[course_name]'";
                                    $select_result = mysqli_query($connection, $select_query);
                                    while ($select_row = mysqli_fetch_assoc($select_result)) {
                                        $start_year = $select_row['batch_start_year'];
                                        $_SESSION['batch_start_year'] = $start_year;
                                        $batch_number=$select_row['batch_number'];
                                        $_SESSION['batch_number']=$batch_number;


                                    }
                                }

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
                                <form class="row g-1 p-6 p-md-6" action="admin_add_batch_submit.php" method="POST">
                                   
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Course </label>
                                            <select name="course_name" class="form-control form-control-lg ">
                                            <option value="" selected disabled>-----Choose Course-----</option>
                                            <?php
                                            $res = mysqli_query($connection, "select course_name from course_details");
                                            while ($row = mysqli_fetch_array($res)) {
                                                $course_name = $row["course_name"];
                                                $_SESSION['course_name'] =  $course_name;

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
                                            <label class="form-label">Choose Course Batch</label>
                                            <select name="course_batch" class="form-control form-control-lg" required>
                                                <option value="" selected disabled>-----Course Batch-----</option>
                                                <option value="BN001">BN001</option>
                                                <option value="BN002">BN002</option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Course Start Year</label>
                                            <select name="course_year" id="cars" class="form-control form-control-lg ">
                                            
                                                <option value="" selected disabled>-----Batch Year-----</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>
                                                <option value="2027">2027</option>
                                                <option value="2028">2028</option>
                                                <option value="2029">2029</option>
                                                <option value="2030">2030</option>
                                                <option value="2031">2031</option>
                                                <option value="2032">2032</option>
                                                <option value="2033">2033</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">SET SEAT COUNT</label>
                                            <input type="text" class="form-control form-control-lg" name="seat_count"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="3" required>
                                        </div>
                                    </div>
                              

                                 
                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="add_batch">ADD</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <a href="admin_view_batch_details.php" class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
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