<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "news-site";
$hostname = 'http://localhost/news-site/';

$conn = mysqli_connect($servername,$username,$password,$dbname);

if(!$conn){
    die("Connection Failed " . mysqli_connect_error());
}
// echo "Connection Successfully";
?>
