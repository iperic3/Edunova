<?php
include_once '../../konfiguracija.php'; provjeraLogin();
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
<?php 
	$izraz=$veza->prepare("select a.predavac_id,a.uloga, a.ime, a.prezime, a.oib, a.email, b.predmet_id, b.naziv,c.razina_id, c.obrazovanje
from predavac a
inner join predmet b on a.predavac_id=b.predavac_id
inner join razina c on c.razina_id=b.razina_id
where a.predavac_id=:predavac_id");
	$izraz->execute(array("predavac_id"=>$_GET["predavac_id"]));
	$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
		foreach ($rezultati as $red):
			?>
<div class="container">
    <div class="row">
      <div class=" " align="right">
        <li>
           	<a name="promjena" href="promjena.php?predavac_id=<?php echo $red->predavac_id ; ?>" class="button" >Promijeni podatke</a>
            <a href="index.php" class="button" >Povratak na popis</a>
		</li>
      </div>
        <div class="" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
            	

              <h3 class="panel-title"> <?php echo $red->ime." ".$red->prezime; ?></h3>
            </div>
        
            <a href="#"> <img src= "<?php if(file_exists("../../img/polaznici/".$red->polaznik_id.".jpg"))
                	    	 {
						echo $putAplikacije."img/polaznici/".$red->polaznik_id.".jpg";
					}
					 else{
						 echo $putAplikacije."img/nemaSliku.png";
					}
			 ?>
			 alt="slika profila"/></a> 
            
			 </div>
			     <div>
                <div class=" col-md-9 col-lg-9 " align="top-right" > 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Uloga</td>
                        <td><?php echo $red->uloga; ?> </td>
                      </tr>
                      <tr>
                        <td>OIB</td>
                        <td><?php echo $red->oib; ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $red->email; ?>"><?php echo $red->email; ?></a></td>
                     </tr>
                     <tr>
                        <td>Predmeti</td>
                        <td><?php echo $red->naziv; ?></td>
                      </tr>
                      <tr>
                        <td>Razina</td>
                        <td><?php echo $red->obrazovanje; ?></td>
                      </tr>
                     </tbody>
                  </table>
                  <?php endforeach; ?>
                
                
            
          </div>
        </div>
      </div>
    </div>
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>
	</body>
</html>

