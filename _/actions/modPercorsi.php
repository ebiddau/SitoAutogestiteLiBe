<?php
require('../config/config.php');

if (isset($_GET['id'])) {
	
	if (empty($_GET['nome'])) {
		die("Non può essere vuoto");
	}
	
	$queryUpdate = "UPDATE percorsi SET nome='" . $_GET['nome'] . "', attivato=" . $_GET['attivato'] . " WHERE id_percorso=" . $_GET['id'];

	$resultUpdate = $conn->query($queryUpdate);

	if ($conn->affected_rows > 0) {
		echo "<img src='../img/accept.png'> OK";
	} else {						
		echo "<img src='../img/error.png'> Errore oppure nessuna modifica " . $conn->error;
	}
	
} else {
	header ("Location: login.php?level=comm&location=modificaPercorsi");
}