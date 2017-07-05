<?php

function provjeraLogin() {
	if (!isset($_SESSION["logiran"])) {
		header("location: " . $GLOBALS["putAplikacije"] . "javno/login.php?nemateOvlasti");
		exit ;
	}
}
