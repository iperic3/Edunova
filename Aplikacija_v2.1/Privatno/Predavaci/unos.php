<?php include_once '../../konfiguracija.php'; provjeraLogin(); provjeraUloga("admin");

$greske=array();

if(isset($_POST["email"])){
	$veza->beginTransaction();
		$izraz=$veza->prepare("insert into predavac(uloga,ime,prezime,oib,email,lozinka,ziro_racun) 
		values (:uloga,:ime,:prezime,:oib,:email,md5(:lozinka),:ziro_racun)");
		$izraz->execute();
		// $zadnji = $veza->lastInsertId();
		$izraz=$veza->prepare("insert into predmet(naziv) values('') where predavac_id=:predavac_id)");
		$izraz-execute();
		$izraz=$veza->prepare("insert into razina(obrazovanje) values ('') 
							where razina_id=(select razina_id form razina where predmet_id=:predavac_id)");
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
							
							<label for="obrazovanje">Razina</label>
							<input name="obrazovanje" id="obrazovanje" type="text"/>
							
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
		<!-- <script>
			<?php if(isset($unioRedova) && $unioRedova>0):?>
				setTimeout(function(){ $("#unio").fadeOut(); }, 2000);
			<?php endif;?>
			
			<?php if(isset($greske["naziv"])): ?>
				$("#naziv").focus();
				$("#lnaziv").fadeOut(1000,function(){
					$("#lnaziv").html("<?php echo $greske["naziv"] ?>");
					$("#lnaziv").fadeIn();
				});
			<?php endif; ?> 
		</script> -->
	</body>
</html>
	

