<?php
if (!isset($_SESSION['username']) && isset($_COOKIE['remembermeAutogest'])) {
	require("actions/openSession.php");
} ?>

<!-- 
	<div class='alert alert-warning alert-dismissible alert-floating'><button type='button' class='close' data-dismiss='alert'>&times;</button>Attenzione! Il sito è in fase di test e potresti non riuscire ad accedervi.</div>
-->

<!-- <marquee class="annunci">
	Le proposte sono aperte! NOVITÀ: LibePASS
</marquee> -->

<div class='jumbotron text-center jumbotron-fluid'>
	<span id="scritto">Autogestite 2026</span>
</div>

<div class="page_text">

	<?php

	if (!isset($_SESSION['username'])) {
		echo '

		<form action="login.php" method="POST" style="width: 100%; max-width: 330px; display: block; margin: 0 auto;">
		Effettua il login con i tuoi dati del liceo per accedere alle aree riservate.<br><br>
			<div class="form-group">
				<label for="username">Nome utente:</label>
				<input name="username" type="text" class="form-control" id="username" required>
			</div>
			<div class="form-group">
				<label for="username">Password:</label>
				<div id="tutta">
				<input name="password" type="password" class="form-control" id="password" required>
				<div id="togglePassword" class="eye-icon">👁️</div>
			</div>
			<input name="ricordami" type="checkbox" value="y" checked> Ricordami<br><br>
			<input name="invia" type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
		</form>
		<style> 
			.page_text {
				color: white;
				margin-left: 30%;
  				margin-right: 30%;
				padding-right: 5%;
				padding-left: 5%;
				padding-top: 50px;
				padding-bottom: 200px;
				background-color: #252020;
				border-radius: 20px;
				filter: opacity(90%);
				margin-bottom: 200px;
				position: relative;
				z-index: 2;
			}
		</style>
		
		';
	} else { ?>

		<?php

		$queryOn = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiIscrizione'");
		$resultOn = $queryOn->fetch_object();
		$abilitata = $resultOn->abilitata;

		// <h3 style="color: #168a16; font-size: 3em; margin-bottom: 20px">Per &nbsp; LIBEPASS</h3>

		if ($abilitata == 1) {
			echo  "
			 <style> div#lorenza {font-family: 'Exo 2', sans-serif;}</style>
			<div id='lorenza' style='text-align:center; margin: 40px;'>
				<h2 style=' color: chartreuse; font-size: 4.5em'>ISCRIZIONI APERTE!!</h2>
			</div>";
		} else {
			echo '
			<img id="logo-img" scr="img/logo.PNG"> '; //non va, vai a letto
			//Count-down
			// echo '
			// <div class="countdown" style="margin: 40px; display: flex; flex-direction: column; align-items: center; text-align: center;">
			// 		<h2> Apertura iscrizioni <span style="color: #ffffcc;">LIBEPASS</span>:</h2>
			// 		<div id="flipdown" class="flipdown" style="margin:30px"></div>
			// 		<h3>Per tutti gli altri, state in allerta!</h3>

			// 		<script>
			// 				// Imposta la data di scadenza del countdown
			// 				var countdownDate = new Date("Mar 04, 2024 17:30:00").getTime() / 1000;

			// 				// Inizializza il plugin FlipDown
			// 				var flipdown = new FlipDown(countdownDate, "flipdown", {
			// 						theme: "light"
			// 				});

			// 				// Avvia il countdown
			// 				flipdown.start();

			// 				// Opzionale: Aggiungi eventi, ad esempio al completamento del countdown
			// 				flipdown.ifEnded(() => {
			// 						document.getElementById("flipdown").style.display = "none";
			// 						document.getElementById("countdown-ended").style.display = "block";
			// 				});
			// 		</script>
			// </div>';
		}
		?>

		<?php

		echo '<div style="border: 2px solid #ffffcc; border-radius: 8px; padding: 15px; margin-top: 70px;
		"><span class="blink"><b style="color: #ffffcc; text-align: center;">Annunci dalla commissione:</b></span><br><br>';

		$result = $conn->query("SELECT long_desc FROM news");
		$row = $result->fetch_object();
		$long_desc = $row->long_desc;
		echo $long_desc;
		echo '</div><br>';


		if ($_SESSION['displayProposte'] == 1) {
			require("content/displayProposte.php");
		}

		if ($_SESSION['displayIscrizione'] == 1) {
			require("content/displayIscrizione.php");
		} ?>

		<br>
		<br>
		Ciao<?php if (isset($_SESSION['username'])) echo " " . $_SESSION['nome'] ?>, benvenuto/a nel sito ufficiale delle
		autogestite del liceo di Bellinzona!<br><br>
		<a class="button" href="index.php?page=profilo">Vai al tuo profilo</a><br><br>
		Se hai dei suggerimenti, critiche o consigli scrivici dalla pagina <a href="index.php?page=contatti">Contattaci</a>!<br>

		<br>

		Per aggiornamenti e info segui il nostro profilo instagram:
		<a href="https://instagram.com/libeautogestito?igshid=YmMyMTA2M2Y=" target="_blank">
			<img src="img/instalogo.png" alt="Instagram icon" width="16" height="16">
		</a>
		<br><br><br>

		<h3 style="color: #ffffcc">Che cosa sono le autogestite?</h3>

		Sono alcuni giorni, solitamente attorno a marzo-aprile, durante i quali non si fa lezione: il liceo è preso in mano
		dagli studenti
		stessi che organizzano delle attività diverse dalla "normale scuola". La scelta non manca: ci sono attività sportive
		come il
		judo o l'hip-hop, conferenze e dibattiti su diversi temi, presentazioni di associazioni e molto altro (potrai vedere
		la lista
		completa sotto "Catalogo" quando sarà pubblicato).<br><br>
		C'è un gruppo di allievi che si occupa del lato amministrativo, ma le
		attività vengono proposte da tutto il corpo studenti, quindi anche tu puoi contribuire a rendere queste giornate
		interessanti e
		variate! Come? Proponi un'attività!<br><br>

		<?php
		$expgiorno1 = explode(" ", $_SESSION['giorni'][1]);
		$expgiorno2 = explode(" ", $_SESSION['giorni'][2]);
		$expgiorno3 = explode(" ", $_SESSION['giorni'][3]);
		$expgiorno4 = explode(" ", $_SESSION['giorni'][4]);
		$expgiorno5 = explode(" ", $_SESSION['giorni'][5]);
		$expgiorno6 = explode(" ", $_SESSION['giorni'][6]);
		$expgiorno7 = explode(" ", $_SESSION['giorni'][7]);
		$expgiorno8 = explode(" ", $_SESSION['giorni'][8]);
		$expgiorno9 = explode(" ", $_SESSION['giorni'][9]);
		?>

		Quest'anno si terranno da <?php echo $expgiorno1[0] . " " . $expgiorno1[1] . " " . $expgiorno1[2]; ?> a
		<?php echo $expgiorno11[0] . " " . $expgiorno11[1] . " " . $expgiorno11[2]; ?> se verrà raggiunto il numero di
		proposte necessarie.<br><br><br>

		<h3 style="color: #ffffcc">Testimonianze di chi le ha vissute</h3>

		Manda la tua a <a href="mailto:autogestite.libe@gmail.com">autogestite.libe@gmail.com</a> e la
		pubblicheremo!<br><br><br>

		<h3 style="color: #ffffcc; margin-bottom: 30px;">Le autogestite in 4 minuti!</h3>
		<div class="homeVideo embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/_u321oY30_c?si=5uRh8-g9RytAXenR" frameborder="0" allowfullscreen></iframe>
		</div>


		<style> 
			.page_text {
				color: white;
				margin-left: 10%;
  				margin-right: 10%;
				padding-right: 5%;
				padding-left: 5%;
				padding-top: 50px;
				padding-bottom: 200px;
				background-color: #252020;
				border-radius: 20px;
				filter: opacity(90%);
				margin-bottom: 200px;
				position: relative;
				z-index: 2;
			}
		</style>
	<?php } ?>

</div>