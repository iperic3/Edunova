<?php include_once '../../konfiguracija.php'; provjeraLogin(); 
// print_r($_GET);
if(isset($_GET["polaznik_id"])){
	$izraz=$veza->prepare("select a.polaznik_id,a.uloga, a.ime, a.prezime, a.oib, a.email,a.lozinka, b.predmet_id, c.naziv,d.razina_id,d.obrazovanje
from polaznik a
inner join polaznik_predmet b on a.polaznik_id=b.polaznik_id
inner join predmet c on c.predmet_id=b.predmet_id
inner join razina d on d.razina_id=c.razina_id
where a.polaznik_id=:polaznik_id");
	$izraz->execute(array("polaznik_id"=>$_GET["polaznik_id"]));
	$entitet = $izraz->fetch(PDO::FETCH_OBJ);

}
if(isset($_POST["promjena"])){
	
	//implementirati kontrole
	
	$veza->beginTransaction();
	$izraz=$veza->prepare("update polaznik
	set uloga=:uloga, ime=:ime,prezime=:prezime,oib=:oib,email=:email, lozinka=:lozinka 
	where polaznik_id=:polaznik_id");
	$izraz->execute(array(
	"uloga"=>$_POST["uloga"],"ime"=>$_POST["ime"],"prezime"=>$_POST["prezime"],"oib"=>$_POST["oib"],
	"email"=>$_POST["email"],"lozinka"=>$_POST["lozinka"],"polaznik_id"=>$_GET["polaznik_id"] ));

	$izraz=$veza->prepare("insert into osoba
	set uloga=:uloga, ime=:ime,prezime=:prezime,email=:email, lozinka=:lozinka");
	$izraz->execute(array(
	"uloga"=>$_POST["uloga"],
	"ime"=>$_POST["ime"],
	"prezime"=>$_POST["prezime"],
	"email"=>$_POST["email"],
	"lozinka"=>$_POST["lozinka"]
	));
	
	
	// $izraz=$veza->prepare("update predmet set naziv=:neziv,
						 // where predmet_id=(select predmet_id from predmet where predavac_id=:predavac_id)");
	// $izraz->execute(array(
	// "naziv"=>$_POST["naziv"],
	// "predavac_id"=>$_POST["predavac_id"]));
// 	
	// $izraz=$veza->prepare("update razina set obrazovanje=:obrazovanje 
	// where razina_id=(select razina_id from predmet where predavac_id=:predavac_id)");
	// $izraz->execute(array(
	// "obrazovanje"=>$_POST["obrazovanje"],
	// "predavac_id"=>$_POST["predavac_id"]));
	$veza->commit();
	
	header("location: index.php");
}

if(isset($_POST["odustani"])){
	if($_POST["naziv"]==""){
		$izraz=$veza->prepare("delete from predavac where predavac_id=:predavac_id");
		$izraz->execute(array("predavac_id"=>$_POST["predavac_id"] ));
	}
	//vratim se na pregled 
	header("location: index.php");
}
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php include_once '../../predlosci/glava.php'; ?>
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	</head>
	<body>
		<?php include_once '../../predlosci/izbornik.php'; ?>
		<div class="row">
			<div class="large-4 columns large-centered">
					<form method="POST" enctype="multipart/form-data">
							
								<fieldset class="fieldset">
									<legend>Unosni podaci</legend>
									
									<label for="uloga">Uloga</label>
										<select id="uloga" name="uloga">
											<option value="predavač" <?php echo ($entitet->uloga=="polaznik") ? " selected=\"selected\" " : "";	?>>Polaznik</option>
										</select>
							
									<label for="ime">Ime</label>
									<input name="ime" id="ime" type="text" value="<?php echo $entitet->ime; ?>"/>
							
									<label for="prezime">Prezime</label>
									<input name="prezime" id="prezime" type="text" value="<?php echo $entitet->prezime; ?>"/>
									
									<label for="oib">OIB</label>
									<input name="oib" id="oib" type="oib" value="<?php echo $entitet->oib; ?>"/>
									
									<label for="email">Email</label>
									<input name="email" id="email" type="email" value="<?php echo $entitet->email; ?>"/>
							
									<label for="lozinka">Lozinka</label>
									<input name="lozinka" id="lozinka" type="text" value="<?php echo $entitet->lozinka; ?>"/>
																							
									</fieldset>
							<input name="promjena" type="submit" class="button expanded" value="<?php 
				if($entitet->naziv==""){
					echo "Dodaj novi";
				}else{
					echo "Promjeni";
				}
				
				?>"/>
				<?php /* koristim input type="hidden" da bi prikljenu vrijednost putem GET učinio dostupnu putem POST */ ?>
				<input type="hidden" name="predavac_id" value="<?php echo $entitet->predavac_id; ?>" />
				
				<a href="profil.php?predavac_id=<?php echo $entitet->predavac_id?>" class="alert button expanded">Odustani</a>
					</div>
					
				</div>
				
			</div>
		</div>
		
		</form>	
		<?php	include_once '../../predlosci/podnozje.php'; ?>
		<?php	include_once '../../predlosci/skripte.php'; ?>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script>
		
			var polaznik;
			
		    $( "#uvjet" ).autocomplete({
			    source: "traziPolaznik.php?grupa=<?php echo $_GET["predavac_id"] ?>",
			    minLength: 3,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			        $(this).val('').blur();
			        event.preventDefault();
			        polaznik=ui.item;
			        $("#odabrano").html(ui.item.ime + " " + ui.item.prezime);
			        $("#revealKolicina").foundation('open');
			        $("#kolicina").focus();
			       // spremiUBazu(ui.item);
			        
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, objekt ) {
			      return $( "<li><img style=\"width: 50px\" src=\"https://vignette.wikia.nocookie.net/mafiagame/images/2/23/Unknown_Person.png/revision/latest?cb=20151119092211\" />" )
			        .append( "<a>" + objekt.ime + " " + objekt.prezime + "</a>" )
			        .appendTo( ul );
		    }
		    
		    $("#spremiUBazuSKolicinom").click(function(){
		    	spremiUBazu();
		    	
		    	return false;
		    });
		    
		    
		    
		    function spremiUBazu(){
		    	console.log(kolicina);
		    	$.get( "dodajPolaznika.php?grupa=<?php echo $_GET["sifra"] ?>&polaznik=" + polaznik.sifra + "&kolicina=" + $("#kolicina").val(), 
					function( vratioServer ) {
					if(vratioServer=="OK"){
						$("#polazniciGrupe").append("<tr id=\"red_" + polaznik.sifra + "\" >" + 
						"<td>" + polaznik.ime + " " + polaznik.prezime + "</td><td>"  + $("#kolicina").val() + "</td>" + 
						"<td><i id=\"b_" + polaznik.sifra + "\" title=\"Brisanje\" class=\"step fi-page-delete size-48 brisanje\"></i></td>" + 
						"</tr>");
						definirajBrisanje();
						$("#revealKolicina").foundation('close');
						$("#kolicina").val("");
						//$("#red_" + polaznik.sifra).fadeIn();
					}else{
						alert(vratioServer);
					}
				});
		    }
		    
		    function definirajBrisanje(){
		    	$(".brisanje").click(function(){
		    	var element = $(this);
				var id = element.attr("id").split("_")[1];
				$.get( "obrisiPolaznika.php?grupa=<?php echo $_GET["sifra"] ?>&polaznik=" + id, 
					function( vratioServer ) {
					if(vratioServer=="OK"){
						var red = element.parent().parent();
						$("#" + red.attr("id")).fadeOut();
						//element.parent().parent().remove();
					}else{
						alert(vratioServer);
					}
				});
		    	return false;
		    	});
		    }
		    
		    definirajBrisanje();
		    
		    
		    $( "#uvjet" ).focus(function() {
  				$('html,body').animate({ scrollTop: 9999 }, 'slow');
			});
		</script>
	</body>
</html>
