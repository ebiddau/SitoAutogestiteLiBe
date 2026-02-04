<?php
if (!isset($_SESSION['username'])) {
	header("Location: login.php?location=iscrizioneAll");
}

$queryOn = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiIscrizione'");
$resultOn = $queryOn->fetch_object();
$abilitata = $resultOn->abilitata;

if ($abilitata == 1) {

	$queryCheck = "SELECT att1, att2, att3, att4, att5, att6, att7, att8, att9 FROM scelte WHERE id_utente=" . $_SESSION['id'];
	$resultCheck = $conn->query($queryCheck);

	while ($rowCheck = $resultCheck->fetch_assoc()) {
		$attC1 = $rowCheck['att1'];
		$attC2 = $rowCheck['att2'];
		$attC3 = $rowCheck['att3'];
		$attC4 = $rowCheck['att4'];
		$attC5 = $rowCheck['att5'];
		$attC6 = $rowCheck['att6'];
		$attC7 = $rowCheck['att7'];
		$attC8 = $rowCheck['att8'];
		$attC9 = $rowCheck['att9'];
	}

	if ($attC1 != 0 && $attC2 != 0 && $attC3 != 0 && $attC4 != 0 && $attC5 != 0 && $attC6 != 0 && $attC7 != 0 && $attC8 != 0 && $attC9 != 0) {
		//già iscritto
		echo "<script>window.location='index.php?page=profilo&status=2';</script>";
	} else if ($attC4 != 0 && $attC5 != 0 && $attC6 != 0) {
		echo "<script>window.location='index.php?page=giornata3';</script>";
	} else if ($attC1 != 0 && $attC2 != 0 && $attC3 != 0) {
		echo "<script>window.location='index.php?page=giornata2';</script>";
	} else {

		$limCaffe = 180;
		$limMulti = 100;
		$limGen = 30;	?>

		<div class='jumbotron text-center jumbotron-fluid'>Iscrizione autogestite - prima giornata</div>
		<div class="page_text">

			<?php require("template/infoIscrizione.php"); ?>

			<?php
			if (isset($_GET['msg'])) {
				if ($_GET['msg'] == '404') {
					echo "<h3 style='color:red;'>Una o più attività non esistono!</h3>";
				} else if ($_GET['msg'] == "202") {
					echo "<h3 style='color:red;'>Una o più attività sono piene!</h3>";
				}
			} ?>

			<form method="POST" action="index.php?page=salvaScelte&g=1">

				<h1>Scegli per <?php echo $_SESSION['giorni'][1]; ?></h1>
				<span id='ok1'></span><?php

															$queryC1 = "SELECT titolo, id_att, max_iscritti, descrizione, attivita_doppia, sport FROM proposte WHERE giorno=1";
															$resultC1 = $conn->query($queryC1);

															while ($row1 = $resultC1->fetch_array()) {
																$id_att1 = $row1['id_att'];
																$titolo1 = $row1['titolo'];
																$descriz1 = $row1['descrizione'];
																$max_iscritti1 = $row1['max_iscritti'];
																$attivita_doppia = $row1['attivita_doppia'];

																$query1 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att1=p.id_att AND p.giorno=1 AND p.id_att=" . $id_att1;
																$result1 = $conn->query($query1);
																$conteggio1 = $result1->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att1;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio1 >= $max_iscritti1) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz1 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="1" value="<?php echo $id_att1 ?>" disabled required onclick="controllo1()" <?php if ($attivita_doppia == 1) { ?> class="attivita_doppia" <?php } ?> <?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" class="sport-soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att1 . " - " . $titolo1 ?></div>
							</div>
						</label>
						<?php if ($attivita_doppia == 1) { ?>
							<div class="alert alert-warning" style="margin-bottom: 0;">
								<strong>🔝 Attenzione!</strong> Quest'attività dura tutto il mattino: se scelta, non potrai selezionarne altre per la fascia 10:10-11:45.
							</div>
						<?php } ?>
						<br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz1 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="1" value="<?php echo $id_att1 ?>" required onclick="controllo1()" <?php if ($attivita_doppia == 1) { ?> class="attivita_doppia" <?php } ?> <?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" class="sport-soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att1 . " - " . $titolo1 ?></div>
							</div>
						</label>
						<?php if ($attivita_doppia == 1) { ?>
							<div class="alert alert-warning" style="margin-bottom: 0;">
								<strong>🔝 Attenzione!</strong> Quest'attività dura tutto il mattino: se scelta, non potrai selezionarne altre per la fascia 10:10-11:45.
							</div>
						<?php } ?>
						<br>
				<?php
																}
															}

															mysqli_free_result($resultC1);
															mysqli_free_result($result1);
															mysqli_free_result($resultColor); ?>
				<br>


				<h1>Scegli per <?php echo $_SESSION['giorni'][2]; ?></h1>
				<span id='ok2'></span><?php

															$queryC2 = "SELECT titolo, id_att, max_iscritti, descrizione, attivita_doppia, sport FROM proposte WHERE giorno=2";
															$resultC2 = $conn->query($queryC2);

															while ($row2 = $resultC2->fetch_array()) {
																$id_att2 = $row2['id_att'];
																$titolo2 = $row2['titolo'];
																$descriz2 = $row2['descrizione'];
																$max_iscritti2 = $row2['max_iscritti'];

																$query2 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att2=p.id_att AND p.giorno=2 AND p.id_att=" . $id_att2;
																$result2 = $conn->query($query2);
																$conteggio2 = $result2->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att2;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio2 >= $max_iscritti2) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz2 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="2" value="<?php echo $id_att2 ?>" disabled required onclick="controllo2()"
										<?php if ($row2['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att2 . " - " . $titolo2 ?></div>
							</div>
						</label><br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz2 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="2" value="<?php echo $id_att2 ?>" required onclick="controllo2()"
										<?php if ($row2['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att2 . " - " . $titolo2 ?></div>
							</div>
						</label><br>
				<?php
																}
															}

															mysqli_free_result($resultC2);
															mysqli_free_result($result2);
															mysqli_free_result($resultColor); ?>
				<br>


				<h1>Scegli per <?php echo $_SESSION['giorni'][3]; ?></h1>
				<span id='ok3'></span><?php

															$queryC3 = "SELECT titolo, id_att, max_iscritti, descrizione, attivita_doppia, sport FROM proposte WHERE giorno=3";
															$resultC3 = $conn->query($queryC3);

															while ($row3 = $resultC3->fetch_array()) {
																$id_att3 = $row3['id_att'];
																$titolo3 = $row3['titolo'];
																$descriz3 = $row3['descrizione'];
																$max_iscritti3 = $row3['max_iscritti'];

																$query3 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att3=p.id_att AND p.giorno=3 AND p.id_att=" . $id_att3;
																$result3 = $conn->query($query3);
																$conteggio3 = $result3->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att3;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio3 >= $max_iscritti3) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz3 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="3" value="<?php echo $id_att3 ?>" disabled required onclick="controllo3()"
										<?php if ($row3['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att3 . " - " . $titolo3 ?></div>
							</div>
						</label><br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz3 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="3" value="<?php echo $id_att3 ?>" required onclick="controllo3()"
										<?php if ($row3['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att3 . " - " . $titolo3 ?></div>
							</div>
						</label><br>
				<?php
																}
															}

															mysqli_free_result($resultC3);
															mysqli_free_result($result3);
															mysqli_free_result($resultColor); ?>
				<br>

				<input class="btn btn-outline-primary" value="Avanti" name="invia" type="submit">
			</form>
		</div>

		<script type="text/javascript" language="javascript">
			function controllo1() {
				var radios1 = $('input[name=1]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok1").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=1&id=" + radios1, true);
				xhttp.send();

				// Operazioni da eseguire se l'attività occupa tutta la mattinata
				var class_doppia = $('input[name=1]:checked').attr('class');
				$('input[name=2][class="attivita_doppia_copia"]').remove();
				if (class_doppia == "attivita_doppia") {
					$('input[name=2]:checked').prop('checked', false);
					$('input[name=2]').attr('disabled', true);
					$("input[name=2]").parent().parent().parent().addClass("radio_disabled_parent");
					new_selected_input = '<input type="radio" checked="checked" class="attivita_doppia_copia" name="2" value="' + radios1 + '" style="display: none;">';
					$("#ok2").after(new_selected_input);
					document.getElementById("ok2").innerHTML = "";
				} else {
					$('.radio_disabled_parent input').attr('disabled', false);
					$("input[name=2]").parent().parent().parent().removeClass("radio_disabled_parent");
					$('input[name=2][class="attivita_doppia_copia"]:checked').prop('checked', false);
				}
				// Gestione sport soft
				var sport = $('input[name=1]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=1]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}
					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=2][data-sport="Soft"], input[name=3][data-sport="Soft"]').attr('disabled', true);
					$('input[name=2][data-sport="Soft"], input[name=3][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=2][data-sport="Soft"]:checked').length > 0) {
						$('input[name=2][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=3][data-sport="Soft"]:checked').length > 0) {
						$('input[name=3][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
					$('#avviso-sport-soft').remove();

					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=2][data-sport="Soft"]:checked, input[name=3][data-sport="Soft"]:checked').length == 0) {
						$('input[name=2][data-sport="Soft"], input[name=3][data-sport="Soft"]').attr('disabled', false);
						$('input[name=2][data-sport="Soft"], input[name=3][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}

			function controllo2() {
				var radios2 = $('input[name=2]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok2").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=2&id=" + radios2, true);
				xhttp.send();

				// Gestione sport soft
				var sport = $('input[name=2]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=2]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}
					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=1][data-sport="Soft"], input[name=3][data-sport="Soft"]').attr('disabled', true);
					$('input[name=1][data-sport="Soft"], input[name=3][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=1][data-sport="Soft"]:checked').length > 0) {
						$('input[name=1][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=3][data-sport="Soft"]:checked').length > 0) {
						$('input[name=3][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
        			$('#avviso-sport-soft').remove();

					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=1][data-sport="Soft"]:checked, input[name=3][data-sport="Soft"]:checked').length == 0) {
						$('input[name=1][data-sport="Soft"], input[name=3][data-sport="Soft"]').attr('disabled', false);
						$('input[name=1][data-sport="Soft"], input[name=3][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}

			function controllo3() {
				var radios3 = $('input[name=3]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok3").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=3&id=" + radios3, true);
				xhttp.send();
				// Gestione sport soft
				var sport = $('input[name=3]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=2]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}

					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=1][data-sport="Soft"], input[name=2][data-sport="Soft"]').attr('disabled', true);
					$('input[name=1][data-sport="Soft"], input[name=2][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=1][data-sport="Soft"]:checked').length > 0) {
						$('input[name=1][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=2][data-sport="Soft"]:checked').length > 0) {
						$('input[name=2][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
        			$('#avviso-sport-soft').remove();
					
					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=1][data-sport="Soft"]:checked, input[name=2][data-sport="Soft"]:checked').length == 0) {
						$('input[name=1][data-sport="Soft"], input[name=2][data-sport="Soft"]').attr('disabled', false);
						$('input[name=1][data-sport="Soft"], input[name=2][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}
		</script><?php
						}
					} else if ($_SESSION['comm'] == 1) {
						echo "<div class='jumbotron text-center jumbotron-fluid'>Iscrizione autogestite LiBe</div> Per i membri della commissione non è necessario iscriversi.";
					}
							?>