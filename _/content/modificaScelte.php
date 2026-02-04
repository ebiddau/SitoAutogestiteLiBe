<?php
if ($_SESSION['comm'] != 1 && $_SESSION['admin'] != 1){
	header ("Location: login.php?level=comm&location=modificaScelte");
} ?>

<div class='jumbotron text-center jumbotron-fluid'>Modifica scelte</div>
<div class="page_text">

	<?php
	if (!isset($_POST['cerca'])) { ?>
		<form method="POST" action="index.php?page=modificaScelte">

			<fieldset><legend>Dati allievo</legend>
				ID allievo: <input type="number" name="id_utente"><br><br>

				------------ OPPURE ------------<br><br>

				Nome: <input type="text" name="nome"><br><br>

				Cognome: <input type="text" name="cognome"><br><br>

				Classe:<?php
				$queryClassi = "SELECT classe FROM utenti WHERE classe != 'Docente' GROUP BY classe";
				$resultClassi = $conn->query($queryClassi); ?>

				<select name="classe">
					<option value="">Scegli la classe</option><?php
					while($row = $resultClassi->fetch_assoc()) {
						$classe = $row['classe'];?>
						<option value="<?php echo $classe;?>"><?php echo $classe; ?></option><?php
					} ?>
				</select>
			</fieldset><br>

			<fieldset><legend>Dati attività nuova</legend>
				Giorno:
				<select name="giorno" id="giorno"  required>
					<option value="">Scegli il giorno</option>
					<option value="1"><?php echo $_SESSION['giorni'][1]; ?></option>
					<option value="2"><?php echo $_SESSION['giorni'][2]; ?></option>
					<option value="3"><?php echo $_SESSION['giorni'][3]; ?></option>
					<option value="4"><?php echo $_SESSION['giorni'][4]; ?></option>
					<option value="5"><?php echo $_SESSION['giorni'][5]; ?></option>
					<option value="6"><?php echo $_SESSION['giorni'][6]; ?></option>
					<option value="7"><?php echo $_SESSION['giorni'][7]; ?></option>
					<option value="8"><?php echo $_SESSION['giorni'][8]; ?></option>
					<option value="9"><?php echo $_SESSION['giorni'][9]; ?></option>
				</select><br><br>

				Numero attività: <input type="number" name="attNuova" id="attNuova" onkeyup="controllo()" required><span id="ok"></span>

			</fieldset><br>

			<input type="submit" name="cerca" value="Esegui">

		</form>
		<script>
			function controllo() {
				var val = document.getElementById("attNuova").value;
				var giorno = document.getElementById("giorno").value;

				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok").innerHTML = this.responseText + "<br><br><label>Forza cambio <input type='checkbox' value='yes' name='override'></label>"
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=" + giorno + "&id=" + val, true);
				xhttp.send();
			}
		</script>
	<?php
	} else {

		$attNuova = $_POST['attNuova'];
		$giorno = $_POST['giorno'];

		if (!empty($_POST['id_utente'])) {	//se inserito ID utente

			$id_utente = $_POST['id_utente'];

			$queryNome = "SELECT * FROM utenti WHERE id_utente = " . $id_utente;
			$resultNome = $conn->query($queryNome);

			while($rowNome = $resultNome->fetch_assoc()) {
				$nome = $rowNome['nome'];
				$cognome = $rowNome['cognome'];
				$classe = $rowNome['classe'];
			}

			if ($resultNome->num_rows > 0) {
				echo "<img src='img/accept.png'> Allievo numero " . $id_utente . " - " . $nome . " " . $cognome . " " . $classe . "<br>";
			} else {
				die("<img src='img/warning.png'> Errore, controlla i dati dell'allievo. <a href='index.php?page=modificaScelte' class='button'>Riprova</a>");
			}

		} else { 	//se inseriti nome, cognome e classe

			$nome = $_POST['nome'];
			$cognome = $_POST['cognome'];
			$classe = $_POST['classe'];

			$queryNome = "SELECT id_utente FROM utenti WHERE nome = '$nome' AND cognome = '$cognome' AND classe = '" . rtrim($classe) . "'";
			$resultNome = $conn->query($queryNome);

			if ($resultNome->num_rows > 0) {
				$id_utente = $resultNome->fetch_object()->id_utente;
				echo "<img src='img/accept.png'> Allievo numero " . $id_utente . " - " . $nome . " " . $cognome . " " . $classe . "<br>";
			} else {
				die("<img src='img/warning.png'> Errore, controlla i dati dell'allievo. <a href='index.php?page=modificaScelte' class='button'>Riprova</a>");
			}
		}

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$query1 = "SELECT att" . $giorno . " AS attV FROM scelte WHERE id_utente=" .  $id_utente;
		$result1 = $conn->query($query1);

		if ($result1->num_rows > 0) {
			$attVecchia = $result1->fetch_object()->attV;
			echo "<img src='img/accept.png'> Attività vecchia: " . $attVecchia . " - " . $_SESSION['giorni'][$giorno] . "<br>";
		} else {
			die("<img src='img/error.png'> Non trovo l'attività vecchia. <a href='index.php?page=modificaScelte' class='button'>Riprova</a>");
		}

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		$queryC2 = "SELECT max_iscritti, titolo FROM proposte WHERE id_att=" . $attNuova; // Ho tolto << . " AND giorno=" . $giorno>> alla fine
		$resultC2 = $conn->query($queryC2);

		while ($row2 = $resultC2->fetch_array()) {
			$titolo = $row2['titolo'];
			$max_iscritti = $row2['max_iscritti'];

			$query2 = "SELECT count(*) AS num_iscritti FROM scelte s, proposte p WHERE s.att" . $giorno . "=p.id_att AND p.giorno=" . $giorno . " AND p.id_att=" . $attNuova ;

			$result2 = $conn->query($query2);
			$num_iscritti = $result2->fetch_object()->num_iscritti;
		}

		if ($result2->num_rows > 0) {
			echo "<img src='img/accept.png'> Attività nuova: " . $attNuova . " - iscritti attuali: " . $num_iscritti . "/" . $max_iscritti . "<br>";
		} else {
			die("<img src='img/error.png'> Non trovo l'attività. Controlla giorno e numero attività inseriti. <a href='index.php?page=modificaScelte' class='button'>Riprova</a>");
		}

		if ($attNuova == $attVecchia) {
			die("<img src='img/warning.png'> Attività nuova e vecchia sono uguali, l'allievo è già iscritto qui! <a href='index.php?page=modificaScelte' class='button'>Riprova</a>");
		}

		//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		if ($num_iscritti < $max_iscritti || $_POST['override'] == "yes") {

			echo "<br><img src='img/accept.png'> Cambio possibile.<br><br>";

			$query5 = "UPDATE scelte SET att" . $giorno . "=" . $attNuova . " WHERE id_utente=" . $id_utente;
			$result5 = $conn->query($query5);

			$query6 = "INSERT INTO sceltemodificate(id_utente, autore, attività) VALUES(" . $id_utente . "," . $_SESSION['id'] . "," . $attNuova . ")";
			$result6 = $conn->query($query6);


			if ($result5) {
				echo "<img src='img/accept.png'> Dati aggiornati con successo. <br>";
				if (!$result6) {
					echo "<img src='img/error.png'> Non riesco a scrivere il log. " . $conn->error . "<br>";
				}
			} else {
				die("<img src='img/error.png'> Non riesco a riscrivere le scelte. " . $conn->error . " <a href='index.php?page=modificaScelte' class='button'>Riprova</a>");
			}

			echo "<img src='img/accept.png'> Eseguito. Attività nuova: " . $attNuova . " - " . $titolo . "<br><br><a href='index.php?page=modificaScelte' class='button'>Altro cambio</a>";

		} else if ($num_iscritti >= $max_iscritti) {
			echo "<img src='img/warning.png'> Cambio non possibile, attività piena. Provane un'altra: <a href='index.php?page=modificaScelte' class='button'>Riprova</a>";
		} else {
			echo "<img src='img/error.png'> Errore sconosciuto, ricontrolla i dati inseriti. <a href='index.php?page=modificaScelte' class='button'>Riprova</a>";
		}
	}	//chiude if (!isset($_POST['cerca']))
	?>
</div>
