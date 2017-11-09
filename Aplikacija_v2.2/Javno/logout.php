<?php include_once '../konfiguracija.php';

session_destroy();
header("location: ".$putAplikacije ."Javno/login.php?odlogiranSi");