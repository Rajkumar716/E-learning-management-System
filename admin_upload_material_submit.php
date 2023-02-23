<?php
require_once("database_connection.php");

if(isset($_POST['material_upload'])){
      $material_name=$_POST['material_name'];
      $material_type=$_POST['material_type'];
      $subject_id=$_POST['subject_id'];
     
    $location="study_materials/";
    $file_new_name=date("dmy").time().$_FILES['file']['name'];
    $file_name=$_FILES['file']['name'];
    $file_temp=$_FILES['file']['tmp_name'];
    $file_size=$_FILES['file']['size'];
    if($file_size>262144000){

        header("location:admin_upload_study_Material.php?error=Fiel Size Too Large..");
 
    }else{
        $query="SELECT * FROM `study_material` WHERE material_file='$file_name' AND subject_id='$subject_id' AND material_type='$material_type' AND material_name='$material_name'";
        mysqli_query($connection,$query);
        if(mysqli_affected_rows($connection)==1){
            header("location:admin_upload_study_Material.php?error=This File Already Uploaded Under the same Subject Id And Same Material Type.....");
  
        }else{

            $upload_date=date("Y-m-d");
            $sql="INSERT INTO study_material(materail_id,material_name,material_type,material_file,new_material_file,subject_id,upload_date) 
            VALUES('NULL','$material_name','$material_type','$file_name','$file_new_name','$subject_id','$upload_date')";
            $result=mysqli_query($connection,$sql);
           
            if($result){
                move_uploaded_file($file_temp,$location.$file_new_name); 
               header("location:admin_upload_study_material.php?msg=Study Material has been Uploaded successfully.......");
            }else{
                header("location:admin_upload_study_material.php?error=Study Material has been Uploaded Failed.......");
            }
        }


    }

   
}


?>