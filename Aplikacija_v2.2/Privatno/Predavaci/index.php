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
													a.uloga,a.predavac_id, a.ime, a.prezime, a.email, count(b.predmet_id) as predmet
													from predavac a
													left join predmet b on a.predavac_id=b.predavac_id
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
									<?php 
								if($red->predmet===0): ?>
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
</div>

			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	</body>
</html>
