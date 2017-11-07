<?php
include_once '../../konfiguracija.php'; provjeraLogin();
if(isset($_GET["dvorana_id"])){
	$izraz=$veza->prepare("select* from dvorana where dvorana_id=:dvorana_id");
	$izraz->execute(array("dvorana_id"=>$_GET["dvorana_id"]));
	$dvorana=$izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$dvorana->uvjet=$_GET["uvjet"];
	}
}

if(isset($_POST["dvorana_id"])){
	$uvjet="";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
		unset($_POST["uvjet"]);
	}
	$izraz=$veza->prepare("update dvorana set naziv_dvorane=:naziv_dvorane,
							kapacitet=:kapacitet where dvorana_id=:dvorana_id");
	$izraz->execute($_POST);
	header("location:index.php?uvjet=" . $uvjet);
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
							
							<label id= for="naziv_dvorane">Naziv dvorane</label>
							<input 	name="naziv_dvorane" id="naziv_dvorane" value="<?php echo $dvorana->naziv_dvorane;?>" type="text" />
							
							<label for="kapacitet">Kapacitet</label>
							<input 	name="kapacitet" id="kapacitet" value="<?php echo $dvorana->kapacitet;?>" type="number" />
							
							
													
							<input type="submit" class="button expanded" value="Promjeni" />
							<input type="hidden" name="dvorana_id" value="<?php echo $dvorana->dvorana_id;?>"/>
								<?php if(isset($_GET["uvjet"])):?>
								<input type="hidden" name="uvjet" value="<?php echo $dvorana->uvjet;?>"/>
									<?php endif;?>
							<a href="index.php" class="alert button expanded">Odustani</a>
							
						</fieldset>
						
					</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	