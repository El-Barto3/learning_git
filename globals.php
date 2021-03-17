<?php
include 'database.php';

$regex = '/^[!@#$%^&*()a-z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ ,_+{}|:<>?\-=[\]\;.\/\']+$/mi';
$ip = isset($_SERVER["HTTP_CF_CONNECTING_IP"]) ? $_SERVER["HTTP_CF_CONNECTING_IP"] : $_SERVER["REMOTE_ADDR"];

function getVariable($name, $error = "") {
	global $regex;
	
	$variable = array_key_exists($name, $_REQUEST) ? $_REQUEST[$name] : $error;
	$variable = str_replace(["\r\n", "\n"], "", $variable);
	
	if(preg_match($regex, $variable) || $error == $variable) {
		$variable = strip_tags($variable);
		return $variable;
	}
	else {
		return "";
	}
}

function getSessionVariable($name, $error = "") {
	global $regex;
	
	$variable = array_key_exists($name, $_SESSION) ? $_SESSION[$name] : $error;
	
	if(preg_match($regex, $variable) || $error == $variable) {
		$variable = strip_tags($variable);
		return $variable;
	}
	else {
		return "";
	}
}

//session_start();
?>