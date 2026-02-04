<?php
if (!isset($_SESSION['username'])){
	header ("Location: login.php?location=profilo");
}

if (isset($_GET['status'])) {
	if ($_GET['status'] == 1) {
		echo "<div class='alert alert-success alert-dismissible alert-floating'><button type='button' class='close' data-dismiss='alert'>&times;</button>Iscrizione completata con successo! Qui sotto vedi le tue scelte.</div>";
	} else if ($_GET['status'] == 2) {
		echo "<div class='alert alert-warning alert-dismissible alert-floating'><button type='button' class='close' data-dismiss='alert'>&times;</button>Ti sei già iscritto! Qui sotto vedi le tue scelte.</div>";
	}
}

/////////////////////////////////// TUTTI - NUMERO PROPOSTE //////////////////////////////////////////?>

<div class='jumbotron text-center jumbotron-fluid non-printable'><span id='scritto'>Il tuo profilo</span></div>
<div class="page_text" style="display: -ms-flexbox;display: flex;-ms-flex-wrap: wrap;flex-wrap: wrap;">

	<div class="col-md-6"><?php

	$expgiorno1 = explode(" ", $_SESSION['giorni'][1]);
	$expgiorno2 = explode(" ", $_SESSION['giorni'][2]);
	$expgiorno3 = explode(" ", $_SESSION['giorni'][3]);
	$expgiorno4 = explode(" ", $_SESSION['giorni'][4]);
	$expgiorno5 = explode(" ", $_SESSION['giorni'][5]);
	$expgiorno6 = explode(" ", $_SESSION['giorni'][6]);
	$expgiorno7 = explode(" ", $_SESSION['giorni'][7]);
	$expgiorno8 = explode(" ", $_SESSION['giorni'][8]);
	$expgiorno9 = explode(" ", $_SESSION['giorni'][9]);

	/*

	$conta = "SELECT COUNT(id_att) AS utente FROM proposte WHERE id_utente=" . $_SESSION['id'];
	$contaTot = "SELECT COUNT(id_att) AS totale FROM proposte WHERE id_att > 0 AND accettata=1";

	$resultconta = $conn->query($conta);
	$resultcontaTot = $conn->query($contaTot);

	while ($rowcontaTot = $resultcontaTot->fetch_assoc()) {
		while ($rowconta = $resultconta->fetch_assoc()) {
			if ($rowconta['utente'] == 1) {
				echo "Hai fatto 1 proposta su " . $rowcontaTot['totale'] . ".<br><br>";
			} else {
				echo "Hai fatto " . $rowconta['utente'] . " proposte su " . $rowcontaTot['totale'] . ".<br><br>";
			}
		}
	}

	mysqli_free_result($resultconta);
	mysqli_free_result($resultcontaTot);
	*/

	?><!--chiude non-printable-->
		<?php


	/////////////////////////// STUDENTE - VEDI SCELTE e ASSENZE /////////////////////////////////
		if ($_SESSION['comm'] == 0 || $_SESSION['admin'] == 1) {

			for ($i = 1; $i < 10; $i++) {

				$query = "SELECT id_att, aula, timestamp, titolo FROM scelte s, proposte p WHERE s.id_utente = '" . $_SESSION['id'] . "' AND p.id_att=s.att" . $i;
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


			<h3>Attività</h3>
			<br>
			<table class="table table-striped">
				<tr>
					<td><?php echo $expgiorno1[0] . " " . $expgiorno1[1] . " " . $expgiorno1[2] . "<br>" . $expgiorno1[3] . "<br>" . $expgiorno1[4]; ?></td>
					<td><?php echo "ID attività: " . $att[1] . "<br>" . $aula[1] . "<br>" . $titolo[1]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno2[0] . " " . $expgiorno2[1] . " " . $expgiorno2[2] . "<br>" . $expgiorno2[3] . "<br>" . $expgiorno2[4]; ?></td>
					<td><?php echo "ID attività: " . $att[2] . "<br>" . $aula[2] . "<br>" . $titolo[2]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno3[0] . " " . $expgiorno3[1] . " " . $expgiorno3[2] . "<br>" . $expgiorno3[3]; ?></td>
					<td><?php echo "ID attività: " . $att[3] . "<br>" . $aula[3] . "<br>" . $titolo[3]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno4[0] . " " . $expgiorno4[1] . " " . $expgiorno4[2] . "<br>" . $expgiorno4[3] . "<br>" . $expgiorno4[4]; ?></td>
					<td><?php echo "ID attività: " . $att[4] . "<br>" . $aula[4] . "<br>" . $titolo[4]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno5[0] . " " . $expgiorno5[1] . " " . $expgiorno5[2] . "<br>" . $expgiorno5[3] . "<br>" . $expgiorno5[4]; ?></td>
					<td><?php echo "ID attività: " . $att[5] . "<br>" . $aula[5] . "<br>" . $titolo[5]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno6[0] . " " . $expgiorno6[1] . " " . $expgiorno6[2] . "<br>" . $expgiorno6[3]; ?></td>
					<td><?php echo "ID attività: " . $att[6] . "<br>" . $aula[6] . "<br>" . $titolo[6]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno7[0] . " " . $expgiorno7[1] . " " . $expgiorno7[2] . "<br>" . $expgiorno7[3] . "<br>" . $expgiorno7[4]; ?></td>
					<td><?php echo "ID attività: " . $att[7] . "<br>" . $aula[7] . "<br>" . $titolo[7]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno8[0] . " " . $expgiorno8[1] . " " . $expgiorno8[2] . "<br>" . $expgiorno8[3] . "<br>" . $expgiorno8[4]; ?></td>
					<td><?php echo "ID attività: " . $att[8] . "<br>" . $aula[8] . "<br>" . $titolo[8]; ?></td>
				</tr>
				<tr>
					<td><?php echo $expgiorno9[0] . " " . $expgiorno9[1] . " " . $expgiorno9[2] . "<br>" . $expgiorno9[3]; ?></td>
					<td><?php echo "ID attività: " . $att[9] . "<br>" . $aula[9] . "<br>" . $titolo[9]; ?></td>
				</tr>
				<tr>
					<td>Ultima modifica</td>
					<td><?php echo $timestamp;?></td>
				</tr>
			</table><br>

			<div class="non-printable">
				<a class="button" onclick="window.print();">Stampa attività</a><br><br>
			</div>
		</div>
		<div class="col-md-6 non-printable">

			<h3>Profilo</h3>
			<br>
			<table class="table table-striped">
				<tr>
					<td>ID allievo</td>
					<td><?php echo $_SESSION['id']; ?></td>
				</tr>
				<tr>
					<td>Nome</td>
					<td><?php echo $_SESSION['nome']; ?></td>
				</tr>
				<tr>
					<td>Cognome</td>
					<td><?php echo $_SESSION['cognome']; ?></td>
				</tr>
				<tr>
					<td>Classe</td>
					<td><?php echo $_SESSION['classe']; ?></td>
				</tr>
			</table><br>


			<h3>Assenze</h3>
			<br><?php

			$queryAss = "SELECT * FROM assenze WHERE id_utente=" . $_SESSION['id'];
			$resultAss = $conn->query($queryAss);

			while($rowAss = $resultAss->fetch_assoc()){

				for ($i = 1; $i < 10; $i++) {
					if ($rowAss['assenza' . $i] == 1) {
						${'ass' . $i} = "No";
					} else if ($rowAss['assenza' . $i] == 2) {
						${'ass' . $i} = "Si";
					} else if ($rowAss['assenza' . $i] == "") {
						${'ass' . $i} = "";
					} else {
						${'ass' . $i} = "Sconosciuto";
					}
				}
			}

			mysqli_free_result($resultAss); ?>

			<table class="table table-striped">
    		<thead class="thead-light">
					<tr>
						<th>Giorno</th>
						<th>ID attività</th>
						<th>Presente?</th>
					</tr>
				</thead>
		    <tbody>
					<tr>
						<td><?php echo $expgiorno1[0] . " " . $expgiorno1[1] . " " . $expgiorno1[2] . "<br>" . $expgiorno1[3]; ?></td>
						<td><?php echo $att[1]; ?></td>
						<td><?php echo $ass1; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno2[0] . " " . $expgiorno2[1] . " " . $expgiorno2[2] . "<br>" . $expgiorno2[3]; ?></td>
						<td><?php echo $att[2]; ?></td>
						<td><?php echo $ass2; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno3[0] . " " . $expgiorno3[1] . " " . $expgiorno3[2] . "<br>" . $expgiorno3[3]; ?></td>
						<td><?php echo $att[3]; ?></td>
						<td><?php echo $ass3; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno4[0] . " " . $expgiorno4[1] . " " . $expgiorno4[2] . "<br>" . $expgiorno4[3]; ?></td>
						<td><?php echo $att[4]; ?></td>
						<td><?php echo $ass4; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno5[0] . " " . $expgiorno5[1] . " " . $expgiorno5[2] . "<br>" . $expgiorno5[3]; ?></td>
						<td><?php echo $att[5]; ?></td>
						<td><?php echo $ass5; ?></td>
					</tr>
					<tr>
						<td><?php echo $expgiorno6[0] . " " . $expgiorno6[1] . " " . $expgiorno6[2] . "<br>" . $expgiorno6[3]; ?></td>
						<td><?php echo $att[6]; ?></td>
						<td><?php echo $ass6; ?></td>
					</tr>
					<tr>
					  <td><?php echo $expgiorno7[0] . " " . $expgiorno7[1] . " " . $expgiorno7[2] . "<br>" . $expgiorno7[3]; ?></td>
					  <td><?php echo $att[7]; ?></td>
					  <td><?php echo $ass7; ?></td>
					</tr>
					<tr>
					  <td><?php echo $expgiorno8[0] . " " . $expgiorno8[1] . " " . $expgiorno8[2] . "<br>" . $expgiorno8[3]; ?></td>
					  <td><?php echo $att[8]; ?></td>
					  <td><?php echo $ass8; ?></td>
					</tr>
					<tr>
					  <td><?php echo $expgiorno9[0] . " " . $expgiorno9[1] . " " . $expgiorno9[2] . "<br>" . $expgiorno9[3]; ?></td>
					  <td><?php echo $att[9]; ?></td>
					  <td><?php echo $ass9; ?></td>
					</tr>
				</tbody>
			</table><br><br>
			</div><?php
	} else {
		echo "Sei stato iscritto in commissione e quindi non devi iscriverti alle attività ma aiutare a organizzare le giornate.";
	} ?>

	</div><!--chiude non-printable-->
</div>
