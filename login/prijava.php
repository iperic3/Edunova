<?php

print_r($_POST);

if($_POST["korisnik"]=="ivan" && $_POST["lozinka"]=="peric"){
	//logiran si
	session_start();
	$_SESSION["logiran"]=$_POST["korisnik"];
	header("location: private/nadzor.php");
}else{
	//nisi logiran
	header("location: login.php?neuspio&korisnik=" . $_POST["korisnik"]);
}
