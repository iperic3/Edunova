<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["polaznik_id"]) && isset($_GET["predmet_id"])){
	$izraz=$veza->prepare("delete from polaznik_predmet where polaznik_id=:polaznik_id and predmet_id=:predmet_id ");
	$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"],
						"predmet_id"=>$_GET["predmet_id"]));
}
header("location: index.php?uvjet=" . $uvjet);