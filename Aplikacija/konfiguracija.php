<?php
session_start();

$naslovAplikacije ="Ahimed - Udruga fizičara";

switch ($_SERVER["HTTP_HOST"]) {
	case 'localhost':
		$putAplikacije="/Aplikacija/";
	break;
	case 'webpr.byethost5.com':
		$putAplikacije="EdunovaWP15/Aplikacija/";
	break;
	default:
		$putAplikacije="/";
		break;
}
