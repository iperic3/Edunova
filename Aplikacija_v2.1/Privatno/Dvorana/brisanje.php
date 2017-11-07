<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["dvorana_id"])){
	$izraz=$veza->prepare("delete from dvorana where dvorana_id=:dvorana_id");
	$izraz->execute(array("dvorana_id"=>$_GET["dvorana_id"]));
	
	$uvjet="";
	if(isset($_GET["uvjet"])){
		$uvjet =$_GET["uvjet"];
	}
	
	header("location: index.php?uvjet=" . $uvjet);
}
