<?php	if ($_SESSION['comm'] != 1 && $_SESSION['aiuto'] != 1){
			header ("Location: login.php?level=comm&location=vediScelte");
		}
		?>
		<div class='jumbotron text-center jumbotron-fluid'><span id="scritto">Vedi scelte</span></div>
		<div class="page_text">
		<?php

		if (!isset($_POST['cerca'])) { ?>

				<form method="POST" action="index.php?page=vediScelte">

					<fieldset><legend>Dati allievo</legend>
						ID allievo: <input type="number" name="id_utente"><br><br>

						------------ OPPURE ------------<br><br>

						Nome: <input type="text" name="nome"><br><br>

						Cognome: <input type="text" name="cognome"><br><br>

						Classe:
	<?php					$queryClassi = "SELECT classe FROM utenti WHERE classe != 'ND' GROUP BY classe";
						$resultClassi = $conn->query($queryClassi); ?>
						<select name="classe">
							<option value="">Scegli la classe</option>
	<?php						while($row = $resultClassi->fetch_assoc()){
								$classe = $row['classe'];?>
								<option value="<?php echo $classe;?>"><?php echo $classe; ?></option>
	<?php						} ?>
						</select>
					</fieldset><br>

					<input type="submit" name="cerca" value="Esegui">

				</form>
	<?php 	} else {

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

					} else {
						die("<img src='img/warning.png'> Errore, controlla i dati inseriti. <a href='index.php?page=vediScelte' class='button'>Riprova</a>");
					}
				} else { 	//se inseriti nome, cognome e classe

					$nome = $_POST['nome'];
					$cognome = $_POST['cognome'];
					$classe = $_POST['classe'];

					$queryNome = "SELECT id_utente FROM utenti WHERE nome = '$nome' AND cognome = '$cognome' AND classe = '" . rtrim($classe) . "'";
					$resultNome = $conn->query($queryNome);

					if ($resultNome->num_rows > 0) {
						while ($rowNome = $resultNome->fetch_assoc()) {
							$id_utente = $rowNome[id_utente];
						}
					} else {
						die("<img src='img/warning.png'> Errore, controlla i dati inseriti. <a href='index.php?page=vediScelte' class='button'>Riprova</a>");
					}
				}

	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				$expgiorno1 = explode(" ", $_SESSION['giorni'][1]);
				$expgiorno2 = explode(" ", $_SESSION['giorni'][2]);
				$expgiorno3 = explode(" ", $_SESSION['giorni'][3]);
				$expgiorno4 = explode(" ", $_SESSION['giorni'][4]);
				$expgiorno5 = explode(" ", $_SESSION['giorni'][5]);
				$expgiorno6 = explode(" ", $_SESSION['giorni'][6]);
				$expgiorno7 = explode(" ", $_SESSION['giorni'][7]);
				$expgiorno8 = explode(" ", $_SESSION['giorni'][8]);
				$expgiorno9 = explode(" ", $_SESSION['giorni'][9]);

				for ($i = 1; $i < 10; $i++) {

					$query = "SELECT id_att, aula, timestamp, titolo FROM scelte s, proposte p WHERE s.id_utente = '" . $id_utente . "' AND p.id_att=s.att" . $i;
					$result = $conn->query($query);

					$obj = $result->fetch_object();

					$att[$i] = $obj->id_att;
					$aula[$i] = $obj->aula;
					$titolo[$i] = $obj->titolo;

					if ($att[$i] == 0) {
						$att[$i] = "Non iscritto";
					}

					if ($aula[$i] != "") {
						$aula[$i] = " (aula " . $aula[$i] . ")";
					}
				}

				$timestamp = $obj->timestamp;

				mysqli_free_result($result); ?>

				<h3>Le tue attività</h3>
				<table class="table table-striped">
					<tr>
						<td>ID allievo</td>
						<td><?php echo $id_utente; ?></td>
					</tr>
					<tr>
						<td>Nome</td>
						<td><?php echo $nome; ?></td>
					</tr>
					<tr>
						<td>Cognome</td>
						<td><?php echo $cognome; ?></td>
					</tr>
					<tr>
						<td>Classe</td>
						<td><?php echo $classe; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno1[0] . " " . $expgiorno1[1] . " " . $expgiorno1[2] . "<br>" . $expgiorno1[3] . "<br>" . $expgiorno1[4]; ?></td>
						<td><?php echo $att[1] . $aula[1] . "<br>" . $titolo[1]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno2[0] . " " . $expgiorno2[1] . " " . $expgiorno2[2] . "<br>" . $expgiorno2[3] . "<br>" . $expgiorno2[4]; ?></td>
						<td><?php echo $att[2] . $aula[2] . "<br>" . $titolo[2]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno3[0] . " " . $expgiorno3[1] . " " . $expgiorno3[2] . "<br>" . $expgiorno3[3]; ?></td>
						<td><?php echo $att[3] . $aula[3] . "<br>" . $titolo[3]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno4[0] . " " . $expgiorno4[1] . " " . $expgiorno4[2] . "<br>" . $expgiorno4[3] . "<br>" . $expgiorno4[4]; ?></td>
						<td><?php echo $att[4] . $aula[4] . "<br>" . $titolo[4]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno5[0] . " " . $expgiorno5[1] . " " . $expgiorno5[2] . "<br>" . $expgiorno5[3] . "<br>" . $expgiorno5[4]; ?></td>
						<td><?php echo $att[5] . $aula[5] . "<br>" . $titolo[5]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno6[0] . " " . $expgiorno6[1] . " " . $expgiorno6[2] . "<br>" . $expgiorno6[3]; ?></td>
						<td><?php echo $att[6] . $aula[6] . "<br>" . $titolo[6]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno7[0] . " " . $expgiorno7[1] . " " . $expgiorno7[2] . "<br>" . $expgiorno7[3] . "<br>" . $expgiorno7[4]; ?></td>
						<td><?php echo $att[7] . $aula[7] . "<br>" . $titolo[7]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno8[0] . " " . $expgiorno8[1] . " " . $expgiorno8[2] . "<br>" . $expgiorno8[3] . "<br>" . $expgiorno8[4]; ?></td>
						<td><?php echo $att[8] . $aula[8] . "<br>" . $titolo[8]; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno9[0] . " " . $expgiorno9[1] . " " . $expgiorno9[2] . "<br>" . $expgiorno9[3]; ?></td>
						<td><?php echo $att[9] . $aula[9] . "<br>" . $titolo[9]; ?></td>
					</tr>
					<tr>
						<td>Iscritto il</td>
						<td><?php echo $timestamp;?></td>
					</tr>
				</table><br>

				<div id="non-printable">
					<a class="button" onclick="window.print();">Stampa</a><br><br>
				</div><!--chiude non-printable-->
			</div>
<?php	}
