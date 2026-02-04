<?php
if (!isset($_SESSION['username'])){
	header ("Location: login.php?location=proposta");
} ?>


<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Proposta attività</span></div>
<div class="page_text">

<?php

$queryOn = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiProposte'");
$resultOn = $queryOn->fetch_object();
$abilitata = $resultOn->abilitata;

if ($abilitata == 1 OR $_SESSION['comm'] = 1) {

	if (isset($_POST['invia'])) {

		$disponibilita = implode(",", $_POST['disponibilita']);

		if ($_POST['miniscritti'] == "") {
			$_POST['miniscritti'] = 0;
		}

		if ($_POST['maxiscritti'] == "") {
			$_POST['maxiscritti'] = 30;
		}

		if ($_POST['relatore1'] == "") {
			$rel1 = "";
		} else {
			$rel1 = ripulisci($_POST['relatore1']);
		}

		if ($_POST['relatore2'] == "") {
			$rel2 = "";
		} else {
			$rel2 = ripulisci($_POST['relatore2']);
		}

		if ($_POST['relatore3'] == "") {
			$rel3 = "";
		} else {
			$rel3 = ripulisci($_POST['relatore3']);
		}

		$sqlInsert = "INSERT INTO proposte (id_utente, email, numtel, relatore1, relatore2, relatore3, numtelrel, emailrel, referenze, disponibilita, titolo, descrizione, min_iscritti, max_iscritti, materiale, osservazioni) VALUES ('" . $_SESSION['id'] . "', '" . ripulisci($_POST['email']) . "', '" . ripulisci($_POST['numtel']) . "', '" . $rel1 . "', '" . $rel2 . "', '" . $rel3 . "', '" . ripulisci($_POST['numtelrel']) . "', '" . ripulisci($_POST['emailrel']) . "', '" . ripulisci($_POST['referenze']) . "', '" . $disponibilita . "', '" . ripulisci($_POST['titolo']) . "', '" . ripulisci($_POST['descrizione']) . "', '" . ripulisci($_POST['miniscritti']) . "', '" . ripulisci($_POST['maxiscritti']) . "', '" . ripulisci($_POST['materiale']) . "', '" . ripulisci($_POST['osservazioni']) . "')";



		if ($conn->query($sqlInsert) == TRUE) {
			echo "Proposta registrata!<br><br><a class='button' href='index.php?page=proposta'>Fanne un'altra!</a><br><br><a class='button' href='index.php'>Torna alla home</a>";
		} else {
			echo "Errore: " . $conn->error;
		}
	} else { ?>

			Per proporre un'attività devi riempire questo modulo Google: <a target="_blank" href="https://docs.google.com/forms/d/1WK4dBA-TI1PUM7OLcL7LYT0HP50g82jmi1Ms0amTJCw/edit">https://docs.google.com/forms/d/1WK4dBA-TI1PUM7OLcL7LYT0HP50g82jmi1Ms0amTJCw/edit</a>

			<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
			<!--NASCONDO TUTTO IL FORM DI ISCRIZIONE -->
			<?php if (1==0) { ?>
			<!--NASCONDO TUTTO IL FORM DI ISCRIZIONE -->
			<!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->


			Tutti i campi indicati con un asterisco sono obbligatori.<br><br>
			<form method="post" action="index.php?page=proposta" id="formProp">

					<h2>Informazioni studente</h2>
					<table class="table table-striped">
						<tr>
							<td>Nome</td> <td><?php echo $_SESSION['nome']; ?></td>
						</tr>
						<tr>
							<td>Cognome</td> <td><?php echo $_SESSION['cognome']; ?></td>
						</tr>
						<tr>
							<td>Classe</td> <td><?php echo $_SESSION['classe']; ?></td>
						</tr>
						</table>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputNumTel1">Num. telefonico*</label>
								<input class="form-control" type="number" name="numtel" required id="inputNumTel1" placeholder="Esempio: 0791234567">
							</div>
							<div class="form-group col-md-6">
								<label for="inputEmail1">Indirizzo e-mail*</label>
								<input class="form-control" type="email" name="email" required id="inputEmail1">
							</div>
						</div>


					  <h2>Informazioni relatore</h2>
						<p>Ci serviranno per contattare <u>il relatore</u>, quindi assicurati che sia tutto corretto!</p><br>
						<p>Se ci sono più relatori, indicali uno per campo; se ce n'è uno solo, riempi solo il primo campo.</p><br>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="relatore1">Relatore*</label>
								<input class="form-control" type="text" name="relatore1" id="relatore1" required placeholder="Es: Georg Wilhelm Friedrich Hegel">
							</div>
							<div class="form-group col-md-3">
								<label for="relatore2">Ev. secondo relatore*</label>
								<input class="form-control" type="text" name="relatore2" id="relatore2" required placeholder="Es: Caio Giulio Cesare">
							</div>
							<div class="form-group col-md-3">
								<label for="relatore3">Ev. terzo relatore (es. Mario Rossi)*</label>
								<input class="form-control" type="text" name="relatore3" id="relatore3" required placeholder="Es: Carlo Marx">
							</div>
							<div class="form-group col-md-6">
								<label for="numtelrel">Num. telefonico*</label>
								<input class="form-control" type="number" name="numtelrel" id="numtelrel" required placeholder="Esempio: 0791234567">
							</div>
							<div class="form-group col-md-6">
								<label for="emailrel">Indirizzo e-mail*</label>
								<input class="form-control" type="email" name="emailrel" id="emailrel" required>
							</div>
							<div class="form-group col-md-12">
								<label for="referenze">Referenze* <br> Spiega brevemente cosa ha fatto il relatore nella sua vita (titoli di studio ecc.), <b>relativo alla proposta</b></label>
								<textarea class="form-control" type="text" name="referenze" id="referenze" required></textarea>
							</div>
						</div>

						Date disponibili*:<br>

						<div class="form-row">
							<div class="form-group col-md-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita1" value="1">
								  <label class="form-check-label" for="disponibilita1">
								    <?php echo $_SESSION['giorni'][1]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita2" value="2">
								  <label class="form-check-label" for="disponibilita2">
								    <?php echo $_SESSION['giorni'][2]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita3" value="3">
								  <label class="form-check-label" for="disponibilita3">
								    <?php echo $_SESSION['giorni'][3]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita4" value="4">
								  <label class="form-check-label" for="disponibilita4">
								    <?php echo $_SESSION['giorni'][4]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita5" value="5">
								  <label class="form-check-label" for="disponibilita5">
								    <?php echo $_SESSION['giorni'][5]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita6" value="6">
								  <label class="form-check-label" for="disponibilita6">
								    <?php echo $_SESSION['giorni'][6]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita7" value="7">
								  <label class="form-check-label" for="disponibilita7">
								    <?php echo $_SESSION['giorni'][7]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita8" value="8">
								  <label class="form-check-label" for="disponibilita8">
								    <?php echo $_SESSION['giorni'][8]; ?>
								  </label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="disponibilita[]" id="disponibilita9" value="9">
								  <label class="form-check-label" for="disponibilita9">
								    <?php echo $_SESSION['giorni'][9]; ?>
								  </label>
								</div>
							</div>
						</div>


						Informazioni proposta
						Titolo*: <input type="text" name="titolo" required><br><br>
						Descrizione dell'attività*:<br>
						Cerca di essere breve, ma spiega bene cosa si farà<br>
						<textarea style="resize:none; height:200px; width:500px;" name="descrizione" required></textarea><br><br>
						Minimo iscritti: <input type="number" name="miniscritti" min="0" max="200"><br>
						<u>Se non c'è un limite, lascia vuoto!</u><br><br>
						Massimo iscritti: <input type="number" name="maxiscritti" min="0" max="200"><br>
						<u>Se non c'è un limite, lascia vuoto!</u><br><br>
						Materiale necessario:<br>
						Per esempio beamer, palestra, spazio all'aperto, ...<br>
						<textarea style="resize:none; height:200px; width:500px;" name="materiale"></textarea><br><br>
						Eventuali osservazioni:<br>
						<textarea style="resize:none; height:200px; width:500px;" name="osservazioni" ></textarea><br>

					<!--<input type="submit" name="invia" value="Invia la proposta!">-->
					<button style="position:relative;left:0px;" type="submit" form="formProp" name="invia" value="invia">Invia la proposta!</button><br><br>
			</form>

		<?php } ?>


		<script>

		</script><?php
	}
} else {
	echo "<p>Al momento non è possibile proporre delle attività</p>";
} ?>

</div>
</div>
