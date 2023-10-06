<?php
require('connection.php');
session_start();
$username = $_SESSION['username'];


$sql1 = "SELECT * FROM users_candidate  WHERE username='$username' ";
$query1 = mysqli_query($con, $sql1);
$result_fetch1 = mysqli_fetch_assoc($query1);
$row1 = mysqli_num_rows($query1);
