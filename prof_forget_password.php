<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PROFESSOR FORGET PASSWORD</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
    <style>
    body {
        background-color: rgb(194, 153, 240);
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


                        <div
                            class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0  text-light"
                                style="max-width: 32rem;background-color:rgb(148, 77, 255)">
                                <!-- Form -->
                                <form class="row g-1 p-4 p-md-4" action="prof_forget_password_submit.php" method="POST">

                                    <h1 class="col-12 text-center ">Change Forget Password</h1>

                                    <?php
                                      if (isset($_GET['error'])) {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo $_GET['error'];
                                        echo '</div>';
                                    }

                                    ?>

                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">PROFESSOR ID</label>
                                            <input type="text" class="form-control form-control-lg" name="prof_id"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">PROFESSOR USER NAME</label>
                                            <input type="email" class="form-control form-control-lg" name="prof_username"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">NEW PASSWORD</label>
                                            <input type="password" class="form-control form-control-lg"
                                                name="new_password" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase"
                                            name="change">RESET PASSWORD</button>
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