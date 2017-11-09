<?php
include_once '../../konfiguracija.php'; provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
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
			<div class="large-12 columns">
				<div class="callout">
					<div class="row">
						<div class="large-6 columns">
							<form method="GET">
								<input type="text" placeholder="dio imena" name="uvjet" 
								value="<?php echo $uvjet; ?>"/>	
							</form>
						</div>
									
						<div class="large-6 columns">
							<a href="unos.php" class="button expanded">Dodaj razinu obrazovanja</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<?php include '../../predlosci/paginator.php'; ?>
					</div>
					
			<table class="hover unstriped">
						<thead>
							<tr>
								<th>Obrazovanje</th>
								<th>Predmeti</th>
								<th>Radnja</th>
							</tr>
						</thead>
						<tbody>
							<?php							
							$izraz = $veza->prepare("select a.razina_id,a.obrazovanje,b.naziv,count(b.predmet_id)
													as predmeti
													from razina a left join predmet b 
													on a.razina_id=b.razina_id
													where a.obrazovanje like :uvjet
													group by a.razina_id,a.obrazovanje,b.naziv");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red->obrazovanje; ?></td>
								<td><?php echo $red->naziv;?></td>
								
								<td>
									<a href="promjena.php?razina_id=<?php echo $red->razina_id;
										if(isset($_GET["uvjet"])){
											echo "&uvjet=".$_GET["uvjet"];
										}
										?>">Uredi</a>
										
									<?php 
								if($red->predmeti===0): ?>
								<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?razina_id=<?php echo $red->razina_id;
								if(isset($_GET["uvjet"])){
									echo "&uvjet=" . $_GET["uvjet"];
								}?>"<i title="Brisanje"></i>Obriši</a>
								<?php else: ?>
									<i title="Brisanje [Onemogućeno jer na razini postoje predmeti]"></i>Obriši
								<?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					
				</div>
		</div>
</div>

			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	</body>
</html>
