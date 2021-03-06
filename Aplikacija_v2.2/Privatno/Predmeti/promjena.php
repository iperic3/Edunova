<?php
include_once '../../konfiguracija.php'; provjeraLogin();
if(isset($_GET["predmet_id"])){
	$izraz=$veza->prepare("select a.naziv, a.trajanje,b.obrazovanje,c.ime,c.prezime,a.predmet_id, b.razina_id, c.predavac_id
		from predmet a
		left join razina b on b.razina_id=a.razina_id
		left join predavac c on c.predavac_id=a.predavac_id
		left join polaznik_predmet d on a.predmet_id=d.predmet_id
		where a.predmet_id=:predmet_id");
	$izraz->execute(array("predmet_id"=>$_GET["predmet_id"]));
	$predmet=$izraz->fetch(PDO::FETCH_OBJ);
	if(isset($_GET["uvjet"])){
		$predmet->uvjet=$_GET["uvjet"];
	}
}

if(isset($_POST["promijeni"])){
	$uvjet="";
	if(isset($_POST["uvjet"])){
		$uvjet=$_POST["uvjet"];
		unset($_POST["uvjet"]);
	}

	$izraz=$veza->prepare("update predmet set naziv=:naziv, trajanje=:trajanje, razina_id=:razina_id, predavac_id=:predavac_id where predmet_id=:predmet_id");
	$izraz->execute(array(
		"naziv"=>$_POST["naziv"],
		"trajanje"=>$_POST["trajanje"],
		"predmet_id"=>$_POST["predmet_id"],
		"razina_id"=>$_POST["obrazovanje"],
		"predavac_id"=>$_POST["predavac"]
	));


	header("location:index.php");
}

if(isset($_GET["polaznici"])){
	$izraz=$veza->prepare("select * from polaznik");
	$izraz->execute();
	$polaznici = $izraz->fetchAll();

	echo json_encode($polaznici);
	return;
}

if(isset($_POST["polaznik_id"], $_POST["cijena"])){
	$predmet = $_GET["predmet_id"];
	$polaznik = $_POST["polaznik_id"];
	$cijena = $_POST["cijena"];

	$izraz=$veza->prepare("insert into polaznik_predmet (polaznik_id, predmet_id, cijenap_p) values (?,?,?)");
	$izraz->execute([$polaznik, $predmet, $cijena]);

	return;
}
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
			<div class="large-4 columns large-centered">
					<form method="POST" enctype="multipart/form-data">
						
						<fieldset class="fieldset">
							<legend>Unosni podaci</legend>
							
							<label id="lnaziv" for="naziv">Naziv predmeta</label>
							<input 	name="naziv" id="naziv" value="<?php echo $predmet->naziv;?>" type="text" />
							
							<label for="obrazovanje">Razina obrazovanja</label>
									<select name="obrazovanje">
										<?php if($predmet->naziv!=""): ?>
										<option value="0">----</option>
										
										<?php
										endif;
										 
										$izraz=$veza->prepare("select razina_id, obrazovanje from razina order by obrazovanje");
										$izraz->execute();
										$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
										foreach ($rezultati as $red) :
										?>
										<option <?php 
										if($predmet->naziv!="" && $predmet->razina_id == $red->razina_id){
											echo " selected=\"selected\" ";
										}
										
										?> value="<?php echo $red->razina_id ?>"> <?php echo $red->obrazovanje ?></option>
										<?php endforeach; ?>
									</select>
							
							<label for="predavac">Predavač</label>
							<select name="predavac">
								<?php if($predmet->naziv=="");?>
								<option value="0">----</option>
								<?php
								$izraz=$veza->prepare("select predavac_id,ime,prezime from predavac
															order by prezime, ime");
								$izraz->execute();
								$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
								foreach($rezultati as $red) :
								?>
									<option <?php 
											if($predmet->naziv!="" && $predmet->predavac_id == $red->predavac_id){
												echo "selected=\"selected\"";
											}?> 
											value="<?php echo $red->predavac_id; ?>" >
											<?php echo $red->ime." ".$red->prezime; ?>
									</option>
									<?php endforeach; ?>	
							</select>
							
							<label for="trajanje">Trajanje</label>
							<input 	name="trajanje" id="trajanje" value="<?php echo $predmet->trajanje;?>" type="number" />

<div class="large-4 columns">
						<fieldset class="fieldset" align="center">
						<legend>Polaznici</legend>
						<table>
							<thead>
								<tr>
									<th>Polaznik</th>
									<th>Cijena sata</th>
									<th>Akcija</th>
								</tr>
							</thead>
							<tbody id="polazniciPredmeta">
								<?php 
								$izraz=$veza->prepare("select c.polaznik_id,a.predmet_id,concat(c.ime,' ', c.prezime) as polaznik, b.cijenap_p 
													from predmet a 
													inner join polaznik_predmet b on a.predmet_id=b.predmet_id
													inner join polaznik c on c.polaznik_id=b.polaznik_id 
													where a.predmet_id=" . $predmet->predmet_id);
								$izraz->execute();
								$rezultati=$izraz->fetchAll(PDO::FETCH_OBJ);
										foreach ($rezultati as $red) :
										?>
										<tr>
											<td><?php echo $red->polaznik ?></td>
											<td><?php echo $red->cijenap_p?></td>
											<td><a onclick="return confirm('Sigurno obrisati?');"
												 href="brisanjeSPredmeta.php?polaznik_id=<?php echo $red->polaznik_id?> & predmet_id=<?php echo $red->predmet_id;
													if(isset($_GET["uvjet"])){
													echo "&uvjet=" . $_GET["uvjet"];}
													?>"
													<i title="Brisanje"></i>Obriši s predmeta</a></td>
													<!-- treba napraviti pretragu polaznika po terminima, 
														ako je polaznik upisan na termin od tog predmeta, da se ne može obrisat.
														trenutno javlja grešku vanjskog ključa prilikom takvog brisanja.-->
										</tr>
										<?php endforeach; ?>
							</tbody>
						</table>
						<button class="button" type="button" onclick="dohvatiPolaznike()">Dodaj polaznika</button>
						<div id="popisPolaznika" style="display:none"></div>
					</div>							
													
							<input name="promijeni" type="submit" class="button expanded" value="Promjeni" />
							<input type="hidden" name="predmet_id" value="<?php echo $predmet->predmet_id;?>"/>
								<?php if(isset($_GET["uvjet"])):?>
								<input type="hidden" name="uvjet" value="<?php echo $predmet->uvjet;?>"/>
									<?php endif;?>
							<a href="index.php" class="alert button expanded">Odustani</a>
							
							</fieldset>
				</form>	
			</div>
		</div>
		
			<?php include_once '../../Predlosci/podnozje.php';?>
			<?php include_once '../../Predlosci/skripte.php';?>

<script type="text/javascript">

function dohvatiPolaznike(){

	$("#popisPolaznika").toggle();

	$.ajax({
		url: "promjena.php",
		type: "get", //send it through get method
		data: { 
			polaznici: "True"
		},
		success: function(response) {
			
			try{
				var polaznici = JSON.parse(response);

			}catch(err){
				alert("Error parsing data");
				return
			}

			pokaziPolaznike(polaznici)
			
		},
		error: function(xhr) {
			alert("Error");
		}
	});
}

function pokaziPolaznike(polaznici){
	var string = ''

	for(var i=0; i<polaznici.length; i++){
		string += '\
			<div id="p'+polaznici[i].polaznik_id+'">'
				+ polaznici[i].ime + ' ' + polaznici[i].prezime + ', ' + polaznici[i].oib + 
				'<br>Cijena:<input type="number"></input>\
				<button data-id="'+polaznici[i].polaznik_id+'" type="button" class="button" onclick="dodajPolaznika(this.getAttribute(\'data-id\'))">Dodaj</button>'
			'</div>'
		
	}

	//alert(string)

	$("#popisPolaznika").html(string)
}

function dodajPolaznika(id){
	var cijena = $("#p"+id+">input").val()
	
	if(cijena==""){
		cijena=0
	}

	$.ajax({
		url: window.location.href ,
		type: "post", //send it through get method
		data: { 
			polaznik_id: id,
			cijena: cijena,
		},
		success: function(response) {
			location.reload()
			
		},
		error: function(xhr) {
			alert("Error");
		}
	});
}
</script>