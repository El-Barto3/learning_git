<?php

try {
	$db = new PDO("mysql:host=mysql.ct8.pl;dbname=m20451_spacer", "m20451_spacer", "8GscvBRcTHa8YSq3Jn0w");;
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$db->query("SET NAMES utf8");
} catch (PDOException $e) {
	//die("Error!");
	die("Error!: " . $e->getMessage());
}

?>