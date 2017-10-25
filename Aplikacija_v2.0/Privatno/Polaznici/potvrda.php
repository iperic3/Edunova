<?php include_once '../../konfiguracija.php'; provjeraLogin(); 
if(isset($_GET["polaznik_id"])){
	//izvlažim iz baze sve podatke prema danoj šifri
	$izraz=$veza->prepare("select * from polaznik where polaznik_id=:polaznik_id");
	$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"]));
	//instanca klase stdClass koji sadrži sve podatke o smjeru iz baze
	$entiteti = $izraz->fetchAll(PDO::FETCH_OBJ);
}else{
	header("location: index.php");
}
		
if(count($entiteti)!==0){
		$veza->beginTransaction();
		$izraz=$veza->prepare("select * from polaznik where polaznik_id=:polaznik_id");
		$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"] ));
		$osobe = $izraz->fetchColumn();
		$izraz=$veza->prepare("delete from polaznik where polaznik_id=:polaznik_id");
		$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"] ));
		
		$veza->commit();
		
		
		if(file_exists("../../img/polaznici/" . $_GET["polaznik_id"] . ".jpg")){
			unlink("../../img/polaznici/" . $_GET["polaznik_id"] . ".jpg");
		}
		
		header("location: index.php");
	}