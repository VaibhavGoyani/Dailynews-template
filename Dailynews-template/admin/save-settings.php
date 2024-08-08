<?php
include "config.php";

if(empty($_FILES['logo']['name'])){
  $file_name = $_POST['old_logo'];
}else{
  $errors = array();

  $file_name = $_FILES['logo']['name'];
  $file_size = $_FILES['logo']['size'];
  $file_tmp = $_FILES['logo']['tmp_name'];
  $file_type = $_FILES['logo']['type'];
  $ext = explode('.',$file_name);
  $file_ext = end( $ext);
 
  $extensions = array("jpeg","jpg","png");

  if(in_array($file_ext,$extensions) === false)
  {
    $errors[] = "This extension file not allowed, Please choose a JPG or PNG file.";
  }

  if($file_size > 2097152){
    $errors[] = "File size must be 2mb or lower.";
  }


  // $new_name = time(). "-".basename($file_name);
  // $target = "images/".$new_name;
  // $image_name = $new_name;
  if(empty($errors) == true){
    move_uploaded_file($file_tmp,"images/".$file_name);
  }else{
    echo 'File Is Not Upload';
  }
}

$sql = "UPDATE settings SET websitename='{$_POST["website_name"]}',logo='{$file_name}',footerdesc='{$_POST["footer_desc"]}'";

$result = mysqli_query($conn,$sql);

if($result){
  header("location:settings.php");
}
  
?>
