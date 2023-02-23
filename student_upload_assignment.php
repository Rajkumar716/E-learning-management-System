<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
require_once('database_connection.php');
// //  echo $_SESSION["admingmail"];
//  if(!isset($_SESSION['admingmail'])){
//     header("location:admin_login.php");
// }

$res=mysqli_query($connection,"select * from course where 	curse_login_username='$_SESSION[coursegmail]'");
while($row=mysqli_fetch_array($res)){

$studentid=$row["student_id"];
$_SESSION['student_id']=$studentid;

$course_id=$row['course_id'];
$_SESSION['course_id']=$course_id;


}



?>

<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>STUDENT UPLOAD ASSIGNMENT</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
    <!-- project css file  -->
    <link rel="stylesheet" href="assets/css/my-task.style.min.css">

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

                                <?php
                                
                                    $subjectid=$_POST['id'];
                                    $query="SELECT * FROM `course_assignment_set` WHERE id='$subjectid'";
                                    $result=mysqli_query($connection,$query);
                                    
                                    while($row=mysqli_fetch_assoc($result)){
                                                $subject_id=$row['subject_id'];
                                                $_SESSION['subject_id']=$subject_id;
                                                 $subject_name=$row['subject_name'];
                                                $_SESSION['subject_name']=$subject_name;
                                                $deadlinedate=$row['deadline_date'];
                                                $_SESSION['deadline_date']=$deadlinedate;
                                               $course_name=$row['course_name'];
                                               $_SESSION['course_name']=$course_name;

                                    }

                              

                              
                                $day=$deadlinedate;
                                $time=date('00:00:00');
                                $date_today=$day." ".$time;


                                ?>
                                <!-- Form -->
                                <form class="row g-1 p-4 p-md-4" action="student_upload_assignment_submit.php"
                                    method="POST" id="myform" enctype="multipart/form-data">

                                    <h1 class="col-12 text-center ">STUDENT UPLOAD ASSIGNMENT</h1>


                                    <?php
                                         if(session_status()==PHP_SESSION_NONE){
                                         session_start();
                                         }
                                        if(isset($_SESSION['data_error'])){
                                         //    print_r($_SESSION['data_error']);
                                        foreach($_SESSION['data_error'] as $d_error){
                        
                                                echo '<div class="alert alert-danger" role="alert">' ;
                                                echo $d_error;
                                               echo '</div>' ;
                                        }
                                      unset($_SESSION['data_error']);
                                     }
                                      echo "<hr>";
                                      if(isset($_SESSION['form_data'])){
                                            // print_r($_SESSION['form_data']);
                                          //  unset($_SESSION['form_data']);
                                          }

                                    ?>

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Subject Id</label>
                                            <input type="text" class="form-control form-control-lg" name="subject_id"
                                                id="subject_id" value="<?php echo $subjectid;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Subject Name</label>
                                            <input type="text" class="form-control form-control-lg" name="subject_name"
                                                id="subject_name" value="<?php echo $subject_name;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Course Name</label>
                                            <input type="text" class="form-control form-control-lg" name="course_name"
                                                id="course_name" value="<?php echo $course_name;  ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <label class="form-label">Student Course Id</label>
                                            <input type="text" class="form-control form-control-lg" name="course_id"
                                                id="course_id" value="<?php echo $course_id; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">File</label>
                                            <input type="file" class="form-control form-control" name="file" required>
                                        </div>
                                    </div>


                                    <div class="col-12 text-center mt-4">

                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase"
                                            name="upload" id="buttonclick">UPLOAD</button>
                                    </div></br>

                                    <div>
                                        <a href="student_assignment_upload.php"
                                            class="btn btn-lg btn-block btn-light lift text-uppercase"><span>&#10237;</span>
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
<script>
var count_id = "<?php echo $date_today; ?>";

var countdowndate = new Date(count_id).getTime();
var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countdowndate - now;

    var day = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);




    if (distance < 0) {
        clearInterval(x);

        const button = document.querySelector('#buttonclick');
        button.disabled = true;
    }
}, 1000);
</script>

</html>