<?php
error_reporting(E_ALL & ~E_NOTICE);

require('../config/config.php');

if (!isset($_GET['id'])) {
	header("Location: ../index.php?page=iscrizioneAll");
}

if ($_GET['g'] == "") {
	die(" Inserisci il giorno!");
}

//SELECT count(*) as conteggio, p.max_iscritti FROM scelte s, proposte p WHERE s.att1=3 AND s.att1=p.id_att AND p.giorno=1
//$query = "SELECT num_iscritti, max_iscritti FROM proposte WHERE giorno=" . $_GET['g'] . " AND id_att=" . $_GET['id'];

if (!is_numeric($_GET['id'])) {

	echo " <img src='img/error.png'> Non valida";

} else {

	$g = $_GET['g'];
	$day_after = $g-1;

	$check = 0;

	if($g==2 OR $g==5 OR $g==8) {
		$query2 = "SELECT max_iscritti FROM proposte WHERE (giorno=" . $_GET['g'] . " OR giorno=" . $day_after . ") AND accettata=1 AND attivita_doppia=1 AND id_att=" . $_GET['id'];
		$result2 = $conn->query($query2);
		$check = 1;
		if ($result2->num_rows == 0) {
			$query2 = "SELECT max_iscritti FROM proposte WHERE giorno=" . $_GET['g'] . " AND accettata=1 AND id_att=" . $_GET['id'];
			$result2 = $conn->query($query2);
			$check = 0;
		}
	} else {
		$query2 = "SELECT max_iscritti FROM proposte WHERE giorno=" . $_GET['g'] . " AND accettata=1 AND id_att=" . $_GET['id'];
		$result2 = $conn->query($query2);
	}

	if ($result2->num_rows == 0) {
		echo " <img src='img/error.png'> Non esiste";
	} else {

		while ($row2 = $result2->fetch_array()) {

			if($check == 1) {
				$max_iscritti2 = $row2['max_iscritti'];
				$query = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE  s.att" . $day_after . "=" . $_GET['id'] . " AND s.att" . $day_after . " = p.id_att AND accettata=1 AND p.giorno=" . $day_after;
				$result = $conn->query($query);
				$conteggio = $result->fetch_object()->conteggio ;
			} else {
				$max_iscritti2 = $row2['max_iscritti'];
				$query = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE  s.att" . $_GET['g'] . "=" . $_GET['id'] . " AND s.att" . $_GET['g'] . " = p.id_att AND accettata=1 AND p.giorno=" . $_GET['g'];
				$result = $conn->query($query);
				$conteggio = $result->fetch_object()->conteggio ;
			}
		}

		if ($conteggio < $max_iscritti2) {
			echo " <img id='2' src='img/accept.png'> Ok, " . $conteggio . "/" . $max_iscritti2;
		} else {
			echo " <img id='1' src='img/warning.png'> Attività piena";
		}
	}
}

//il problema era che se il conteggio era 0 di conseguenza il max_iscritti era null quindi le att venivano viste piene quindi con conteggio =0 si ha  semplicemente  riletto il dato max_iscritti con la query che legge dalla tabella proposte.
?>
