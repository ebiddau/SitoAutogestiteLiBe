<?php
if ($_SESSION['admin'] != 1){
	header ("Location: login.php?level=admin&location=resetScelte");
}
?>

<div class='jumbotron text-center jumbotron-fluid'>Reset scelte</div>
<div class="page_text">

<?php
if (isset($_POST['invia'])) {

	if ($_POST['utente'] == "corrente") {
		$user = $_SESSION['id'];
	} else {
		$user = $_POST['id_utente'];
	}

	if ($conn->connect_error) {
		die("Connessione fallita: " . $conn->connect_error);
	}

	if ($_POST['check']=="si") {

		$sqlReset1 = "UPDATE scelte SET att1=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset1) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset2 = "UPDATE scelte SET att2=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset2) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset3 = "UPDATE scelte SET att3=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset3) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset4 = "UPDATE scelte SET att4=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset4) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset5 = "UPDATE scelte SET att5=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset5) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset6 = "UPDATE scelte SET att6=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset6) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset7 = "UPDATE scelte SET att7=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset7) === TRUE) {
		  echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset8 = "UPDATE scelte SET att8=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset8) === TRUE) {
		  echo "";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset9 = "UPDATE scelte SET att9=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset9) === TRUE) {
		  echo "Ok<br><a class='button' href='index.php?page=resetScelte'>Ancora!</a>";
		} else {
		  echo "Errore: " . $conn->error;
		}

	} else {
		echo "Nope dude";
	}
} else { ?>
	<form method="POST" action="index.php?page=resetScelte">
		Utente:<br>
		<label><input type="radio" name="utente" value="corrente" required checked>Utente corrente</input></label><br>

		<label><input type="radio" name="utente" id="altroU" value="altro">Altro utente (id utente): </input> <input type="text" onfocus="selezionaAltroU()" name="id_utente"></label><br><br>

		<label><input type="radio" name="check" value="si" required> Si</label><br>
		<label><input type="radio" name="check" value="no" checked> No</label><br>

		<input type="submit" value="Esegui" name="invia">
	</form><br><br>
<script>
	function selezionaAltroU() {
		document.getElementById('altroU').checked = true;
	}
</script><?php
} ?>
</div>
