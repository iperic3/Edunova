<?php
include_once 'konfiguracija.php';
if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"])){
	header("location: " . $putAplikacije . "index.php");
}

//tu ide spajanje na bazu
if($_POST["korisnik"]=="ivan" && $_POST["lozinka"]=="perić"){
	$_SESSION["logiran"]=$_POST["korisnik"];
	header("location: " . $putAplikacije . "Privatno/profil.php");
}
else{
	header("location: " . $putAplikacije . "Javno/login.php?neuspio&korisnik=" . $_POST["korisnik"]);
}