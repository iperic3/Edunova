<?php
include_once '../../konfiguracija.php'; provjeraLogin();
$greske=array();
if(isset($_POST["obrazovanje"])){
	if(trim($_POST["obrazovanje"])==""){
	$greske["obrazovanje"]="Obavezno unijeti naziv";
	}
	if(count($greske)==0){
		$izraz=$veza->prepare("insert into razina (obrazovanje) values (:obrazovanje)");
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
							
							<label for="obrazovanje">Razina obrazovanja</label>
							<input
							 <?php 
							 if(isset($greske["obrazovanje"])){
								 echo "style=\"background-color:red\" ";
							 }
							 ?> 
							name ="obrazovanje" id="obrazovanje" value="
							<?php echo isset($_POST["obrazovanje"]) ? $_POST["obrazovanje"] : "";?>" 
							type="text" autofocus="autofocus" />
							
							
							
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
	