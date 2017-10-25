<?php
include_once '../../konfiguracija.php'; provjeraLogin();

if(isset($_GET["polaznik_id"])){
$izraz=$veza->prepare("select a.polaznik_id, a.ime, a.prezime, a.oib, a.email, a.lozinka, c.naziv, d.obrazovanje
 from polaznik a
 inner join polaznik_predmet b on a.polaznik_id=b.polaznik_id
 inner join predmet c on c.predmet_id=b.predmet_id
 inner join razina d on d.razina_id=c.razina_id
 where a.polaznik_id=:polaznik_id");
$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"]));
$entitet = $izraz->fetch(PDO::FETCH_OBJ);
}
else{
	header("location:index.php");
}

if(isset($_POST["promjena"])){
	$veza->beginTransaction();

	// $izraz=$veza->prepare("update predmet set naziv=:naziv where predmet_id=:predmet_id");
	// $izraz->execute(array("naziv"=>$_POST["naziv"],
						// "predmet_id"=>$_POST["polaznik_id"]));
// 	
	// $izraz=$veza->prepare("update razina set obrazovanje=:obrazovanje where razina_id=:razina__id");
	// $izraz->execute(array("naziv"=>$_POST["naziv"],
						// "razina_id"=>$_POST["razina_id"]));
	
	$izraz=$veza->prepare("update polaznik set ime=:ime,prezime=:prezime,oib=:oib, email=:email 
	where polaznik_id=:polaznik_id");
	$izraz->execute(array("ime"=>$_POST["ime"],
						"prezime"=>$_POST["prezime"],
						"oib"=>$_POST["oib"],
						"email"=>$_POST["email"],
						"polaznik_id"=>$_POST["polaznik_id"]
						));
	$veza->commit();
	}
if(isset($_FILES["slika"])){
	move_uploaded_file($_FILES["slika"]['tmp_name'], "../../img/polaznici/".$_POST["polaznik_id"].".jpg");

header("location:index.php");
}
if(isset($_POST["odustani"])){
	if($_POST["ime"]=="" && $_POST["prezime"]=="" && $_POST["email"]=="" && $_POST["lozinka"]==""){
			$veza->beginTransaction();
			$izraz=$veza->prepare("select * from polaznik where polaznik_id=:polaznik_id");
			$izraz->execute(array("polaznik_id"=>$_POST["polaznik_id"]));
			
			$izraz=$veza->prepare("delete from polaznik where polaznik_id=:polaznik_id");
			$izraz->execute(array("polaznik_id"=>$_POST["polaznik_id"]));
			$veza->commit();
		}
	header("location:index.php");
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../../Predlosci/glava.php';
		?>
	</head>
	<body>
		<header>
			<?php
			include_once '../../Predlosci/zaglavlje.php';
			?>
			<?php
				include_once '../../Predlosci/izbornik.php';
			?>
		</header>
		<div class="row">
			<div class="large-4 columns large-centered">
					<form method="POST" enctype="multipart/form-data">
						
						<fieldset class="fieldset">
							<legend>Unosni podaci</legend>
							
							<label for="slika">Slika (u jpg formatu)</label>
							<input type="file" id="slika" name="slika" />
							
							<?php 
							if(file_exists("../../img/polaznici/" . $entitet->polaznik_id . ".jpg")){
							 ?>
								<img src="<?php echo $putanjaAPP . "img/polaznici/" . $entitet->polaznik_id . ".jpg"; ?>" alt="" />
							 <?php
							}
							?>

							<label for="ime">Ime</label>
							<input 	name="ime" id="ime" value="<?php echo $entitet->ime; ?>" type="text" />
							
							<label for="prezime">Prezime</label>
							<input 	name="prezime" id="prezime" value="<?php echo $entitet->prezime; ?>" type="text" />
							
							<label for="oib">OIB</label>
							<input 	name="oib" id="oib" value="<?php echo $entitet->oib; ?>" type="text" />
							
							<label for="email">Email</label>
							<input name="email" id="email" type="text" value="<?php echo $entitet->email; ?>" />
							
							<label for="kor_ime">Lozinka</label>
							<input name="lozinka" id="lozinka" type="text" value="<?php echo $entitet->lozinka; ?>" />
							
							<label for="naziv">Predmet</label>
							<input name="naziv" id="naziv" type="text" value="<?php echo $entitet->naziv; ?>" />
							
							<label for="obrazovanje">Razina</label>
							<input name="obrazovanje" id="obrazovanje" type="text" value="<?php echo $entitet->obrazovanje; ?>" />
							
							<input name="promjena" type="submit" class="button expanded" 
							value="<?php if($entitet->ime=="" && $entitet->prezime=="" && $entitet->oib="" && $entitet->email==""){
								echo "Dodaj novi";
							}else{
								echo "Promjeni";
							}
							?>"
							 />
							
							<input type="hidden" name="polaznik_id" value="<?php echo $entitet->polaznik_id; ?>" />
							
							<input name="odustani" type="submit" class="alert button expanded" value="Odustani"/>
							
						</fieldset>
						
					</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	</body>
</html>
