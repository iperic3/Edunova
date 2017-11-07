<?php
include_once '../../konfiguracija.php'; provjeraLogin();
$uvjet = isset($_GET["uvjet"]) ? $_GET["uvjet"] : "";
$stranica=isset($_GET["stranica"])?intval($_GET['stranica']):1;
$polaznik_id=isset($_GET["polaznik_id"])? ($_GET['polaznik_id']):"";

?>
<?php
if(isset($_SESSION["logiran"]->rezultata_po_stranici)){
$rezultataPoStranici =$_SESSION["logiran"]->rezultata_po_stranici;
}
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
$izraz=$veza->prepare("select count(*) from polaznik where concat(ime,prezime, oib,email) like :uvjet");
$izraz->execute(array("uvjet"=>$uvjetUpit));
$ukupnoPolaznika=$izraz->fetchColumn();
?>
						<div class="large-1 columns" style="text-align: center;"> 
							<?php 
						echo $ukupnoPolaznika;
						?><br /> polaznik(a)
						</div>
						
						<div class="large-5 columns">
							<a href="unos.php" class="button expanded">Dodaj novog</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<!-- <?php include '../../predlosci/paginator.php'; ?> -->
					</div>
					<div class="row">
<table>
						<thead>
							<tr>
								<th>Ime</th>
								<th>Prezime</th>
								<th>Email</th>
								<th>OIB</th>
								<th>Razina</th>
								<th>Predmeti</th>
								<th>Iznos</th>
								<th>Akcija</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							
							$izraz = $veza->prepare("select
a.polaznik_id, a.ime, a.prezime, a.oib, a.email, a.lozinka, a.iznos, 
c.predmet_id, c.naziv, 
d.razina_id, d.obrazovanje
 from polaznik a
 inner join polaznik_predmet b on a.polaznik_id=b.polaznik_id
 inner join predmet c on c.predmet_id=b.predmet_id
 inner join razina d on d.razina_id=c.razina_id");
							$izraz->execute();
							$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
							foreach ($rezultati as $red) :
							?>
							<tr>
								<td><?php echo $red->ime; ?></td>
								<td><?php echo $red->prezime; ?></td>
								<td><?php echo $red->email; ?></td>
								<td><?php echo $red->oib; ?></td>
								<td><?php echo $red->obrazovanje; ?></td>
								<td><?php echo $red->naziv; ?></td>
								<td><?php echo $red->iznos; ?></td>
								<td>
									<a href="profil.php?polaznik_id=<?php echo $red->polaznik_id;?>">Idi na profil</a>
									|<a href="brisanje.php?polaznik_id=<?php echo $red->polaznik_id;?>">Obriši</a>
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
