<div class="row columns">
	<div class="top-bar">
		<div class="top-bar-title">
			<span data-responsive-toggle="responsive-menu" data-hide-for="medium"> <button class="menu-icon dark" type="button" data-toggle></button> </span>
		</div>
		
		<div id="responsive-menu">
			<div class="top-bar-left">
				<ul class="dropdown menu" data-dropdown-menu>
					<li>
						<b href="#"> <?php echo $naslovAplikacije; ?></b>
						<?php if(!isset($_SESSION["logiran"])): ?>
					<li>
						<a href="<?php echo $putAplikacije ?>index.php">Početna</a>
					</li>
					<li>
						<a href="<?php echo $putAplikacije ?>Javno/karta.php">Karta</a>
					</li>
					
					<?php endif; ?>
					</li>
					<?php if(isset($_SESSION["logiran"])): ?>
						<li>
							<a href="<?php echo $putAplikacije ?>Privatno/nadzornaPloca.php">NadzornaPloča</a>
						</li>
						<li>
							<a href="<?php echo $putAplikacije ?>Privatno/era.php">ERA Dijagram</a>
						</li>
						<?php endif; ?>
						<?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga==="polaznik"): ?>
						<li>
							<a href="<?php echo $putAplikacije ?>Privatno/Polaznici/profil.php">Profil</a>
						</li>
						<li>
							<a href="<?php echo $putAplikacije ?> Kalendar/full_demo/kalendar.html">Raspored</a>
						</li>
						<?php endif; ?>
						
						<?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga!="polaznik"): ?>
						<li>
					   	 	<a href="#">Arhimed</a>
					   	 		<ul class="menu vertical">
					   	 			<?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga==="admin"): ?>
			          				<li><a href="<?php echo $putAplikacije; ?>Privatno/predavaci.php">Razina</a></li>
			            			<li><a href="<?php echo $putAplikacije; ?>Privatno/smjer.php">Predmet</a></li>
			            			<li><a href="<?php echo $putAplikacije; ?>Privatno/predavaci.php">Dvorana</a></li>
			            			<li><a href="<?php echo $putAplikacije; ?>/Privatno/predavaci.php">Predavači</a></li>
			            			<?php endif; ?>
			            			<?php if(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga==="predavac"): ?>
			            			<li><a href="<?php echo $putAplikacije; ?>/Privatno/Polaznici/index.php">Polaznici</a></li>
			            			<li><a href="<?php echo $putAplikacije; ?>/Privatno/predavaci.php">Termini</a></li>
			            			<?php endif; ?>
			            			
			          			</ul>
			         	</li>
			         	<?php endif; ?>
			    </ul>
			
					
					
			</div>
						<?php if(!isset($_SESSION["logiran"])): ?>
							<div class="top-bar-right">
										<a href="<?php echo $putAplikacije; ?>Privatno/Polaznici/unos.php" class="button">Upiši se</a>
										<a href="<?php echo $putAplikacije; ?>Javno/login.php" class="button">Login</a>
							</div>
      					<?php else: ?>
      						<div class="top-bar-right">
								<ul class="menu">
									<li>
										<a href="<?php echo $putAplikacije; ?>Javno/logout.php" class="button">Logout <?php 
      	      		echo $_SESSION["logiran"]->ime . " " . $_SESSION["logiran"]->prezime; ?></a>
									</li>
								</ul>
      					<?php endif; ?>
      	</li>
				</ul>
		
		</div>
	</div>
	
</div>
</div>
