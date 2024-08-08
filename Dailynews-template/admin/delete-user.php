<?php
include "config.php";

if($_SESSION['user_role'] == 0){
    header("location:post.php");
}

$d_id = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id = '{$d_id}'";
$result = mysqli_query($conn,$sql);

if(mysqli_query($conn,$sql)){
    header("location:users.php");
    }
?>
