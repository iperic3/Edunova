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
<?php 
$uvjetUpit="%" . $uvjet . "%";
$izraz=$veza->prepare("select count(*) from predavac where concat(ime,prezime, oib,email) like :uvjet");
$izraz->execute(array("uvjet"=>$uvjetUpit));
$ukupnoPredavaca=$izraz->fetchColumn();
?>
						<div class="large-1 columns" style="text-align: center;"> 
							<?php 
						echo $ukupnoPredavaca;
						?><br /> predavač(a)
						</div>
						
						<div class="large-5 columns">
							<a href="unos.php" class="button expanded">Dodaj predavača</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<?php include '../../predlosci/paginator.php'; ?>
					</div>
					
			<table class="hover unstriped">
						<thead>
							<tr>
								<th>uloga</th>
								<th>Ime</th>
								<th>Prezime</th>
								<th>Email</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
							$izraz = $veza->prepare("select
													uloga,predavac_id, ime, prezime, email
													from predavac 
 													where concat(ime,prezime,email) like :uvjet
 													group by prezime");
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red->uloga; ?></td>
								<td><?php echo $red->ime; ?></td>
								<td><?php echo $red->prezime; ?></td>
								<td><?php echo $red->email; ?></td>
								<td>
									<a href="profil.php?predavac_id=<?php echo $red->predavac_id;?>">Idi na profil</a>
									|<a href="brisanje.php?predavac_id=<?php echo $red->predavac_id;?>">Obriši</a>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					</div>
				</div>
		</div>
</div>

			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	</body>
</html>
