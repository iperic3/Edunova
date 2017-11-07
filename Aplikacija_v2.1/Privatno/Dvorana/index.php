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
							<a href="unos.php" class="button expanded">Dodaj novu dvoranu</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<?php include '../../predlosci/paginator.php'; ?>
					</div>
					
			<table class="hover unstriped">
						<thead>
							<tr>
								<th>Naziv dvorane</th>
								<th>Kapacitet</th>
								<th>Radnja</th>
							</tr>
						</thead>
						<tbody>
							<?php							
							$izraz = $veza->prepare("select a.dvorana_id,a.naziv_dvorane,a.kapacitet,count(b.termin_id)
													as termin
													from dvorana a left join termin b 
													on a.dvorana_id=b.dvorana_id
													where a.naziv_dvorane like :uvjet
													group by a.dvorana_id,a.naziv_dvorane,a.kapacitet");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red->naziv_dvorane; ?></td>
								<td><?php echo $red->kapacitet; ?></td>
								<td>
									<a href="promjena.php?dvorana_id=<?php echo $red->dvorana_id;
										if(isset($_GET["uvjet"])){
											echo "&uvjet=".$_GET["uvjet"];
										}
										?>">Uredi</a>
										
									<?php 
								if($red->termin===0): ?>
								<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?dvorana_id=<?php echo $red->dvorana_id;
								if(isset($_GET["uvjet"])){
									echo "&uvjet=" . $_GET["uvjet"];
								}?><i title="Brisanje"></i>Obriši</a>
								<?php else: ?>
									<i title="Brisanje [Onemogućeno jer postoje termini koji se održavaju u dvorani]"></i>Obriši
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
