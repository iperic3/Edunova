<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["predavac_id"])){
	$izraz=$veza->prepare("delete from predavac where predavac_id=:predavac_id");
	$izraz->execute(array("predavac_id"=>$_GET["predavac_id"]));
	
	$uvjet="";
	if(isset($_GET["uvjet"])){
		$uvjet =$_GET["uvjet"];
	}
	
	header("location: index.php?uvjet=" . $uvjet);
}
