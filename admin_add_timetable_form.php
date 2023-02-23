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

    <title>ADMIN TIME TABLE ADD</title>
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
                                <form action="" class="row g-1 p-6 p-md-6" method="POST" id="myform">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1 class="col-12 text-center ">New Time Table</h1>

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
                                            <option value="" selected disabled>-----Choose Course-----</option>
                                            <?php
                                            $res = mysqli_query($connection, "select course_name from batch_details where batch_status='Activate'");
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
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-lg btn-block btn-primary lift text-uppercase " name="search" id="search">Search</button>
                                    </div>
                                </form>
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


                                $_SESSION['prof_name'] = $_POST['prof_name'];

                                ?>
                                <form class="row g-1 p-6 p-md-6" action="admin_timetable_submit.php" method="POST">
                                    <input    type="hidden" name="course_name" value="<?php echo $_POST['course_name'] ?>"></input>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Professor Name</label>
                                            <select name="prof_name" class="form-control form-control-lg ">
                                            <option value="" selected disabled>-----Choose Professor----</option>
                                            <?php
                                            $res = mysqli_query($connection, "select prof_fullname from professor_registration where teach_degree='$_POST[course_name]'");
                                            while ($row = mysqli_fetch_array($res)) {
                                                

                                                echo "<option value='$row[prof_fullname]'>";
                                                echo $row["prof_fullname"];
                                                echo "</option>";
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Course Start Year</label>
                                            <select name="course_year" id="cars" class="form-control form-control-lg ">
                                            <option value="" selected disabled>-----Course Start Year---</option>
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
                                            <select name="batch_name" id="cars" class="form-control form-control-lg ">
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
                                            <label class="form-label">Choose Teach Subject</label>

                                            <select name="subject_name" class="form-control form-control-lg" required>
                                                <option value="" selected disabled>-----Select Subject-----</option>
                                                <option value="MATHS">MATHS</option>
                                                <option value="PROGRAMMING">PROGRAMMING</option>
                                                <option value="WEB DEVELOPMENT">WEB DEVELOPMENT</option>
                                                <option value="SOFTWARE DEVELOPMENT">SOFTWARE DEVELOPMENT</option>
                                                <option value="DATA STRUCTURE">DATA STRUCTURE</option>
                                                <option value="DATA MODELING">DATA MODELING</option>
                                                <option value="AI">AI</option>
                                                <option value="NETWORKING">NETWORKING</option>
                                                <option value="MOBILE DELVELOPMENT">MOBILE DELVELOPMENT</option>
                                                <option value="MULTI MEDIA">MULTI MEDIA</option>
                                                <option value="CYBER SECURITY">CYBER SECURITY</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">DATE</label>
                                            <input type="date" class="form-control form-control-lg" name="date" placeholder="eg:2022-01-20" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">START TIME</label>
                                            <input type="time" class="form-control form-control-lg" name="start_time" placeholder="eg:8:00:00" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">END TIME</label>
                                            <input type="time" class="form-control form-control-lg" name="end_time" placeholder="eg:8:00:00" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="add_table">ADD</button>
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