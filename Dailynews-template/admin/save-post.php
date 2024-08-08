<?php
include "config.php";

if (isset($_FILES['fileToUpload'])) {
  $errors = array();

  // echo '<pre>';
  // print_r($_FILES);
  // die();

  $file_name = $_FILES['fileToUpload']['name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
  $file_size = $_FILES['fileToUpload']['size'];

  $file_ext = strtolower(end(explode('.', $file_name)));
  $extentions = array("jpeg", "jpg", "png");

  if (in_array($file_ext, $extentions) === false) {
    $errors[] = "this img is not allowed , please choose a jpg or png";
  }

  if ($file_size > 2097152) {
    $errors[] = "file size must be 2 mb lower";
  }

  $new_name = time(). "-".basename($file_name);
  $target = "upload/". $new_name;

  if (empty($errors) == true) {
    move_uploaded_file($file_tmp,$target);
  } else {
    echo '<div class="alert alert-danger">File Is Not Upload.</div>';
  }
}

session_start();

$title = $_POST['post_title'];
$description = $_POST['postdesc'];
$category = $_POST['category'];
$date = date('d M, Y');
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post(title,description,category,post_date,author,post_img)VALUES('{$title}','{$description}',{$category},'{$date}',{$author},'{$new_name}');";

$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

if (mysqli_multi_query($conn, $sql)) {
  header("location:post.php");
} else {
  echo '<div class="alert alert-danger">query failed.</div>';
}
