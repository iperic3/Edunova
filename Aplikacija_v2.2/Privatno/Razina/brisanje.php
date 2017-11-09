<?php include_once '../../konfiguracija.php'; provjeraLogin(); 

if(isset($_GET["razina_id"])){
	$izraz=$veza->prepare("delete from razina where razina_id=:razina_id");
	$izraz->execute(array("razina_id"=>$_GET["razina_id"]));
	
	$uvjet="";
	if(isset($_GET["uvjet"])){
		$uvjet =$_GET["uvjet"];
	}
	
	header("location: index.php?uvjet=" . $uvjet);
}
