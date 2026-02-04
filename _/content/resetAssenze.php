<?php
if ($_SESSION['admin'] != 1){
	header ("Location: login.php?level=admin&location=resetAssenze");
}
?>

<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Reset assenze</span></div>
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

		$sqlReset1 = "UPDATE assenze SET assenza1=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset1) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset2 = "UPDATE assenze SET assenza2=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset2) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset3 = "UPDATE assenze SET assenza3=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset3) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset4 = "UPDATE assenze SET assenza4=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset4) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset5 = "UPDATE assenze SET assenza5=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset5) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset6 = "UPDATE assenze SET assenza6=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset6) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset7 = "UPDATE assenze SET assenza7=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset7) === TRUE) {
			echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset8 = "UPDATE assenze SET assenza8=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset8) === TRUE) {
			echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset9 = "UPDATE assenze SET assenza9=NULL WHERE id_utente='" . $user . "'";

		if ($conn->query($sqlReset9) === TRUE) {
		  echo "Ok<br><a class='button' href='index.php?page=resetAssenze'>Ancora!</a>";
		} else {
		  echo "Errore: " . $conn->error;
		}

	} else {
		echo "Nope dude";
	}
} else { ?>
	<form method="POST" action="index.php?page=resetAssenze">
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
</script>
<?php
} ?>
</div>
