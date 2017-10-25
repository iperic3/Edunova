<?php
include_once 'konfiguracija.php';
if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"])){
	header("location: " . $putAplikacije . "index.php");
}
//spajanje na bazu
if(!isset($_POST["korisnik"]) || !isset($_POST["korisnik"]));
$izraz=$veza->prepare("select * from osoba where email=:email and lozinka=md5(:lozinka)");

$izraz->execute(array("email"=>$_POST["korisnik"], "lozinka" =>$_POST["lozinka"]));

$osoba = $izraz->fetch(PDO::FETCH_OBJ);

if($osoba!=null){
	$_SESSION["logiran"]=$osoba;
	header("location: " . $putAplikacije . "Privatno/nadzornaPloca.php");
}
else{
	header("location: " . $putAplikacije . "Javno/login.php?neuspio&korisnik=" . $_POST["korisnik"]);
}