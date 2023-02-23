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
    <title>::ADMIN CHAT</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- plugin css file  -->
    <link rel="stylesheet" href="assets/plugin/parsleyjs/css/parsley.css">

    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
</head>

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

                                    $res = mysqli_query($connection, "select * from admin_registration where admin_email='$_SESSION[admingmail]'");
                                    while ($row = mysqli_fetch_array($res)) {
                                        echo " <p class='mb-0 text-end line-height-sm '><span class='font-weight-bold'>";
                                        echo $row["admin_fullname"];
                                        echo "</span></p>";
                                    }


                                    ?>
                                    <small>Admin Profile</small>
                                </div>
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="assets/images/profile_av.png" alt="profile">
                                </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- menu toggler -->
                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>

                        <!-- main menu Search-->
                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">

                        </div>

                    </div>
                </nav>
            </div>

            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xl">


                    <div class="row align-item-center">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">CHAT REGISTER</h6>
                                </div>
                                <?php

                                if (isset($_GET['msg'])) {
                                    echo '<div class="alert alert-success" role="alert">';
                                    echo $_GET['msg'];
                                    echo '</div>';
                                }
                                if (isset($_GET['error'])) {
                                    echo '<div class="alert alert-danger" role="alert">';
                                    echo $_GET['error'];
                                    echo '</div>';
                                }

                                ?>
                                <div class="card-body ">
                                    <form action="admin_chat_reg_submit.php" method="POST">
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-12">
                                                <label for="firstname" class="form-label">Enter Your ID</label>
                                                <input type="text" class="form-control" id="user_id" name="user_id" required>
                                            </div>
                                            <div class="col-md-12">
                                                <label for="lastname" class="form-label">Enter User Name</label>
                                                <input type="text" class="form-control" id="user_name" name="user_name" required>
                                            </div>

                                        </div>
                                        <div class="col-12 text-left mt-4">
                                            <button type="submit" class="btn btn-primary mt-4" name="create">CREATE</button>
                                        </div>
                                        <div class="col-12 text-center mt-4">
                                            <a href="admin_join_chat.php" class="btn btn-lg btn-block btn-primary lift text-uppercase"><span>&#10237;</span>
                                                BACK</a>
                                        </div>
                                    </form>
                                    </sdiv>
                                </div>

                            </div>
                        </div><!-- Row end  -->

                    </div>
                </div>



            </div>

        </div>

        <!-- Jquery Core Js -->
        <script src="assets/bundles/libscripts.bundle.js"></script>

        <!-- Plugin Js-->
        <script src="assets/plugin/parsleyjs/js/parsley.js"></script>


        <!-- Jquery Page Js -->
        <script src="../js/template.js"></script>
        <script>
            $(function() {
                // initialize after multiselect
                $('#basic-form').parsley();
            });
        </script>

</body>

</html>