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
							<a href="unos.php" class="button expanded">Dodaj predmet</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<?php include '../../predlosci/paginator.php'; ?>
					</div>
					
			<table class="hover unstriped">
						<thead>
							<tr>
								<th>Naziv predmeta</th>
								<th>Razina obrazovanja</th>
								<th>Predavač</th>
								<th>Trajanje</th>
								<th>Radnja</th>
							</tr>
						</thead>
						<tbody>
							<?php							
							$izraz = $veza->prepare("select a.predmet_id,a.naziv,a.trajanje,b.obrazovanje,c.ime, c.prezime, count(d.polaznik_id) as broj_polaznika
													from predmet a
													left join razina b on b.razina_id=a.razina_id
													left join predavac c on c.predavac_id=a.predavac_id
													left join polaznik_predmet d on a.predmet_id=d.predmet_id
													where a.naziv like :uvjet
													group by a.naziv, b.obrazovanje");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red->naziv; ?></td>
								<td><?php echo $red->obrazovanje; ?></td>
								<td><?php echo $red->ime.' '. $red->prezime; ?></td>
								<td><?php echo $red->trajanje; ?></td>
								<td>
									<a href="promjena.php?predmet_id=<?php echo $red->predmet_id;
										// if(isset($_GET["uvjet"])){
											// echo "&uvjet=".$_GET["uvjet"];
										// }
										?>">Uredi</a>
										
									<?php 
								if($red->broj_polaznika===0): ?>
								<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?predmet_id=<?php echo $red->predmet_id;
								if(isset($_GET["uvjet"])){
									echo "&uvjet=" . $_GET["uvjet"];
								}?>"<i title="Brisanje"></i>Obriši</a>
								<?php else: ?>
									<i title="Brisanje [Onemogućeno jer postoje polaznici koji još pohađaju predmet]"></i>Obriši
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
