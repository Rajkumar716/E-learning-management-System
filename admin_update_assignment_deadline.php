<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

    <title>ADMIN:: UPDATE ASSIGNMENT DATE</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">
    <style>
        body {
            background-color: rgb(170, 128, 255);
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
                            <?php
                            $update_id=$_POST['id'];
                            
                            $query="SELECT * FROM `course_assignment_set` WHERE id='$update_id'";
                            $result=mysqli_query($connection,$query);
                            while($row=mysqli_fetch_assoc($result)){
                                $deadline_date=$row['deadline_date'];
                                $_SESSION['deadline_date']=$deadline_date;
                                $update_date=$row['id'];
                                $_SESSION['id']=$update_date;
                            }

                               

                              ?>
                                <!-- Form -->
                                <form class="row g-6 p-3 p-md-4" method="POST" action="">

                                    <div class="col-12 text-center mb-1 mb-lg-5">
                                        <h1>Change Dead-Line Date</h1>

                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Choose Date</label>
                                            <input type="date" class="form-control form-control-lg" placeholder="MM/DD/YYYY" value="<?php echo $deadline_date; ?>" name="change_date" required>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" name="update_date">Update Date</button>
                                    </div>



                                </form>
                                <?php
                                if(isset($_POST['update_date'])){
                                    $query1="UPDATE `course_assignment_set` SET `deadline_date` = '{$_POST['change_date']}' WHERE `course_assignment_set`.`id` ={$_SESSION['id']}";
   
                                    mysqli_query($connection,$query1);
                                //    echo  mysqli_affected_rows($connection);
                                   if(mysqli_affected_rows($connection)==1){
                                       header('location:admin_view_assginment_set.php?msg=Dead-Line Date update successful');
                                
                                   }elseif(mysqli_affected_rows($connection)==0){
                                    header('location:admin_view_assginment_set.php?msg=Dead-Line Date is up-to-date');
                                
                                   }
                                }


                                ?>
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