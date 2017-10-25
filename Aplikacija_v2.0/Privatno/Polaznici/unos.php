<?php

include_once '../../konfiguracija.php'; provjeraLogin();

if(isset($_POST["email"])){
	
		$izraz=$veza->prepare("insert into polaznik(ime,prezime,email,lozinka,) 
		values (:ime,:prezime,:email,md5(:lozinka))");
		$entitet = $izraz->execute($_POST);
		header("location: index.php");
}
// $zadnji = $veza->lastInsertId();
// 
// 
// header("location: promjena.php?polaznik_id=" . $zadnji);

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
							<input 	name="ime" id="ime" type="text" />
							
							<label for="prezime">Prezime</label>
							<input 	name="prezime" id="prezime" type="text" />
							
							<label for="oib">OIB</label>
							<input 	name="oib" id="oib" type="text"/>
							
							<label for="email">Email</label>
							<input name="email" id="email" type="text"/>
							
							<label for="kor_ime">Lozinka</label>
							<input name="lozinka" id="lozinka" type="text" />
														
							<label for="obrazovanje">Razina</label>
							<select id="obrazovanje" name="obrazovanje">
								<option value="razina_id">Osnovna škola</option>
								<option value="razina_id">Srednja škola</option>
								<option value="razina_id">Građevinski fakultet</option>
								<option value="razina_id">Elektrotehnički fakultet</option>
							</select>
							
							<label for="predmet">Predmet</label>
							<select id="predmet" name="predmet">
								<option value="predmet_id">Fizika</option>
								<option value="predmet_id">Matematika</option>
								<option value="predmet_id">Statistika</option>
							</select>
													
							<input type="submit" class="button expanded" value="Dodaj" />
							
							<input name="odustani" type="submit" class="alert button expanded" value="Odustani"/>
							
						</fieldset>
						
					</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	