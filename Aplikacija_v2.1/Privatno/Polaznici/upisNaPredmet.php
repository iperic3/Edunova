<?php
include_once '../../konfiguracija.php'; provjeraLogin();
$greske=array();
		$izraz=$veza->prepare("insert into polaznik_predmet (polaznik_id, predmet_id, cijenap_p) 
							values (:polaznik_id,:predmet_id,:cijenap_p)");
		$unos=$izraz->execute(array(
		"polaznik_id"=>$_GET["polaznik_id"],
		"predmet_id"=>$_POST["predmet_id"],
		"cijenap_p"=>$_POST["cijenap_p"]));
		header("location:index.php");


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
							<legend>Podaci o predmetu</legend>
							
							<?php							
							 $razina=$veza->query("select * from predmet");
							$rezultat=$razina->fetchAll(PDO::FETCH_OBJ);
							 ?>
							<label for="predmet_id">Naziv predmeta</label>
							<select name="predmet_id">
								<option value="predmet_id"> --- </option>
								<?php foreach ($rezultat as $red): ?>
									<option value="<?php $_POST['predmet_id']=$red->predmet_id; ?>"> 
										<?php echo $red->naziv; ?> 
									</option>
                  			<?php
                  			
							 	endforeach;
                 			?>
                 			</select>
							
							<label for="cijenap_p">Cijena po satu</label>
							<input 	name="cijenap_p" id="cijenap_p" type="number" />
							
							<input type="submit" class="button expanded" value="Upiši" />
							
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
	