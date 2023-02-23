<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require("database_connection.php");
$id = $_POST['id'];


?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>DOWNLOAD MATERIAL</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
    <style>
        body {
            background-color: rgb(204, 153, 255);
        }
    </style>
</head>

<body>

    <div id="mytask-layout" class="theme-indigo">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">

            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">


                    <div class="row g-12">

                        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0  text-light" style="max-width: 32rem;background-color:rgb(148, 77, 255)">
                                <!-- Form -->
                                <form class="row g-6 p-3 p-md-4" method="POST" action="">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>DOWNLOAD</h1>

                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <?php
                                        $sql = "SELECT * FROM course_subject_assignments WHERE id='$id'";
                                        $result = mysqli_query($connection, $sql);
                                        if (mysqli_num_rows($result) > 0) {
                                            if ($row = mysqli_fetch_assoc($result)) {
                                                $file_name = $row['new_file'];
                                                $_SESSION['new_file'] = $file_name;
                                        ?>
                                                <h3><?php echo $file_name;  ?></h3>
                                                <a href="uploads/<?php echo $row['new_file'];  ?>" download class="btn btn-lg btn-block btn-light lift text-uppercase">Download</a></br></br>
                                        <?php
                                            }
                                        }


                                        ?>
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
    <script src="../assets/bundles/libscripts.bundle.js"></script>

</body>

</html>