<?php 
session_start();

if(!isset($_SESSION["logiran"])){
	header("location: ../login.php?nemateOvlasti");
	exit;
}
?>
logiran si