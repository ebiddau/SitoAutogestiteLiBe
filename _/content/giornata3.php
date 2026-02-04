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
		header("Location: index.php?page=profilo&status=2");	//già iscritto
	} else {

		$limCaffe = 180;
		$limMulti = 100;
		$limGen = 30;	?>

		<div class='jumbotron text-center jumbotron-fluid'>Iscrizione autogestite - terza giornata</div>
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

			<form method="POST" action="index.php?page=salvaScelte&g=3">

				<h1>Scegli per <?php echo $_SESSION['giorni'][7]; ?></h1>
				<span id='ok7'></span><?php

															$queryC7 = "SELECT titolo, id_att, max_iscritti, descrizione, attivita_doppia, sport FROM proposte WHERE giorno=7 AND accettata=1";
															$resultC7 = $conn->query($queryC7);

															while ($row7 = $resultC7->fetch_array()) {
																$id_att7 = $row7['id_att'];
																$titolo7 = $row7['titolo'];
																$descriz7 = $row7['descrizione'];
																$max_iscritti7 = $row7['max_iscritti'];
																$attivita_doppia = $row7['attivita_doppia'];

																$query7 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att7=p.id_att AND p.giorno=7 AND p.id_att=" . $id_att7;
																$result7 = $conn->query($query7);
																$conteggio7 = $result7->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att7;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio7 >= $max_iscritti7) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz7 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="7" value="<?php echo $id_att7 ?>" disabled required onclick="controllo7()" <?php if ($attivita_doppia == 1) { ?> class="attivita_doppia" <?php } ?> <?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" class="sport-soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att7 . " - " . $titolo7 ?></div>
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
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz7 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="7" value="<?php echo $id_att7 ?>" required onclick="controllo7()" <?php if ($attivita_doppia == 1) { ?> class="attivita_doppia" <?php } ?> <?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" class="sport-soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att7 . " - " . $titolo7 ?></div>
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

															mysqli_free_result($resultC7);
															mysqli_free_result($result7);
															mysqli_free_result($resultColor); ?>
				<br>


				<h1>Scegli per <?php echo $_SESSION['giorni'][8]; ?></h1>
				<span id='ok8'></span><?php

															$queryC8 = "SELECT titolo, id_att, max_iscritti, descrizione, sport FROM proposte WHERE giorno=8 AND accettata=1";
															$resultC8 = $conn->query($queryC8);

															while ($row8 = $resultC8->fetch_array()) {
																$id_att8 = $row8['id_att'];
																$titolo8 = $row8['titolo'];
																$descriz8 = $row8['descrizione'];
																$max_iscritti8 = $row8['max_iscritti'];

																$query8 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att8=p.id_att AND p.giorno=8 AND p.id_att=" . $id_att8;
																$result8 = $conn->query($query8);
																$conteggio8 = $result8->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att8;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio8 >= $max_iscritti8) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz8 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="8" value="<?php echo $id_att8 ?>" disabled required onclick="controllo8()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att8 . " - " . $titolo8 ?></div>
							</div>
						</label><br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz8 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="8" value="<?php echo $id_att8 ?>" required onclick="controllo8()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att8 . " - " . $titolo8 ?></div>
							</div>
						</label><br>
				<?php
																}
															}

															mysqli_free_result($resultC8);
															mysqli_free_result($result8);
															mysqli_free_result($resultColor); ?>
				<br>


				<h1>Scegli per <?php echo $_SESSION['giorni'][9]; ?></h1>
				<span id='ok9'></span><?php

															$queryC9 = "SELECT titolo, id_att, max_iscritti, descrizione, sport FROM proposte WHERE giorno=9 AND accettata=1";
															$resultC9 = $conn->query($queryC9);

															while ($row9 = $resultC9->fetch_array()) {
																$id_att9 = $row9['id_att'];
																$titolo9 = $row9['titolo'];
																$descriz9 = $row9['descrizione'];
																$max_iscritti9 = $row9['max_iscritti'];

																$query9 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att9=p.id_att AND p.giorno=9 AND p.id_att=" . $id_att9;
																$result9 = $conn->query($query9);
																$conteggio9 = $result9->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att9;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio9 >= $max_iscritti9) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz9 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="9" value="<?php echo $id_att9 ?>" disabled required onclick="controllo9()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att9 . " - " . $titolo9 ?></div>
							</div>
						</label><br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz9 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="9" value="<?php echo $id_att9 ?>" required onclick="controllo9()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att9 . " - " . $titolo9 ?></div>
							</div>
						</label><br>
				<?php
																}
															}

															mysqli_free_result($resultC9);
															mysqli_free_result($result9);
															mysqli_free_result($resultColor); ?>
				<br>

				<input class="btn btn-outline-primary" value="Avanti" name="invia" type="submit">
			</form>
		</div>
		<script type="text/javascript" language="javascript">
			function controllo7() {
				var radios7 = $('input[name=7]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok7").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=7&id=" + radios7, true);
				xhttp.send();

				// Operazioni da eseguire se l'attività occupa tutta la mattinata
				var class_doppia = $('input[name=7]:checked').attr('class');
				$('input[name=8][class="attivita_doppia_copia"]').remove();
				if (class_doppia == "attivita_doppia") {
					$('input[name=8]:checked').prop('checked', false);
					$('input[name=8]').attr('disabled', true);
					$("input[name=8]").parent().parent().parent().addClass("radio_disabled_parent");
					new_selected_input = '<input type="radio" checked="checked" class="attivita_doppia_copia" name="8" value="' + radios7 + '" style="display: none;">';
					$("#ok8").after(new_selected_input);
					document.getElementById("ok8").innerHTML = "";
				} else {
					$('.radio_disabled_parent input').attr('disabled', false);
					$("input[name=8]").parent().parent().parent().removeClass("radio_disabled_parent");
					$('input[name=8][class="attivita_doppia_copia"]:checked').prop('checked', false);
				}

				// Gestione sport soft
				var sport = $('input[name=7]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=7]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}
					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=8][data-sport="Soft"], input[name=9][data-sport="Soft"]').attr('disabled', true);
					$('input[name=8][data-sport="Soft"], input[name=9][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=8][data-sport="Soft"]:checked').length > 0) {
						$('input[name=8][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=9][data-sport="Soft"]:checked').length > 0) {
						$('input[name=9][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
					$('#avviso-sport-soft').remove();

					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=8][data-sport="Soft"]:checked, input[name=9][data-sport="Soft"]:checked').length == 0) {
						$('input[name=8][data-sport="Soft"], input[name=9][data-sport="Soft"]').attr('disabled', false);
						$('input[name=8][data-sport="Soft"], input[name=9][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}

			function controllo8() {
				var radios8 = $('input[name=8]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok8").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=8&id=" + radios8, true);
				xhttp.send();

				// Gestione sport soft
				var sport = $('input[name=8]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=8]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}
					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=7][data-sport="Soft"], input[name=9][data-sport="Soft"]').attr('disabled', true);
					$('input[name=7][data-sport="Soft"], input[name=9][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=7][data-sport="Soft"]:checked').length > 0) {
						$('input[name=7][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=9][data-sport="Soft"]:checked').length > 0) {
						$('input[name=9][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
        			$('#avviso-sport-soft').remove();

					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=7][data-sport="Soft"]:checked, input[name=9][data-sport="Soft"]:checked').length == 0) {
						$('input[name=7][data-sport="Soft"], input[name=9][data-sport="Soft"]').attr('disabled', false);
						$('input[name=7][data-sport="Soft"], input[name=9][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}

			function controllo9() {
				var radios9 = $('input[name=9]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok9").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=9&id=" + radios9, true);
				xhttp.send();

				// Gestione sport soft
				var sport = $('input[name=9]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=8]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}

					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=7][data-sport="Soft"], input[name=5][data-sport="Soft"]').attr('disabled', true);
					$('input[name=7][data-sport="Soft"], input[name=5][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=7][data-sport="Soft"]:checked').length > 0) {
						$('input[name=7][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=8][data-sport="Soft"]:checked').length > 0) {
						$('input[name=8][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
        			$('#avviso-sport-soft').remove();
					
					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=7][data-sport="Soft"]:checked, input[name=8][data-sport="Soft"]:checked').length == 0) {
						$('input[name=7][data-sport="Soft"], input[name=8][data-sport="Soft"]').attr('disabled', false);
						$('input[name=7][data-sport="Soft"], input[name=8][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}
		</script><?php
						}
					} else if ($_SESSION['comm'] == 1) {
						echo "<div class='jumbotron text-center jumbotron-fluid'>Iscrizione autogestite LiBe</div> Per i membri della commissione non è necessario iscriversi.";
					}
							?>