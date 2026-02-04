<?php
require('../config/config.php');

if (!isset($_GET['id'])) {
	header("Location: ../index.php?page=gestioneFunzioni");
}

$queryUpdate = "UPDATE funzioni SET abilitata='" . $_GET['att'] . "' WHERE id_funzione=" . $_GET['id'];
$resultUpdate = $conn->query($queryUpdate);

if ($conn->affected_rows > 0) {
	echo "OK ";
} else {						
	echo "Errore: " . $conn->error . " ";
} ?>