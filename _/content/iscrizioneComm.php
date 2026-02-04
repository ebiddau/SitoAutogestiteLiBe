<?php
if ($_SESSION['admin'] != 1) {
	header ("Location: login.php?location=iscrizioneComm&level=admin");
}
?>
<div class='jumbotron text-center jumbotron-fluid'>Iscrizione commissione</div>
<div class="page_text">

	<b>Nota importante:</b> le modifiche saranno effettive al prossimo login dell'utente in questione!<br><br>
	<h3>Allievi attualmente nella commissione</h3>
	<?php

	$sql = "SELECT * FROM utenti WHERE comm=1 AND classe != 'Docente'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		?>
		<table class="table table-striped sortable">
			<thead class="thead-light">
				<tr>
					<th>ID</th>
					<th>Nome</th>
					<th>Cognome</th>
					<th>Classe</th>
					<th>Azioni</th>
				</tr>
			</thead>
			<tbody>
		<?php
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>" . $row["id_utente"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["cognome"] . "</td><td>" . $row["classe"] . "</td><td><form method='post' action='index.php?page=iscrizioneComm'><input type='hidden' name='id_utente' value='" . $row["id_utente"] . "'><input type='submit' name='ok2' value='Rimuovi dalla commissione'></form></td></tr>";
		}
		?> </tbody>
	</table><br><br> <?php
	} else {
		echo "Nessuno<br><br>";
	}


	if (isset($_POST['ok'])) {

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

		$query = "UPDATE utenti SET comm=1 WHERE id_utente='" . $id_utente . "'";
		$result= $conn->query($query);

		$query = "UPDATE scelte SET att1=NULL, att2=NULL, att3=NULL, att4=NULL, att5=NULL, att6=NULL, att7=NULL, att8=NULL, att9=NULL WHERE id_utente='" . $id_utente . "'";
		$result= $conn->query($query);

		if ($conn->affected_rows > 0) {
			echo "OK";
		} else {
			echo "Non ha funzionato...<br>Nome utente errato oppure già iscritto! <a class='button' href='index.php?page=iscrizioneComm'>Riprova</a> " . $conn->error;
		}

	} ?>
		<h3>Aggiungi un allievo in commissione</h3>
		<p>Inserisci l'ID dell'allievo, oppure, alternativamente, il suo nome, cognome, e la sua classe.</p>
		<form method="post" action="index.php?page=iscrizioneComm">

			<table class="table table-striped sortable">
				<thead class="thead-light">
					<tr>
						<th>ID allievo</th>
						<th>Nome</th>
						<th>Cognome</th>
						<th>Classe</th>
					</tr>
				</thead>
				<tbody>
				<tr>
					<td> <input type="number" name="id_utente"> </td>
					<td> <input type="text" name="nome"> </td>
					<td> <input type="text" name="cognome"> </td>
					<td>
						<?php
						$queryClassi = "SELECT classe FROM utenti WHERE classe != 'Docente' GROUP BY classe";
						$resultClassi = $conn->query($queryClassi); ?>

						<select name="classe">
							<option value="">Scegli la classe</option><?php
							while($row = $resultClassi->fetch_assoc()) {
								$classe = $row['classe'];?>
								<option value="<?php echo $classe;?>"><?php echo $classe; ?></option><?php
							} ?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>

		<input type="submit" name="ok" value="Aggiungi!"><br><br>
		</form>
	<br><?php

	if (isset($_POST['ok2'])) {

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

		$query = "UPDATE utenti SET comm=0 WHERE id_utente='" . $id_utente . "'";
		$result= $conn->query($query);

		if ($conn->affected_rows > 0) {
			echo "OK <a class='button' href='index.php?page=iscrizioneComm'>Ancora</a>";
		} else {
			echo "Non ha funzionato...<br>Nome utente errato oppure non iscritto! <a class='button' href='index.php?page=iscrizioneComm'>Riprova</a> " . $conn->error;
		}

	}
	?>
	<hr>
	<div class='jumbotron text-center jumbotron-fluid'>Iscrizione aiuti</div>

	<?php

	if (isset($_POST['ok'])) {

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

		$query = "UPDATE utenti SET aiuto=1 WHERE id_utente='" . $id_utente . "'";
		$result= $conn->query($query);

		$query = "UPDATE scelte SET att1=0, att2=0, att3=0, att4=0, att5=0, att6=0 WHERE id_utente='" . $id_utente . "'";
		$result= $conn->query($query);

		if ($conn->affected_rows > 0) {
			echo "OK <a class='button' href='index.php?page=iscrizioneComm'>Ancora</a>";
		} else {
			echo "Non ha funzionato...<br>Nome utente errato oppure già iscritto! <a class='button' href='index.php?page=iscrizioneComm'>Riprova</a> " . $conn->error;
		}

	} else {?>
		<h3>Iscrivere come aiuto</h3>
		<form method="post" action="index.php?page=iscrizioneComm">
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

			<input type="submit" name="ok" value="Iscrivi!"><br><br>
		</form><?php
	} ?>
	<br><?php

	if (isset($_POST['ok2'])) {

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
				die("<img src='img/warning.png'> Errore, controlla i dati dell'allievo. <a href='index.php?page=iscrizioneComm' class='button'>Riprova</a>");
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
				die("<img src='img/warning.png'> Errore, controlla i dati dell'allievo. <a href='index.php?page=iscrizioneComm' class='button'>Riprova</a>");
			}
		}

		$query = "UPDATE utenti SET aiuto=0 WHERE id_utente='" . $id_utente . "'";
		$result= $conn->query($query);

		if ($conn->affected_rows > 0) {
			echo "OK <a class='button' href='index.php?page=iscrizioneComm'>Ancora</a>";
		} else {
			echo "Non ha funzionato...<br>Nome utente errato oppure non iscritto! <a class='button' href='index.php?page=iscrizioneComm'>Riprova</a> " . $conn->error;
		}

	} else {?>
		<h3>Rimuovere come aiuto</h3>
		<form method="post" action="index.php?page=iscrizioneComm">
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

			<input type="submit" name="ok2" value="Rimuovi!"><br><br>
		</form><?php
	}
	?>
</div>
