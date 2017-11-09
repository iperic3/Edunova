<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["predmet_id"])){
	$izraz=$veza->prepare("delete from predmet where predmet_id=:predmet_id");
	$izraz->execute(array("predmet_id"=>$_GET["predmet_id"]));
	
	$uvjet="";
	if(isset($_GET["uvjet"])){
		$uvjet =$_GET["uvjet"];
	}
	
	header("location: index.php?uvjet=" . $uvjet);
}
