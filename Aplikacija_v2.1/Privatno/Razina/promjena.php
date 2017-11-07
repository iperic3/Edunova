<?php
include_once '../../konfiguracija.php'; provjeraLogin();
if(isset($_GET["razina_id"])){
	$izraz=$veza->prepare("select * from razina where razina_id=:razina_id");
	$izraz->execute(array("razina_id"=>$_GET["razina_id"]));
	$razina=$izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$razina->uvjet=$_GET["uvjet"];
	}
}

if(isset($_POST["promjeni"])){
	$uvjet="";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
		unset($_POST["uvjet"]);
	}
	$izraz=$veza->prepare("update razina set obrazovanje=:obrazovanje where razina_id=:razina_id");
	$izraz->execute(array(
	"obrazovanje"=>$_POST["obrazovanje"],
	"razina_id"=>$_POST["razina_id"]));
	header("location:index.php?uvjet=".$uvjet);
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
							
							<label id= for="obrazovanje">Razina obrazovanja</label>
							<input 	name="obrazovanje" id="obrazovanje" value="<?php echo $razina->obrazovanje;?>" type="text" />
																	
							<input name="promjeni" type="submit" class="button expanded" value="Promjeni" />
							<input type="hidden" name="razina_id" value="<?php echo $razina->razina_id;?>"/>
								<?php if(isset($_GET["uvjet"])):?>
								<input type="hidden" name="uvjet" value="<?php echo $razina->uvjet;?>"/>
									<?php endif;?>
							<a href="index.php" class="alert button expanded">Odustani</a>
							
						</fieldset>
						
					</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	