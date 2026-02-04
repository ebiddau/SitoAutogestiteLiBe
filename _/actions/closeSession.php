<?php
session_start();
require("../config/config.php");
$resultUpdate = $conn->query("UPDATE utenti SET token='' WHERE username='" . $_SESSION['username'] . "'");
if ($resultUpdate == FALSE) {
	die("Errore: " . $conn->error);
}

$_SESSION = array();
session_destroy();
session_start();

if (isset($_COOKIE['remembermeAutogest'])) {
	unset($_COOKIE['remembermeAutogest']);
	setcookie('remembermeAutogest', null, -1, '/');
}

header("Location: ../index.php");
?>
