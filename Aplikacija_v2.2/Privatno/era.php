<?php
include_once '../konfiguracija.php';
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
			<div class="large-12 columns" align="middle">
				<div class="callout">
					<img src="<?php echo $putAplikacije;  ?>img/ERA.png" alt="Era dijagram" />
				</div>
			</div>
	</div>

			<?php include_once '../Predlosci/podnozje.php';?>
			<?php include_once '../Predlosci/skripte.php';?>
	</body>
</html>
