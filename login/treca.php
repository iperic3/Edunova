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

					<div class="row-fluid">
						<div class="span6">

							<div id="divHeaderText" class="page-content">
								<div id="divHeaderLine1">
									Treća!
								</div>
							</div>

						</div>
						<div class="span6">

							<div id="camera_wrap">
								<div data-src="styles/slika.jpeg" >
									<div class="camera_caption fadeFromBottom cap2">
										Slika prirode.
									</div>
								</div>
							</div>

						</div>
					</div>

					<div id="headerSeparator2"></div>

				</div>
			</div>

		</div>

		<div class="contentArea">

			<div class="divPanel notop page-content">

				<div class="row-fluid">

					<div class="span12" id="divMain">

						<h1>Stranica broj tri.</h1>

						<p>
							Postoje mnoge varijacije odlomaka iz Lorem Ipsum-a, ali većina je pretrpjela kojekakve promjene s dodanim humorom.
						</p>

						<br />

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