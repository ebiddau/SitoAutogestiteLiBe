<?php
require("../config/config.php");

$a = array();

function salvaArray($giorno) {
	global $conn;
	global $a;
	$a = array();
	
	$queryA = "SELECT titolo, id_att, max_iscritti FROM proposte WHERE giorno=" . $giorno . " AND accettata=1";
	$resultA = $conn->query($queryA);
	
	while ($row = $resultA->fetch_array()) {
		$id_att = $row[id_att];
		$titolo = $row[titolo];
		$max_iscritti = $row[max_iscritti];
		
		$queryB = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att" . $giorno . "=p.id_att AND p.giorno=" . $giorno . " AND p.id_att=" . $id_att;
		$resultB = $conn->query($queryB);
		$conteggio = $resultB->fetch_object()->conteggio;
		
		if ($conteggio < $max_iscritti) {
			array_push($a,$id_att);
		} 
	}
}


$read1 = $conn->query("SELECT s.id_utente, att1 FROM scelte s, utenti u WHERE att1=0 AND comm=0 AND aiuto=0 AND s.id_utente=u.id_utente");

while ($rowR1 = $read1->fetch_array()) {
	salvaArray(1);
	$attRand = $a[array_rand($a,1)];
	
	$sqlUpdateS1 = "UPDATE scelte SET att1=" . $attRand . " WHERE id_utente=" . $rowR1['id_utente'];
	if ($conn->query($sqlUpdateS1) === TRUE) {
		echo "Utente " . $rowR1['id_utente'] . " - att " . $attRand . "<br>";
	} else {
		echo "Errore S1: " . $conn->error;
	}
}

$read2 = $conn->query("SELECT s.id_utente, att1 FROM scelte s, utenti u WHERE att2=0 AND comm=0 AND aiuto=0 AND s.id_utente=u.id_utente");

while ($rowR2 = $read2->fetch_array()) {
	salvaArray(2);
	$attRand = $a[array_rand($a,1)];
	
	$sqlUpdateS2 = "UPDATE scelte SET att2=" . $attRand . " WHERE id_utente=" . $rowR2['id_utente'];
	if ($conn->query($sqlUpdateS2) === TRUE) {
		echo "Utente " . $rowR2['id_utente'] . " - att " . $attRand . "<br>";
	} else {
		echo "Errore S2: " . $conn->error;
	}
}

$read3 = $conn->query("SELECT s.id_utente, att3 FROM scelte s, utenti u WHERE att3=0 AND comm=0 AND aiuto=0 AND s.id_utente=u.id_utente");

while ($rowR3 = $read3->fetch_array()) {
	salvaArray(3);
	$attRand = $a[array_rand($a,1)];
	
	$sqlUpdateS3 = "UPDATE scelte SET att3=" . $attRand . " WHERE id_utente=" . $rowR3['id_utente'];
	if ($conn->query($sqlUpdateS3) === TRUE) {
		echo "Utente " . $rowR3['id_utente'] . " - att " . $attRand . "<br>";
	} else {
		echo "Errore S3: " . $conn->error;
	}
}

$read4 = $conn->query("SELECT s.id_utente, att4 FROM scelte s, utenti u WHERE att4=0 AND comm=0 AND aiuto=0 AND s.id_utente=u.id_utente");

while ($rowR4 = $read4->fetch_array()) {
	salvaArray(4);
	$attRand = $a[array_rand($a,1)];
	
	$sqlUpdateS4 = "UPDATE scelte SET att4=" . $attRand . " WHERE id_utente=" . $rowR4['id_utente'];
	if ($conn->query($sqlUpdateS4) === TRUE) {
		echo "Utente " . $rowR4['id_utente'] . " - att " . $attRand . "<br>";
	} else {
		echo "Errore S4: " . $conn->error;
	}
}

$read5 = $conn->query("SELECT s.id_utente, att5 FROM scelte s, utenti u WHERE att5=0 AND comm=0 AND aiuto=0 AND s.id_utente=u.id_utente");

while ($rowR5 = $read5->fetch_array()) {
	salvaArray(5);
	$attRand = $a[array_rand($a,1)];
	
	$sqlUpdateS5 = "UPDATE scelte SET att5=" . $attRand . " WHERE id_utente=" . $rowR5['id_utente'];
	if ($conn->query($sqlUpdateS5) === TRUE) {
		echo "Utente " . $rowR5['id_utente'] . " - att " . $attRand . "<br>";
	} else {
		echo "Errore S5: " . $conn->error;
	}
}

$read6 = $conn->query("SELECT s.id_utente, att6 FROM scelte s, utenti u WHERE att6=0 AND comm=0 AND aiuto=0 AND s.id_utente=u.id_utente");

while ($rowR6 = $read6->fetch_array()) {
	salvaArray(6);
	$attRand = $a[array_rand($a,1)];
	
	$sqlUpdateS6 = "UPDATE scelte SET att6=" . $attRand . " WHERE id_utente=" . $rowR6['id_utente'];
	if ($conn->query($sqlUpdateS6) === TRUE) {
		echo "Utente " . $rowR6['id_utente'] . " - att " . $attRand . "<br>";
	} else {
		echo "Errore S6: " . $conn->error;
	}
}