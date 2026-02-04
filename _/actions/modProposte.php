<?php 
require('../config/config.php');

if (!isset($_POST['id'])) {
	header("Location: ../index.php?page=listaProposte");
}

if (empty($_POST['giorno'])) {
	$_POST['giorno'] = "NULL";
}

if (empty($_POST['titolo']) || empty($_POST['descrizione']) || empty($_POST['referenze']) || empty($_POST['relatore1'])) {
	die("Non può essere vuoto!");
}

if (empty($_POST['min_iscritti'])) {
	$_POST['min_iscritti'] = "0";
}

if (empty($_POST['max_iscritti'])) {
	$_POST['max_iscritti'] = "30";
}

if (empty($_POST['percorso']) || $_POST['percorso'] == "Nessuno") {
	$perc = "0";
} else {
	$queryPerc = "SELECT id_percorso FROM percorsi WHERE nome='" . $_POST['percorso'] . "'";
	$resultPerc = $conn->query($queryPerc);

	$perc = $resultPerc->fetch_object()->id_percorso;
	
	mysqli_free_result($resultPerc);
}



$queryUpdate = "UPDATE proposte SET giorno=" . ripulisci($_POST['giorno']) . ", titolo='" . ripulisci($_POST['titolo']) . "', min_iscritti=" . ripulisci($_POST['min_iscritti']) . ", max_iscritti=" . ripulisci($_POST['max_iscritti']) . ", relatore1='" . ripulisci($_POST['relatore1']) . "', relatore2='" . ripulisci($_POST['relatore2']) . "', relatore3='" . ripulisci($_POST['relatore3']) . "', numtelrel='" . ripulisci($_POST['numtelrel']) . "', emailrel='" . ripulisci($_POST['emailrel']) . "', referenze='" . ripulisci($_POST['referenze']) . "', disponibilita='" . ripulisci($_POST['disponibilita']) . "', descrizione='" . ripulisci($_POST['descrizione']) . "', materiale='" . ripulisci($_POST['materiale']) . "', osservazioni='" . ripulisci($_POST['osservazioni']) . "', aula='" . ripulisci($_POST['aula']) . "', email='" . ripulisci($_POST['email']) . "', numtel='" . ripulisci($_POST['numtel']) . "', percorso=" . ripulisci($perc) . " WHERE id_att=" . $_POST['id'];

$resultUpdate = $conn->query($queryUpdate);

if ($conn->affected_rows > 0) {
	echo "<img src='../img/accept.png'> OK";
} else {						
	echo "<img src='../img/error.png'> Errore oppure nessuna modifica. " . $conn->error;
} ?>