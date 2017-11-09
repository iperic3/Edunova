<?php include_once '../../konfiguracija.php'; provjeraLogin(); 
print_r($_GET);
if(isset($_GET["polaznik_id"])){
	
	$izraz=$veza->prepare("delete from polaznik where polaznik_id=:polaznik_id");
	$izraz->execute(array("polaznik_id"=>$_GET["ppolaznik_id"]));
	
	$uvjet="";
	if(isset($_GET["uvjet"])){
		$uvjet =$_GET["uvjet"];
	}
	
	header("location: index.php?uvjet=" . $uvjet);
}
