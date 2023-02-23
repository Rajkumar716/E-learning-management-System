<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('database_connection.php');

 $prof_id = $_POST['prof_id'];
 $_SESSION['prof_id']=$prof_id;
$query="SELECT * FROM professor_registration WHERE prof_id='$prof_id'";
$query_result=mysqli_query($connection,$query);
while($row=mysqli_fetch_assoc($query_result)){
    $prof_name=$row['prof_fullname'];
    $_SESSION['prof_fullname']=$prof_name;

    $prof_email=$row['prof_email'];
    $_SESSION['prof_email']=$prof_email;

    $prof_address=$row['prof_address'];
    $_SESSION['prof_address']=$prof_address;

    $prof_phone=$row['prof_phone'];
    $_SESSION['prof_phone']=$prof_phone;

    $prof_dob=$row['prof_dob'];
    $_SESSION['prof_dob']=$prof_dob;

    $prof_nic=$row['prof_nic'];
    $_SESSION['prof_nic']=$prof_nic;

    $teach_degree=$row['teach_degree'];
    $_SESSION['teach_degree']=$teach_degree;
}

?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ASMIN::STUDENT DETAIL UPDATE</title>
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
                            <form class="row g-1 p-4 p-md-4" action="admin_prof_details_update_submit.php" method="POST">

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
                                        <label class="form-label">Professor Name</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="John" name="prof_name" value="<?php echo $_SESSION['prof_fullname'];  ?>" required>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Professor Email</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="John" name="prof_email" value="<?php echo $_SESSION['prof_email'];  ?>" required>
                                    </div>
                                </div>
                                
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control form-control-lg" placeholder="MM/DD/YYYY" name="prof_dob" value="<?php echo  $_SESSION['prof_dob']; ?>" required>
                                    </div>
                                </div>
                               
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control form-control-lg" name="prof_number" 
                                        value="<?php echo $_SESSION['prof_phone'];  ?>"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="10"
                                           required>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Professor Nic</label>
                                        <input type="text" class="form-control form-control-lg" name="prof_nic" 
                                        value="<?php echo $_SESSION['prof_nic'];  ?>"   maxlength="10"
                                           required>
                                    </div>
                                </div>
                               
                                <div class="col-6">
                                    <div class="mb-2">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control form-control-lg" name="prof_address" value="<?php echo $_SESSION['prof_address'];  ?>" required>
                                    </div>
                                </div>
                                <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Professor Type</label>

                                            <select name="prof_time" class="form-control form-control-lg " required>
                                                <option value="" selected disabled>-----Select Type-----</option>
                                                <option value="FULL-TIME" >FULL TIME</option>
                                                <option value="PART-TIME" >PART TIME</option>
                                            </select>
                                        </div>
                                    </div>



                                <div class="col-12 text-center mt-4">

                                    <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="update_details">UPDATE</button>
                                </div>
                                <div class="col-12 text-left mt-4">
                                    <a href="admin_view_prof_details.php" class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
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