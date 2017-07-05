<?php
include_once '../konfiguracija.php';

if(!isset($_SESSION["logiran"])){
	header("location: " . $putAplikacije . "Javno/login.php?nemateOvlasti");
	exit;
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../Predlosci/glava.php';
		?>
	</head>
	<body>
		<header>
			<?php
			include_once '../Predlosci/zaglavlje.php';
			?>
			<?php
				include_once '../Predlosci/izbornik.php';
			?>
		</header>

		<div class="row">
			<div class="large-12 columns">
				<?php
				
				
				
				$izraz = $veza->query("select * from predavac");
				$izraz->execute();
				$rezultati = $izraz->fetchAll(PDO::FETCH_OBJ);
				// print_r($rezultati);
				
				foreach ($rezultati as $red) {
					echo $red->naziv . "<br />";
				}
				
				?>
			</div>
		</div>

			<?php include_once '../Predlosci/podnozje.php';?>
			<?php include_once '../Predlosci/skripte.php';?>
			
	</body>
</html>
