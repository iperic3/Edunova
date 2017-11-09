<?php include_once '../../konfiguracija.php'; provjeraLogin(); provjeraUloga("admin");

$greske=array();
print_r($_POST);
if(isset($_POST["email"], $_POST["lozinka"])){
	$veza->beginTransaction();
		$izraz=$veza->prepare("insert into predavac(uloga,ime,prezime,oib,email,lozinka,ziro_racun) 
		values (:uloga,:ime,:prezime,:oib,:email,md5(:lozinka),:ziro_racun)");
		$unos=$izraz->execute(array(
			"uloga"=>$_POST["uloga"],
			"ime"=>$_POST["ime"],
			"prezime"=>$_POST["prezime"],
			"oib"=>$_POST["oib"],
			"email"=>$_POST["email"],
			"lozinka"=>$_POST["lozinka"],
			"ziro_racun"=>$_POST["ziro_racun"]
		));
		$predavac_id= $veza->lastInsertId();
		
		$izraz=$veza->prepare("insert into predmet(naziv, razina_id, predavac_id) values(:naziv,:razina_id,'". $predavac_id ."')");
		$unos=$izraz->execute(array(
			"naziv"=>$_POST["naziv"],
			"razina_id"=>$_POST["razina_id"]
			)); 
	$izraz=$veza->prepare("insert into osoba (uloga,ime,prezime,email,lozinka) 
		values (:uloga,:ime,:prezime,:email,md5(:lozinka))");
		$unos=$izraz->execute(array(
			"uloga"=>$_POST["uloga"],
			"ime"=>$_POST["ime"],
			"prezime"=>$_POST["prezime"],
			"email"=>$_POST["email"],
			"lozinka"=>$_POST["lozinka"]			
		));
	$veza->commit();
		header("location: index.php");
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/glava.php'; ?>
	</head>
	<body>
		<?php include_once '../../predlosci/izbornik.php'; ?>
		<div class="row">
			<div class="large-4 columns large-centered">
					<form method="POST">
						<fieldset class="fieldset">
							<legend>Unosni podaci</legend>
							
							<label for="uloga">Uloga</label>
							<select id="uloga" name="uloga">
								<option value="predavac" selected="selected">Predavač</option>
								<option value="administrator">Administrator</option>
							</select>
							
							<label for="ime">Ime</label>
							<input name="ime" id="ime" type="text"/>
							
							<label for="prezime">Prezime</label>
							<input name="prezime" id="prezime" type="text"/>
							
							<label for="oib">OIB</label>
							<input name="oib" id="oib" type="id"/>
							
							<label for="email">Email</label>
							<input name="email" id="email" type="email"/>
							
							<label for="lozinka">Lozinka</label>
							<input name="lozinka" id="lozinka" type="password"/>
							
							<label for="ziro_racun">Broj računa</label>
							<input name="ziro_racun" id="ziro_racun" type=""/>
							
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
                 			
                 			<label for="naziv">Predmet</label>
							<input name="naziv" id="naziv" type="text"/>
							
						</fieldset>
						
						<input type="submit" class="button expanded" value="Dodaj"/>
							<input name="odustani" type="submit" class="alert button expanded" value="Odustani"/>
					</form>	
			</div>
		</div>
		<?php	include_once '../../predlosci/podnozje.php'; ?>
		<?php	include_once '../../predlosci/skripte.php'; ?>
		
	</body>
</html>
	

