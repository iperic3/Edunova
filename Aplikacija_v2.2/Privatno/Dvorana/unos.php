<?php
include_once '../../konfiguracija.php'; provjeraLogin();
$greske=array();
if(isset($_POST["naziv_dvorane"])){
	if(trim($_POST["naziv_dvorane"])==""){
	$greske["naziv_dvorane"]="Obavezno unijeti naziv";
	}
	if(count($greske)==0){
		$izraz=$veza->prepare("insert into dvorana (naziv_dvorane, kapacitet) values (:naziv_dvorane,:kapacitet)");
		$unos=$izraz->execute($_POST);
		header("location:index.php");
}
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
							
							<label for="naziv_dvorane">Naziv dvorane</label>
							<input
							 <?php 
							 if(isset($greske["naziv_dvorane"])){
								 echo "style=\"background-color:red\" ";
							 }
							 ?> 
							name ="naziv_dvorane" id="naziv_dvorane" value="
							<?php echo isset($_POST["naziv_dvorane"]) ? $_POST["naziv_dvorane"] : "";?>" 
							type="text" autofocus="autofocus" />
							
							<label for="kapacitet">Kapacitet</label>
							<input 	name="kapacitet" id="kapacitet" type="number" />
							
							<input type="submit" class="button expanded" value="Dodaj" />
							
							<a href="index.php" class="alert button expanded">Odustani</a>
							<?php if(isset($unos) && $unos>0):?>
								<h1 id="Unio" class="success button expanded">Uspješno dodano</h1>
							<?php endif;?>
						</fieldset>
						
					</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	