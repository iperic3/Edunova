<?php include_once '../../konfiguracija.php'; provjeraLogin(); provjeraUloga("predavac");
if(isset($_GET["polaznik_id"])){
	$izraz=$veza->prepare("delete from polaznik where polaznik_id=:polaznik_id");
	$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"]));
	header("location: index.php");
}
