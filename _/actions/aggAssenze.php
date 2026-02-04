<?php
require('../config/config.php');

if (!isset($_GET['id'])) {
	header("Location: ../index.php?page=inserisciAssenze");
}

$query = "SELECT * FROM proposte WHERE giorno=" . $_GET['g'] . " AND accettata=1 AND attivita_doppia=1 AND id_att=" . $_GET['id_att'];
$result = $conn->query($query);

if ($result->num_rows == 0) {
	$queryUpdate = "UPDATE assenze SET assenza" . trim($_GET['g']) . "=" . $_GET['ass'] . " WHERE id_utente=" . $_GET['id'];
	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		echo "<img src='img/accept.png'> ";
	} else {
		echo "<img src='img/error.png'> ";
	}
} else {
	$assenza_next = (int)trim($_GET['g']) + 1;
	$queryUpdate = "UPDATE assenze SET assenza" . trim($_GET['g']) . "=" . $_GET['ass'] . ", assenza" . $assenza_next . "=" . $_GET['ass'] . " WHERE id_utente=" . $_GET['id'];
	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		echo "<img src='img/accept.png'> ";
	} else {
		echo "<img src='img/error.png'> ";
	}
}
?>
