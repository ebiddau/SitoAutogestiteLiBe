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
	} else if ($attC4 != 0 && $attC5 != 0 && $attC6 != 0) {
		header("Location: index.php?page=giornata3");
	} else {

		$limCaffe = 180;
		$limMulti = 100;
		$limGen = 30;	?>

		<div class='jumbotron text-center jumbotron-fluid'>Iscrizione autogestite - seconda giornata</div>
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

			<form method="POST" action="index.php?page=salvaScelte&g=2">

				<h1>Scegli per <?php echo $_SESSION['giorni'][4]; ?></h1>
				<span id='ok4'></span><?php

															$queryC4 = "SELECT titolo, id_att, max_iscritti, descrizione, attivita_doppia, sport FROM proposte WHERE giorno=4 AND accettata=1";
															$resultC4 = $conn->query($queryC4);

															while ($row4 = $resultC4->fetch_array()) {
																$id_att4 = $row4['id_att'];
																$titolo4 = $row4['titolo'];
																$descriz4 = $row4['descrizione'];
																$max_iscritti4 = $row4['max_iscritti'];
																$attivita_doppia = $row4['attivita_doppia'];

																$query4 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att4=p.id_att AND p.giorno=4 AND p.id_att=" . $id_att4;
																$result4 = $conn->query($query4);
																$conteggio4 = $result4->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att4;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio4 >= $max_iscritti4) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz4 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="4" value="<?php echo $id_att4 ?>" disabled required onclick="controllo4()" <?php if ($attivita_doppia == 1) { ?> class="attivita_doppia" <?php } ?> <?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att4 . " - " . $titolo4 ?></div>
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
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz4 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="4" value="<?php echo $id_att4 ?>" required onclick="controllo4()" <?php if ($attivita_doppia == 1) { ?> class="attivita_doppia" <?php } ?> <?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att4 . " - " . $titolo4 ?></div>
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

															mysqli_free_result($resultC4);
															mysqli_free_result($result4);
															mysqli_free_result($resultColor); ?>
				<br>


				<h1>Scegli per <?php echo $_SESSION['giorni'][5]; ?></h1>
				<span id='ok5'></span><?php

															$queryC5 = "SELECT titolo, id_att, max_iscritti, descrizione, sport FROM proposte WHERE giorno=5 AND accettata=1";
															$resultC5 = $conn->query($queryC5);

															while ($row5 = $resultC5->fetch_array()) {
																$id_att5 = $row5['id_att'];
																$titolo5 = $row5['titolo'];
																$descriz5 = $row5['descrizione'];
																$max_iscritti5 = $row5['max_iscritti'];

																$query5 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att5=p.id_att AND p.giorno=5 AND p.id_att=" . $id_att5;
																$result5 = $conn->query($query5);
																$conteggio5 = $result5->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att5;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio5 >= $max_iscritti5) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz5 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="5" value="<?php echo $id_att5 ?>" disabled required onclick="controllo5()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att5 . " - " . $titolo5 ?></div>
							</div>
						</label><br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz5 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="5" value="<?php echo $id_att5 ?>" required onclick="controllo5()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att5 . " - " . $titolo5 ?></div>
							</div>
						</label><br>
				<?php
																}
															}

															mysqli_free_result($resultC5);
															mysqli_free_result($result5);
															mysqli_free_result($resultColor); ?>
				<br>


				<h1>Scegli per <?php echo $_SESSION['giorni'][6]; ?></h1>
				<span id='ok6'></span><?php

															$queryC6 = "SELECT titolo, id_att, max_iscritti, descrizione, sport FROM proposte WHERE giorno=6 AND accettata=1";
															$resultC6 = $conn->query($queryC6);

															while ($row6 = $resultC6->fetch_array()) {
																$id_att6 = $row6['id_att'];
																$titolo6 = $row6['titolo'];
																$descriz6 = $row6['descrizione'];
																$max_iscritti6 = $row6['max_iscritti'];

																$query6 = "SELECT count(*) as conteggio FROM scelte s, proposte p WHERE accettata=1 AND s.att6=p.id_att AND p.giorno=6 AND p.id_att=" . $id_att6;
																$result6 = $conn->query($query6);
																$conteggio6 = $result6->fetch_object()->conteggio;

																$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.id_percorso= p.percorso AND p.id_att=" . $id_att6;
																$resultColor = $conn->query($queryColor);

																while ($rowColor = $resultColor->fetch_assoc()) {
																	$colore = $rowColor['colore'];
																	$nomep = $rowColor['nome'];
																}

																if ($conteggio6 >= $max_iscritti6) {
															?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz6 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background: #f2f2f2;">
										<input type="radio" name="6" value="<?php echo $id_att6 ?>" disabled required onclick="controllo6()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control" style="color: #bfbfbf;"><?php echo $id_att6 . " - " . $titolo6 ?></div>
							</div>
						</label><br>
					<?php
																} else {
					?>
						<label class="label_hidden" title="<?php echo $nomep ?>"></label><label title="<?php echo $descriz6 ?>">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text" style="background-image: url('img/colori/<?php echo $colore ?>.png')">
										<input type="radio" name="6" value="<?php echo $id_att6 ?>" required onclick="controllo6()"
										<?php if ($row1['sport'] == 'Soft') { ?> data-sport="Soft" <?php } ?>>
									</div>
								</div>
								<div class="form-control"><?php echo $id_att6 . " - " . $titolo6 ?></div>
							</div>
						</label><br>
				<?php
																}
															}

															mysqli_free_result($resultC6);
															mysqli_free_result($result6);
															mysqli_free_result($resultColor); ?>
				<br>

				<input class="btn btn-outline-primary" value="Avanti" name="invia" type="submit">
			</form>
		</div>
		<script type="text/javascript" language="javascript">
			function controllo4() {
				var radios4 = $('input[name=4]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok4").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=4&id=" + radios4, true);
				xhttp.send();

				// Operazioni da eseguire se l'attività occupa tutta la mattinata
				var class_doppia = $('input[name=4]:checked').attr('class');
				$('input[name=5][class="attivita_doppia_copia"]').remove();
				if (class_doppia == "attivita_doppia") {
					$('input[name=5]:checked').prop('checked', false);
					$('input[name=5]').attr('disabled', true);
					$("input[name=5]").parent().parent().parent().addClass("radio_disabled_parent");
					new_selected_input = '<input type="radio" checked="checked" class="attivita_doppia_copia" name="5" value="' + radios4 + '" style="display: none;">';
					$("#ok5").after(new_selected_input);
					document.getElementById("ok5").innerHTML = "";
				} else {
					$('.radio_disabled_parent input').attr('disabled', false);
					$("input[name=5]").parent().parent().parent().removeClass("radio_disabled_parent");
					$('input[name=5][class="attivita_doppia_copia"]:checked').prop('checked', false);
				}

				// Gestione sport soft
				var sport = $('input[name=4]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=4]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}
					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=5][data-sport="Soft"], input[name=6][data-sport="Soft"]').attr('disabled', true);
					$('input[name=5][data-sport="Soft"], input[name=6][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=5][data-sport="Soft"]:checked').length > 0) {
						$('input[name=5][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=6][data-sport="Soft"]:checked').length > 0) {
						$('input[name=6][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
					$('#avviso-sport-soft').remove();

					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=5][data-sport="Soft"]:checked, input[name=6][data-sport="Soft"]:checked').length == 0) {
						$('input[name=5][data-sport="Soft"], input[name=6][data-sport="Soft"]').attr('disabled', false);
						$('input[name=5][data-sport="Soft"], input[name=6][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}

			function controllo5() {
				var radios5 = $('input[name=5]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok5").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=5&id=" + radios5, true);
				xhttp.send();

				// Gestione sport soft
				var sport = $('input[name=5]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=5]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}
					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=4][data-sport="Soft"], input[name=6][data-sport="Soft"]').attr('disabled', true);
					$('input[name=4][data-sport="Soft"], input[name=6][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=4][data-sport="Soft"]:checked').length > 0) {
						$('input[name=4][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=6][data-sport="Soft"]:checked').length > 0) {
						$('input[name=6][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
        			$('#avviso-sport-soft').remove();

					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=4][data-sport="Soft"]:checked, input[name=6][data-sport="Soft"]:checked').length == 0) {
						$('input[name=4][data-sport="Soft"], input[name=6][data-sport="Soft"]').attr('disabled', false);
						$('input[name=4][data-sport="Soft"], input[name=6][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}

			function controllo6() {
				var radios6 = $('input[name=6]:checked').val();
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
					if (xhttp.readyState == 4 && xhttp.status == 200) {
						document.getElementById("ok6").innerHTML = this.responseText + "<br><br>";
					}
				};
				xhttp.open("GET", "actions/controllo.php?g=6&id=" + radios6, true);
				xhttp.send();

				// Gestione sport soft
				var sport = $('input[name=6]:checked').attr('data-sport');
				if (sport == 'Soft') {
					// Aggiungi il messaggio di avviso dopo il radio button
					if ($('#avviso-sport-soft').length === 0) {
						$('input[name=5]:checked').closest('label').after(
							'<div id="avviso-sport-soft" class="alert alert-warning" style="margin-bottom: 0;">' +
							'<strong>🏃 Attenzione!</strong> Hai selezionato un\'attività sportiva "soft". ' +
							'Non potrai selezionare altre attività sportive "soft" nelle altre fasce orarie.' +
							'</div>'
						);
					}

					// Disabilita tutte le altre attività soft nelle altre fasce orarie
					$('input[name=4][data-sport="Soft"], input[name=5][data-sport="Soft"]').attr('disabled', true);
					$('input[name=4][data-sport="Soft"], input[name=5][data-sport="Soft"]').parent().parent().parent().addClass("radio_disabled_parent");
					
					// Se c'è un'attività soft già selezionata, deselezionala
					if ($('input[name=4][data-sport="Soft"]:checked').length > 0) {
						$('input[name=4][data-sport="Soft"]:checked').prop('checked', false);
					}
					if ($('input[name=5][data-sport="Soft"]:checked').length > 0) {
						$('input[name=5][data-sport="Soft"]:checked').prop('checked', false);
					}
				} else {
					// Rimuovi il messaggio di avviso se esiste
        			$('#avviso-sport-soft').remove();
					
					// Riabilita le attività soft se non c'è un'altra attività soft selezionata
					if ($('input[name=4][data-sport="Soft"]:checked, input[name=5][data-sport="Soft"]:checked').length == 0) {
						$('input[name=4][data-sport="Soft"], input[name=5][data-sport="Soft"]').attr('disabled', false);
						$('input[name=4][data-sport="Soft"], input[name=5][data-sport="Soft"]').parent().parent().parent().removeClass("radio_disabled_parent");
					}
				}
			}
		</script><?php
						}
					} else if ($_SESSION['comm'] == 1) {
						echo "<div class='jumbotron text-center jumbotron-fluid'>Iscrizione autogestite LiBe</div> Per i membri della commissione non è necessario iscriversi.";
					}
							?>