<?php
if (!isset($_SESSION['username'])) {
	header("Location: login.php?location=iscrizioneAll");
} ?>

<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Iscrizione autogestite</span></div>
<div class="page_text">

	<?php

	$queryOn = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiIscrizione'");
	$resultOn = $queryOn->fetch_object();
	$abilitata = $resultOn->abilitata;

	if (isset($_GET['status'])) {
		if ($_GET['status'] == 1) {
			echo "<span class='boxOk'><img src='img/accept.png'> Annuncio completato. Ora fai parte della commissione!</span><br><br><br>";
		} else if ($_GET['status'] == 2) {
			echo "<span class='boxWarning'><img src='img/warning.png'> Errore. Fai già parte della commissione?</span><br><br><br>";
		}
	}

	if ($_SESSION['admin'] == 1) {
		require("template/infoIscrizione.php");
		echo '<a class="btn btn-outline-primary" role="button" href="index.php?page=giornata1">Continua</a>';
	} else if ($_SESSION['comm'] == 1) {
		echo "<div class=page_text> Per i membri della commissione non è necessario iscriversi. </div>";
	} else if ($abilitata == 1) {
		require("template/infoIscrizione.php");
		echo '<a class="btn btn-outline-primary" role="button" href="index.php?page=giornata1">Continua</a>';
	} else {
		echo '<p>Le iscrizioni alle attività non sono ancora aperte.</p>';
	}
	?>
</div>