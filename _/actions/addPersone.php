<?php
require('../config/config.php');

if (!isset($_GET['att'])) {
	header("Location: ../index.php?page=inserisciAssenze");
}

$count = 0;

if (isset($_GET['id'])) {
	$queryUpdate = "UPDATE scelte SET att" . trim($_GET['g']) . "=" . $_GET['att'] . " WHERE id_utente=" . $_GET['id'];
	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		$count++;
	}

	$queryUpdate = "UPDATE assenze SET assenza" . trim($_GET['g']) . "=2 WHERE id_utente=" . $_GET['id'];
	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		$count++;
	}

} else {
	$queryRead = "SELECT id_utente FROM utenti WHERE nome='" . $_GET['nome'] . "' AND cognome='" . $_GET['cognome'] . "' AND classe='" . $_GET['classe'] . "'";
	$resultRead = $conn->query($queryRead);

	$id_utente = $resultRead->fetch_object()->id_utente;

	$queryUpdate = "UPDATE scelte SET att" . trim($_GET['g']) . "=" . $_GET['att'] . " WHERE id_utente=" . $id_utente;
	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		$count++;
	}

	$queryUpdate = "UPDATE assenze SET assenza" . trim($_GET['g']) . "=2 WHERE id_utente=" . $id_utente;
	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		$count++;
	}
}

if ($count == 2) {
	echo " <img src='../img/accept.png'> Ok" . $conn->error;
} else {
	echo " <img src='../img/error.png'> Errore, controlla i dati inseriti. " . $conn->error;
} ?>
