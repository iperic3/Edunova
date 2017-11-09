<?php
include_once '../../konfiguracija.php'; provjeraLogin();

$greske=array();
if(isset($_POST["naziv"])){
	print_r($_POST);
	if(trim($_POST["naziv"])==""){
	$greske["naziv"]="Obavezno unijeti naziv";
	}
	if(count($greske)==0){
		$izraz=$veza->prepare("insert into predmet (naziv,razina_id, trajanje,predavac_id)
		values (:naziv,:razina_id,:trajanje,:predavac_id)");
		$unos=$izraz->execute(array("naziv"=>$_POST["naziv"],
									"razina_id"=>$_POST["razina_id"],
									"trajanje"=>$_POST["trajanje"],
									"predavac_id"=>$_POST["predavac_id"]
									));
		
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
		<!-- Unosne podatke želimo ogrančiti tako da odredimo razine i predavače koje imamo u bazi podataka -->
		<div class="row">
			<div class="large-4 columns large-centered">
					<form method="POST" enctype="multipart/form-data">

						<fieldset class="fieldset">
							<legend>Unesi novi predmet</legend>
							 
							<?php							
							 $razina=$veza->query("select * from razina");
							$rezultat=$razina->fetchAll(PDO::FETCH_OBJ);
							 ?>
							<label for="razina_id">Razina</label>
							<select name="razina_id">
								<?php foreach ($rezultat as $red): ?>
									<option value="<?php echo $red->razina_id; ?>"> 
										<?php echo $red->obrazovanje; ?> 
									</option>
                  			<?php
                  			
							 	endforeach;
                 			?>
                 			</select>
                 			
                 			<label for="naziv">Naziv predmeta</label>
							<input
							 <?php 
							 if(isset($greske["naziv"])){
								 echo "style=\"background-color:red\" ";
							 }
							 ?> 
							name ="naziv" id="naziv" value="<?php echo isset($_POST["naziv"]) ? $_POST["naziv"] : "";?>" 
							type="text" autofocus="autofocus" />
							
																					
							<label for="trajanje">Trajanje</label>
							<input 	name="trajanje" id="trajanje" type= "number" />
							
							<?php
							//htio sam izvesti upit da se predavači na predmetu mogu dodat samo ako se nalaze u bazi, u tablici predavači
							//međutim, prilikom izvršavanja unosa, javlja grešku oko vanjskog ključa "predavac_id"
														
							$predavac=$veza->query("select predavac_id, ime, prezime from predavac");
							$rezultat=$predavac->fetchAll(PDO::FETCH_OBJ);
							 ?>
							<label for="predavac_id">Predavač</label>
							<select name="predavac_id">
								<?php foreach ($rezultat as $red): ?>
									<option value="<?php echo $red->predavac_id; ?>"> 
										<?php echo $red->ime.' '. $red->prezime; ?> 
									</option>
                  			<?php            			
							 	endforeach;
                 			?>
                 			</select>
						</fieldset>
						<input type="submit" class="button expanded" value="Dodaj" />
							
							<a href="index.php" class="alert button expanded">Odustani</a>
							<?php if(isset($unos) && $unos>0):?>
								<h1 id="Unio" class="success button expanded">Uspješno dodano</h1>
							<?php endif;?>
					</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	