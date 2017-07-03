<?php include_once '../konfiguracija.php';

session_destroy();
header("location: ".$putAplikacije ."javno/login.php?odlogiranSi");