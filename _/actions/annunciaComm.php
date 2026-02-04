<?php session_start();
require("../config/config.php");
$query = "UPDATE utenti SET aiuto=1 WHERE username='" . $_SESSION['username'] . "'";
$result= $conn->query($query);

if ($conn->affected_rows > 0) {
	$_SESSION['aiuto'] = 1;
	header("Location: ../index.php?page=iscrizioneAll&status=1");
} else {
	header("Location: ../index.php?page=iscrizioneAll&status=2");
} ?>