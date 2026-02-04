<?php
if ($_SESSION['admin'] != 1){
	header ("Location: login.php?level=admin&location=resetTotaleAssenze");
}

if (isset($_POST['invia'])) {

	if ($conn->connect_error) {
		die("Connessione fallita: " . $conn->connect_error);
	}

	if ($_POST['check']=="si") {

		$sqlReset1 = "UPDATE assenze SET assenza1=0";

		if ($conn->query($sqlReset1) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset2 = "UPDATE assenze SET assenza2=0";

		if ($conn->query($sqlReset2) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset3 = "UPDATE assenze SET assenza3=0";

		if ($conn->query($sqlReset3) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset4 = "UPDATE assenze SET assenza4=0";

		if ($conn->query($sqlReset4) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset5 = "UPDATE assenze SET assenza5=0";

		if ($conn->query($sqlReset5) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset51 = "UPDATE assenze SET inserita='0000-00-00 00:00'";

		if ($conn->query($sqlReset51) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset6 = "UPDATE assenze SET assenza6=0";

		if ($conn->query($sqlReset6) === TRUE) {
			echo "Ok<br>";
		} else {
			echo "Errore: " . $conn->error;
		}

		$sqlReset7 = "UPDATE assenze SET assenza7=0";

		if ($conn->query($sqlReset7) === TRUE) {
		  echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset8 = "UPDATE assenze SET assenza8=0";

		if ($conn->query($sqlReset8) === TRUE) {
		  echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset9 = "UPDATE assenze SET assenza9=0";

		if ($conn->query($sqlReset9) === TRUE) {
		  echo "Ok<br><a class='button' href='index.php?page=resetAssenze'>Ancora!</a>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset7 = "UPDATE assenze SET assenza7=0";

		if ($conn->query($sqlReset7) === TRUE) {
		  echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset8 = "UPDATE assenze SET assenza8=0";

		if ($conn->query($sqlReset8) === TRUE) {
		  echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

		$sqlReset9 = "UPDATE assenze SET assenza9=0";

		if ($conn->query($sqlReset9) === TRUE) {
		  echo "Ok<br>";
		} else {
		  echo "Errore: " . $conn->error;
		}

	} else {
		echo "Nope dude";
	}
} else { ?>
<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Reset TOTALE assenze</span></div>
<div class="page_text">
	<form method="POST" action="index.php?page=resetTotaleAssenze">
		Occhio, reset di tutte le assenze!!<br>

		<label><input type="radio" name="check" value="si" required> Si</label><br>
		<label><input type="radio" name="check" value="no" checked> No</label><br>

		<input type="submit" value="Nuke it!" name="invia">
	</form><br><br>
</div><?php
} ?>
