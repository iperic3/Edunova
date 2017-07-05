<?php
session_start();

include_once 'funkcije.php';

$naslovAplikacije ="Ahimed - Udruga fizičara";

switch ($_SERVER["HTTP_HOST"]) {
	case 'localhost':
		$putAplikacije="/Aplikacija/";
		$mysqlHost="localhost";
		$mysqlBaza="arhimed";
		$mysqlKorisnik="ivan";
		$mysqlLozinka="programiranje";
	break;
	case 'webpr.byethost5.com':
		$putAplikacije="/EdunovaWP15/Aplikacija/";
		$mysqlHost="sql201.byethost5.com";
		$mysqlBaza="b5_20129984_arhimed";
		$mysqlKorisnik="b5_20129984";
		$mysqlLozinka="GvRh.659";
	break;
	default:
		$putAplikacije="/";
		break;
}


try{
	$veza = new PDO("mysql:host=" . $mysqlHost. ";dbname=" . $mysqlBaza,$mysqlKorisnik,$mysqlLozinka);
	$veza->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$veza->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	$veza->exec("SET CHARACTER SET utf8");
	$veza->exec("SET NAMES utf8");
}catch(PDOException $e){
	switch ($e->getCode()) {
		case 2002:
			echo "Ne mogu se spojiti na MySQL server";
			break;
		case 1049:
			echo "Na MySQL serveru ne postoji baza s danim imenom";
			break;
		case 1045:
			echo "Na MySQL serveru ne postoji kombinacija danog korisničkom imena i lozinke";
			break;
		default:
			print_r($e);
			break;
	}
	exit;
}
