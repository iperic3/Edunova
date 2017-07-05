<?php
include_once '../konfiguracija.php';

if(!isset($_SESSION["logiran"])){
	header("location: " . $putAplikacije . "javno/login.php?nemateOvlasti");
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
				<div class="callout">
					<p>
						Ivan Perić, wp15
					</p>
				</div>

			</div>

			<?php include_once '../Predlosci/podnozje.php';?>
			<?php include_once '../Predlosci/skripte.php';?>
	</body>
</html>
