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
		<style>
			.callout > .row{
				padding-top: 0px;
			}
		</style>
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
$izraz=$veza->prepare("select count(a.termin_id) as termin, b.naziv_dvorane, c.ime, c.prezime
					 from termin a 
					 left join dvorana b on b.dvorana_id=a.dvorana_id
					 inner join predavac c on c.predavac_id=a.predavac_id
					 where concat(b.naziv_dvorane,c.ime,c.prezime) like :uvjet");
$izraz->execute(array("uvjet"=>$uvjetUpit));
$ukupnoTermina=$izraz->fetchColumn();
?>
						<div class="large-1 columns" style="text-align: center;"> 
							<?php 
						echo $ukupnoTermina;
						?><br /> termin(a)
						</div>
						
						<div class="large-5 columns">
							<a href="unos.php" class="button expanded">Dodaj novi termin</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<!-- <?php include '../../predlosci/paginator.php'; ?> -->
					</div>
					<div class="row">
<table>
						<thead>
							<tr>
								<th>Predmet</th>
								<th>Predavač</th>
								<th>Početak</th>
								<th>Trajanje</th>
								<th>Popunjenost</th>
								<th>Prijava Do</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<!-- <php 
							
							$izraz = $veza->prepare("select");
							$izraz->execute();
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><php echo $red->; ?></td>
								<td><php echo $red->; ?></td>
								<td><php echo $red->; ?></td>
								<td><php echo $red->; ?></td>
								<td><php echo $red->; ?></td>
								<td><php echo $red->; ?></td>
								<td><php echo $red->; ?></td>
								<td>
									<a href="profil.php?termin_id=<php echo $red->;?>">Dodaj polaznika</a>
									|<php 
								if($red->polaznici===0): ?>
								<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?termin_id=<?php echo $red->termin_id;
								if(isset($_GET["uvjet"])){
									echo "&uvjet=" . $_GET["uvjet"];
								}?><i title="Brisanje"></i>Obriši</a>
								<php else: ?>
									<i title="Brisanje [Onemogućeno jer postoje polaznici koji su prijavljeni na termin]"></i>Obriši
								<php endif; ?><a href="brisanje.php?termin_id=<php echo $red->;?>">Obriši</a>
								</td>
							</tr>
							<php endforeach; ?> -->
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
