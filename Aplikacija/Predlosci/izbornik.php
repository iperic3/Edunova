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
					</li>
					<?php if(isset($_SESSION["logiran"])): ?>
						<li>
							<a href="<?php echo $putAplikacije ?>/Privatno/profil.php">Profil</a>
						</li>
						<li>
							<a href="<?php echo $putAplikacije ?>Privatno/raspored.php">Raspored</a>
						</li>
						<li>
					   	 	<a href="#">Arhimed</a>
					   	 		<ul class="menu vertical">
			          				<li><a href="#">Predavači</a></li>
			            			<li><a href="<?php echo $putAplikacije; ?>/Privatno/Arhimed/smjer.php">Smjerovi</a></li>
			            			<li><a href="#">Upis</a></li>
			          			</ul>
			         	</li>
			    </ul>
			
					<?php endif; ?>
					<?php if(!isset($_SESSION["logiran"])): ?>	
					<li>
						<a href="<?php echo $putAplikacije ?>index.php">Početna</a>
					</li>
					<li>
						<a href="<?php echo $putAplikacije ?>javno/karta.php">Karta</a>
					</li>
						<?php endif; ?>
			</div>
						<?php if(!isset($_SESSION["logiran"])): ?>
							<div class="top-bar-right">
								<ul class="menu">
									<li>
										<a href="<?php echo $putAplikacije; ?>Javno/login.php" class="button">Login</a>
									</li>
								</ul>
							</div>
      					<?php else: ?>
      						<div class="top-bar-right">
								<ul class="menu">
									<li>
										<a href="<?php echo $putAplikacije; ?>Javno/logout.php" class="button">Logout</a>
									</li>
								</ul>
      					<?php endif; ?>
      	</li>
				</ul>
		
		</div>
	</div>
</div>