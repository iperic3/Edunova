<!DOCTYPE HTML>
<html>
	<head>
		<?php
		include_once 'glava.php';
		?>
	</head>
	<body>
		<header>
			
						<?php
						include_once 'zaglavlje.php';
						?>
						<?php
						include_once 'izbornik.php';
						?>
		</header>
<div class="divPanel notop nobottom">

			<div class="row-fluid">
				<div class="span12">

					<div id="headerSeparator"></div>

					
		<div class="row">
			<div class="large-4 columns large-centered">
				
				<?php 
				if(isset($_GET["neuspio"])){
					echo "Ne ispravna kombinacija korisnika i lozinke!";
				}
				
				if(isset($_GET["nemateOvlasti"])){
					echo "Morate se prvo logirati!";
				}
				?>
				
				<form method="post" action="prijava.php">
					<label for="korisnik">Korisnik</label>
					<input type="text" name="korisnik" id="korisnik" 
					value="<?php echo isset($_GET["korisnik"]) ? $_GET["korisnik"] : ""; ?>"/>
					<label for="lozinka">Lozinka</label>
					<input type="password" name="lozinka" id="lozinka" />
					<input type="submit" class="button expanded" value="Prijava" />
				</form>
			</div>
		</div>

						<div class="row-fluid">
							<div class="span4">
								<h2>Članak 1.</h2>
								<img src="http://placehold.it/150x90/e7e7e7" class="img-polaroid" style="margin:5px 0px 15px;">
								<p>
									Lorem Ipsum is simply dummy text of the printing and typesetting industry.
									<br />
									<a href="#">Read More &raquo;</a>
								</p>
							</div>
							<div class="span4">
								<h2>Članak 2.</h2>
								<img src="http://placehold.it/150x90/e7e7e7" class="img-polaroid" style="margin:5px 0px 15px;">
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit.
									<br />
									<a href="#">Read More &raquo;</a>
								</p>
							</div>
							<div class="span4">
								<h2>Članak 3.</h2>
								<img src="http://placehold.it/150x90/e7e7e7" class="img-polaroid" style="margin:5px 0px 15px;">
								<p>
									Nešto teksta.
									<br />
									<a href="#">Read More &raquo;</a>
								</p>
							</div>
						</div>

					</div>

				</div>
			</div>
		
		<footer>
			<?php
			include_once 'podnozje.php';
			?>
		</footer>
		<?php
		include_once 'skripte.php';
		?>
	</body>
</html>

