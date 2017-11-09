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
							<a href="unos.php" class="button expanded">Dodaj novog polaznika</a>
						</div>
					</div>
					
					<div class="hide-for-large">
						<?php include '../../predlosci/paginator.php'; ?>
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
							a.polaznik_id,a.ime, a.prezime, a.oib, a.email, a.lozinka, a.iznos,c.naziv,count(c.predmet_id) as predmet, d.razina_id, d.obrazovanje
 							from polaznik a
 							left join polaznik_predmet b on a.polaznik_id=b.polaznik_id
 							left join predmet c on c.predmet_id=b.predmet_id
 							left join razina d on d.razina_id=c.razina_id
							where concat(a.ime,a.prezime,a.email) like :uvjet
							group by a.prezime,a.ime");
							
							$uvjet="%" . $uvjet . "%";
							$izraz->execute(array("uvjet"=>$uvjet));
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
									<a href="profil.php?polaznik_id=<?php echo $red->polaznik_id;?>">Profil</a>
									|<?php 
								if($red->predmet===0): ?>
								<a onclick="return confirm('Sigurno obrisati?');" href="brisanje.php?dvorana_id=<?php echo $red->polaznik_id_id;
								if(isset($_GET["uvjet"])){
									echo "&uvjet=" . $_GET["uvjet"];
								}?><i title="Brisanje"></i>Obriši</a>
								<?php else: ?>
									<i title="Brisanje [Onemogućeno jer postoje predmeti koje polazni pohađa]"></i>Obriši
								<?php endif; ?>
									|<a href="upisNaPredmet.php?polaznik_id=<?php echo $red->polaznik_id;?>">Upis</a>
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
