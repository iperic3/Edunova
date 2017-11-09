<?php

function provjeraLogin() {
	if (!isset($_SESSION["logiran"])) {
		header("location: " . $GLOBALS["putAplikacije"] . "Javno/login.php?nemateOvlasti");
		exit ;
	}
}

function provjeraUloga($uloga){
	if( !(isset($_SESSION["logiran"]) && $_SESSION["logiran"]->uloga===$uloga)){
		header("location: " . $GLOBALS["putAplikacije"] . "Privatno/nadzornaPloca.php");
		exit ;
	}
}