<?php
require('../config/config.php');

if (!isset($_GET['id'])) {
	header("Location: ../index.php?page=accettaProposte");
}

$queryUpdate = "UPDATE proposte SET accettata=" . $_GET['acc'] . " WHERE id_att=" . $_GET['id'];
$resultUpdate = $conn->query($queryUpdate);

if ($conn->affected_rows > 0) {
	echo "OK ";
} else {						
	echo "Errore: " . $conn->error . " ";
} ?>