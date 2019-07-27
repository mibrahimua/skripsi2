<?php
require_once('/algoritma/population.php');

/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//var_dump($_SESSION);
if($_SESSION['nama_user']){
	//header('location:index.php');
}else{
	header("location:login.php");
}
*/
?>
<!DOCTYPE html>
<html lang="id">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Penjadwalan Pemeliharaan Komputer <?php echo @$_GET['hlm'];?></title>

	<link rel="stylesheet" href="lib/css/bootstrap.css">

	<link rel="stylesheet" href="lib/css/font-awesome.min.css">

	<link rel="stylesheet" href="lib/css/style.css">

	<script src="lib/jquery.min.js"></script>

	<script src="lib/bootstrap.min.js"></script>
</head>
<body style="background-color: GhostWhite">
<a href="index.php">Halaman Utama</a>
<a href="lihat_jadwal.php">Lihat Jadwal</a>
