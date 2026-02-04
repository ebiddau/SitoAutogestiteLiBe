<?php
if ($_SESSION['comm'] != 1 && $_SESSION['aiuto'] != 1) {
	header("Location: login.php?level=comm&location=liste");
}
if ($_POST['lista'] == "comm") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista commissione</div>";
} else if ($_POST['lista'] == "prop") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista proponenti</div>";
} else if ($_POST['lista'] == "nonisc") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista allievi non iscritti</div>";
} else if ($_POST['lista'] == "overfl") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista attività sopra il limite</div>";
} else if ($_POST['lista'] == "underfl") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista attività sotto il limite</div>";
} else if ($_POST['lista'] == "aiuti") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista aiuti</div>";
} else if ($_POST['lista'] == "iscritti") {
	$id_att = $_POST['id_att'];

	$queryC1 = "SELECT giorno FROM proposte WHERE id_att=" . $id_att;
	$resultC1 = $conn->query($queryC1);

	$giorno = $resultC1->fetch_object()->giorno;
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista iscritti all'attività " . $id_att . " - " . $_SESSION['giorni'][$giorno] . "</div>";
} else if ($_POST['lista'] == "classe") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista allievi della " . $_POST['classe'] . "</div>";
} else if ($_POST['lista'] == "sconosciuti") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista allievi non marcati</div>";
} else if ($_POST['lista'] == "allievi") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista allievi</div>";
} else if ($_POST['lista'] == "aule") {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Lista aule</div>";
} else {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Liste</div>";
} ?>


<div class="page_text">
	<div id='non-printable'>
		Per riordinare la tabella, clicca sulla colonna corrispondente.<br><br>
		<form method="POST" action="index.php?page=liste">
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="allievi">Allievi
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="aule">Aule
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="comm">Commissione
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="aiuti">Aiuti
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="prop">Proponenti
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="classi">Proposte per classe
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="nonisc">Non iscritti
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="sconosciuti">Non marcati
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="overfl">Attività sopra il limite
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="underfl">Attività sotto il limite
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="classe" id="classe">Allievi della<?php
																																																						$queryClassi = "SELECT classe FROM utenti WHERE classe != 'Docente' GROUP BY classe";
																																																						$resultClassi = $conn->query($queryClassi); ?>
					<select name="classe" onfocus="selezionaClasse()">
						<option value="">Scegli la classe</option><?php
																											while ($row = $resultClassi->fetch_assoc()) {
																												$classe = $row['classe']; ?>
							<option value="<?php echo $classe; ?>"><?php echo $classe; ?></option><?php
																																									} ?>
					</select>
				</label>
			</div>
			<div class="form-check-inline">
				<label class="form-check-label">
					<input type="radio" class="form-check-input" name="lista" value="iscritti" id="iscritti">Iscritti all'attività nr. <input type="number" style="width:50px;" name="id_att" min="1" onfocus="selezionaIscritti()">
				</label>
			</div>

			<input type="submit" name="invia" value="Visualizza">
			<a class='button' onclick='window.print();'>Stampa</a>
		</form>


	</div><!--chiude non-printable-->
	<?php
	if (isset($_POST['invia'])) {

		if ($_POST['lista'] == "allievi") {

			$sql = "SELECT * FROM utenti WHERE classe != 'Docente'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Classe</th></thead><tbody>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id_utente"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["cognome"] . "</td><td>" . $row["classe"] . "</td></tr>";
				}
				echo "</tbody></table><br>";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "comm") {

			$sql = "SELECT * FROM utenti WHERE comm=1 AND classe != 'Docente'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Classe</th></thead><tbody>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id_utente"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["cognome"] . "</td><td>" . $row["classe"] . "</td></tr>";
				}
				echo "</tbody></table><br>";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "aiuti") {

			$sql = "SELECT * FROM utenti WHERE aiuto=1 AND classe != 'Docente'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>ID</th><th>Nome</th><th>Cognome</th><th>Classe</th></thead><tbody>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id_utente"] . "</td><td>" . $row["nome"] . "</td><td>" . $row["cognome"] . "</td><td>" . $row["classe"] . "</td></tr>";
				}
				echo "</tbody></table><br>";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "aule") {

			$sql = "SELECT id_att, aula FROM proposte WHERE accettata=1 ORDER BY id_att ASC";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>ID</th><th>Aula</th></thead><tbody>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["id_att"] . "</td><td>" . $row["aula"] . "</td></tr>";
				}
				echo "</tbody></table><br>";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "prop") {

			$queryProp = "SELECT p.id_utente, titolo, nome, cognome, u.classe, id_att FROM proposte p, utenti u WHERE p.id_utente= u.id_utente AND accettata=1 AND p.id_att > 0";
			$resultProp = $conn->query($queryProp);

			echo "<table class='sortable'><thead><tr><th>ID att</th><th>Proponente</th><th>Classe</th><th>Titolo</th></tr></thead><tbody>";

			while ($row1 = $resultProp->fetch_array()) {
				echo "<tr><td>" . $row1["id_att"] . "</td><td>" . $row1["nome"] . " " . $row1["cognome"] . "</td><td>" . $row1["classe"] . "</td><td>" . $row1["titolo"] . "</td></tr>";
			}

			echo "</tbody></table>";
		} else if ($_POST['lista'] == "nonisc") {

			$sql = "SELECT nome, cognome, classe FROM utenti u, scelte s WHERE comm=0 AND aiuto=0 AND s.id_utente = u.id_utente AND att9 IS NULL ORDER BY classe, cognome ASC";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>Nome</th><th>Cognome</th><th>Classe</th></thead><tbody>";
				while ($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["nome"] . "</td><td>" . $row["cognome"] . "</td><td>" . $row["classe"] . "</td></tr>";
				}
				echo "</tbody></table><br><br>";
				echo "Numero totale: " . $result->num_rows . " persone";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "classi") {

			$queryTop = "SELECT utenti.classe, COUNT(p.id_att) AS numProposte FROM proposte p LEFT JOIN utenti ON p.id_utente=utenti.id_utente GROUP BY classe ORDER BY numProposte DESC";
			$resultTop = $conn->query($queryTop);

			echo "<table class='sortable'><thead><tr><th>Classe</th><th>Numero proposte</th></tr></thead><tbody>";

			while ($row2 = $resultTop->fetch_array()) {
				echo "<tr><td>" . $row2["classe"] . "</td><td>" . $row2["numProposte"] . "</td></tr>";
			}

			echo "</tbody></table>";
		} else if ($_POST['lista'] == "overfl") {

			echo "<table class='sortable'><thead><tr><th>ID att</th><th>Titolo</th><th>Iscritti</th><th>Max iscritti</th></thead><tbody>";

			$queryC1 = "SELECT giorno, titolo, id_att, max_iscritti FROM proposte WHERE accettata=1";
			$resultC1 = $conn->query($queryC1);

			while ($row1 = $resultC1->fetch_array()) {
				$id_att = $row1['id_att'];
				$titolo = $row1['titolo'];
				$giorno = $row1['giorno'];
				$max_iscritti = $row1['max_iscritti'];

				$query1 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att" . $giorno . "=p.id_att AND p.giorno=" . $giorno . " AND p.id_att=" . $id_att;
				$result1 = $conn->query($query1);
				$conteggio = $result1->fetch_object()->conteggio;

				if ($conteggio > $max_iscritti) {
					echo "<tr><td>" . $id_att . "</td><td>" . $titolo . "</td><td>" . $conteggio . "</td><td>" . $max_iscritti . "</td></tr>";
				}
			}

			echo "</tbody></table><br>";
		} else if ($_POST['lista'] == "underfl") {

			echo "<table class='sortable'><thead><tr><th>ID att</th><th>Titolo</th><th>Iscritti</th><th>Max iscritti</th></thead><tbody>";

			$queryC1 = "SELECT giorno, titolo, id_att, max_iscritti FROM proposte WHERE accettata=1";
			$resultC1 = $conn->query($queryC1);

			while ($row1 = $resultC1->fetch_array()) {
				$id_att = $row1['id_att'];
				$titolo = $row1['titolo'];
				$giorno = $row1['giorno'];
				$max_iscritti = $row1['max_iscritti'];

				$query1 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att" . $giorno . "=p.id_att AND p.giorno=" . $giorno . " AND p.id_att=" . $id_att;
				$result1 = $conn->query($query1);
				$conteggio = $result1->fetch_object()->conteggio;

				if ($conteggio < $max_iscritti) {
					echo "<tr><td>" . $id_att . "</td><td>" . $titolo . "</td><td>" . $conteggio . "</td><td>" . $max_iscritti . "</td></tr>";
				}
			}

			echo "</tbody></table><br>";
		} else if ($_POST['lista'] == "iscritti") {

			$sql1 = "SELECT u.nome, u.cognome, u.classe FROM scelte s, utenti u WHERE att" . $giorno . "=" . $id_att . " AND s.id_utente = u.id_utente";
			$result1 = $conn->query($sql1);

			if ($result1->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>Nome</th><th>Cognome</th><th>Classe</th></tr></thead><tbody>";
				$totale = 0;
				while ($row1 = $result1->fetch_assoc()) {
					$totale++;
					echo "<tr><td>" . $row1["nome"] . "</td><td>" . $row1["cognome"] . "</td><td>" . $row1["classe"] . "</td></tr>";
				}
				echo "<tr style='text-align:center;'><td colspan='3'>Totale: " . $totale . "</td></tr></tbody></table><br>";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "classe") {

			$classe = $_POST['classe'];

			$sql2 = "SELECT * FROM utenti WHERE classe = '" . $classe . "'";
			$result2 = $conn->query($sql2);

			if ($result2->num_rows > 0) {
				echo "<table class='sortable'><thead><tr><th>Nome</th><th>Cognome</th><th>Admin</th><th>Commissione</th><th>Aiuto</th></tr></thead><tbody>";
				while ($row2 = $result2->fetch_assoc()) {

					if ($row2["aiuto"] == 0) {
						$stampaAiuto = "No";
					} else if ($row2["aiuto"] == 1) {
						$stampaAiuto = "Si";
					}

					if ($row2["comm"] == 0) {
						$stampaComm = "No";
					} else if ($row2["comm"] == 1) {
						$stampaComm = "Si";
					}

					if ($row2["admin"] == 0) {
						$stampaAdmin = "No";
					} else if ($row2["admin"] == 1) {
						$stampaAdmin = "Si";
					}

					echo "<tr><td>" . $row2["nome"] . "</td><td>" . $row2["cognome"] . "</td><td>" . $stampaAdmin . "</td><td>" . $stampaComm . "</td><td>" . $stampaAiuto . "</td></tr>";
				}
				echo "</tbody></table><br><br>";
			} else {
				echo "Nessuno<br><br>";
			}
		} else if ($_POST['lista'] == "sconosciuti") { ?><br><br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][1]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza1=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][2]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza2=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][3]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza3=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][4]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza4=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][5]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza5=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][6]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza6=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][7]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza7=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][8]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza8=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																} ?>
			<br>
			<h3>Sconosciuti <?php echo $_SESSION['giorni'][9]; ?></h3><?php

																																$queryS1 = "SELECT u.nome , u.cognome, classe, u.id_utente FROM assenze a, utenti u WHERE a.assenza9=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
																																$resultS1 = $conn->query($queryS1);

																																while ($row = $resultS1->fetch_array()) {
																																	echo $row['id_utente'] . " - " . $row['nome'] . " " . $row['cognome'] . " " . $row['classe'] . "<br>";
																																}
																															}
																														} ?>
</div>
<script>
	function selezionaIscritti() {
		document.getElementById('iscritti').checked = true;
	}

	function selezionaClasse() {
		document.getElementById('classe').checked = true;
	}
</script>