<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ACCOUNT CHOOSE</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
    <style>
    body {
        background-color: rgb(172, 0, 230);
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

                    <div class="row g-0">
                        <div
                            class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">

                                <div class="mb-5">
                                    <h2 class="color-900 text-center">SELECT YOUR ACCOUNT HERE</h2>
                                </div>
                                <!-- Image block -->
                                <div class="mb-5">
                                    <img src="assets/images/jason-goodman-0K7GgiA8lVE-unsplash.jpg" alt="login-img"
                                        style="width: 450px;">
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0  text-light"
                                style="max-width: 32rem;background-color:rgb(191, 0, 255)">
                                <!-- Form -->
                                <form class="row g-1 p-3 p-md-4" method="POST" action="admin_login_submit.php">
                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>SELECT ACCOUNT</h1>
                                        <span>Free access to our system.</span>
                                    </div>


                                    <div class="col-12 text-center mt-6">
                                        <div class="d-grid gap-2">

                                            <a href="admin_login.php" class=" btn btn-light btn-lg">ADMIN ACCOUNT</a>
                                        </div></br>
                                    </div></br></br>

                                    <div class="col-12 text-center mt-6">
                                        <div class="d-grid gap-2">

                                            <a href="prof_login.php" class=" btn btn-light btn-lg">PROFESSOR ACCOUNT</a>
                                        </div></br>
                                    </div></br></br>

                                    <div class="col-12 text-center mt-6">
                                        <div class="d-grid gap-2">

                                            <a href="student_login.php" class=" btn btn-light btn-lg">STUDENT
                                                ACCOUNT</a>
                                        </div></br>
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