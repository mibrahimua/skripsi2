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
	<link rel="stylesheet" href="lib/css/bootstrap.min.css">
	<script src="lib/js/bootstrap.min.js"></script>
	<script src="lib/js/jquery.min.js"></script>

    <!--
    <link rel="stylesheet" href="lib/css/gijgo.min.css"/>
	-->
	
	<link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
	<script src="lib/js/gijgo.min.js" type="text/javascript"></script>
    

</head>
<body style="background-color: GhostWhite">

	<?php include 'menu_navbar.php'; ?>
	

