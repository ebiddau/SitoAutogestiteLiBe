<?php
$db_host="4a9ro.myd.infomaniak.com";
$db_name="4a9ro_autogest";
$db_username="4a9ro_autogest";
$db_password="MACLEOD@horsemen6envy!marx";

$conn = new mysqli($db_host, $db_username, $db_password, $db_name, '3306');

error_reporting(E_ALL & ~E_NOTICE);

if ($conn->connect_error) {
	die("<br>Connessione al database fallita: " . $conn->connect_error . "<br><br>Manda un'e-mail a <a href='mailto:autogestite.libe@gmail.com'>autogestite.libe@gmail.com</a> con quanto scritto sopra!");
}

function ripulisci($data) {
	$data = trim(filter_var($data, FILTER_SANITIZE_STRING));
	$data = addslashes($data);
	//$data = $conn->real_escape_string($data);
	return $data;
}?>
