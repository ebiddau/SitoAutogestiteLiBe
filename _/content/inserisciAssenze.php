<?php
if (!isset($_SESSION['username'])){
	header ("Location: login.php?location=inserisciAssenze");
}

if ($_SESSION['comm'] == 1 || $_SESSION['admin'] == 1) { ?>

	<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Inserisci assenze</span></div>
	<div class="page_text"><?php

	if (!isset($_POST['seleziona']) && !$assenza_loggato) { ?>
		<p>Inserisci l'ID dell'attività</p><br>
		<form method="POST" action="index.php?page=inserisciAssenze">

			ID attività:<br>
			<input type="number" name="id" required class="form-control mb-2"><br><br>

			<input type="submit" name="seleziona" value="Seleziona attività" class="btn btn-primary">
		</form><?php

	} else {

		$id_att = $_POST['id'];

		$queryC1 = "SELECT giorno, titolo FROM proposte WHERE id_att=" . $id_att;
		$resultC1 = $conn->query($queryC1);
		$obj = $resultC1->fetch_object();
		$giorno = $obj->giorno;
		$titolo = $obj->titolo;


		$queryIscritti = "SELECT s.id_utente, u.nome, u.cognome, u.classe, a.assenza" . $giorno . " FROM assenze a, scelte s, utenti u WHERE s.att" . $giorno . "='" . $id_att . "' AND s.id_utente = u.id_utente AND u.id_utente = a.id_utente ORDER BY classe";
		$resultIscritti = $conn->query($queryIscritti);

		?>
		<form method="POST" class="form-inline" action="index.php?page=inserisciAssenze">
			<div class="form-group mx-sm-3 mb-2">
				<label class="mr-sm-2" for="id">ID attività:</label>
				<input type="number" name="id" required value="<?php echo $id_att; ?>" class="form-control">
			</div>

			<input type="submit" name="seleziona" value="Seleziona attività" class="btn btn-primary mb-2">
		</form>
		<br><hr><br><br>

		<h3>Attività</h3>
		<br>
		<table class="table table-striped">
			<tr>
				<td>Data</td>
				<td><?php echo $_SESSION['giorni'][$giorno]; ?></td>
			</tr>
			<tr>
				<td>ID</td>
				<td><?php echo $id_att; ?></td>
			</tr>
			<tr>
				<td>Titolo</td>
				<td><?php echo $titolo; ?></td>
			</tr>
		</table><br><br>

		<h3>Inserisci assenze</h3>
		<br>
		<table class="table table-striped" id="assenze">
			<thead class="thead-light">
				<tr>
					<th>Classe</th>
					<th>ID utente</th>
					<th>Nome</th>
					<th>Pres.</th>
					<th>Ass.</th>
					<th>OK?</th>
				</tr>
			</thead>
			<tbody>
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th><button type="button" onclick="checkedAllPres();">Tutti presenti</button></th>
			<th><button type="button" onclick="checkedAllAss();">Tutti assenti</button></th>
			<th></th>
		</tr>
		<?php

		while($rowIscritti = $resultIscritti->fetch_array()) {
			$id_utente = $rowIscritti['id_utente'];
			$nome = $rowIscritti['nome'];
			$cognome = $rowIscritti['cognome'];
			$classe = $rowIscritti['classe'];
			$gneh = "assenza" . $giorno;
			$ass = $rowIscritti[$gneh];
			if ($ass == 2) { ?>
				<tr>
					<td><?php echo $classe; ?></td>
					<td><?php echo $id_utente; ?></td>
					<td><?php echo $nome . " " . $cognome; ?></td>
					<td><input class="set_presente" type='radio' name='<?php echo $id_utente; ?>' value='2' onclick='aggiorna(<?php echo $id_utente ?>)' checked></td>
					<td><input class="set_assente" type='radio' name='<?php echo $id_utente; ?>' value='1' onclick='aggiorna(<?php echo $id_utente ?>)'></td>
					<td><span id='<?php echo $id_utente; ?>'></span></td>
				</tr>
				<?php
			} else if ($ass == 1) { ?>
				<tr>
					<td><?php echo $classe; ?></td>
					<td><?php echo $id_utente; ?></td>
					<td><?php echo $nome . " " . $cognome; ?></td>
					<td><input class="set_presente" type='radio' name='<?php echo $id_utente; ?>' value='2' onclick='aggiorna(<?php echo $id_utente ?>)'></td>
					<td><input class="set_assente" type='radio' name='<?php echo $id_utente; ?>' value='1' onclick='aggiorna(<?php echo $id_utente ?>)' checked></td>
					<td><span id='<?php echo $id_utente; ?>'></span></td>
				</tr>
				<?php
			} else { ?>
				<tr>
					<td><?php echo $classe; ?></td>
					<td><?php echo $id_utente; ?></td>
					<td><?php echo $nome . " " . $cognome; ?></td>
					<td><input class="set_presente" type='radio' name='<?php echo $id_utente; ?>' value='2' onclick='aggiorna(<?php echo $id_utente ?>)'></td>
					<td><input class="set_assente" type='radio' name='<?php echo $id_utente; ?>' value='1' onclick='aggiorna(<?php echo $id_utente ?>)'></td>
					<td><span id='<?php echo $id_utente; ?>'></span></td>
				</tr>
				<?php
			}
		}
		?>
			</tbody>
		</table><br><br>
		<!--
		<?php

		mysqli_free_result($resultIscritti);

		if (isset($_POST['invia'])) {

			$queryUpdate = "UPDATE scelte SET att" . $giorno . "=" . $id_att . " WHERE id_utente=" . $_POST['id_utente'];
			echo $queryUpdate;

		} else { ?>
			<fieldset><legend>Aggiungi presenti</legend>
				ID allievo: <input type="number" id="id_utente"><br><br>

				------------ OPPURE ------------<br><br>

				Nome: <input type="text" id="nome"><br><br>

				Cognome: <input type="text" id="cognome"><br><br>

				Classe:<?php
				$queryClassi = "SELECT classe FROM utenti WHERE classe != 'Docente' GROUP BY classe";
				$resultClassi = $conn->query($queryClassi); ?>

				<select id="classe">
					<option value="">Scegli la classe</option><?php
					while($row = $resultClassi->fetch_assoc()) {
						$classe = $row['classe'];?>
						<option value="<?php echo $classe;?>"><?php echo $classe; ?></option><?php
					} ?>
				</select><br><br>

				<button onclick="aggiungi()">Inserisci</button><span id="ok2"></span>
			</fieldset><?php
		} ?>
	-->
	</div>
	<script>

	function checkedAllPres () {
	    var aa =  document.getElementsByClassName("set_presente");
	    for (var i =0; i < aa.length; i++) {
	        aa[i].click();
	    }
	 }
	 function checkedAllAss () {
 	    var aa =  document.getElementsByClassName("set_assente");
 	    for (var i =0; i < aa.length; i++) {
 	        aa[i].click();
 	    }
 	 }


	function aggiorna(id) {
		var ass = $('input[name=' + id + ']:checked').val();
		var g = " <?php echo $giorno ?> ";
		var xhttp = new XMLHttpRequest();
		var id_att = " <?php echo $id_att ?> ";
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById(id).innerHTML = this.responseText;
				setTimeout(function () {
					document.getElementById(id).innerHTML = "";
				}, 4000);
			}
		};
		xhttp.open("GET", "actions/aggAssenze.php?id=" + id + "&ass=" + ass + "&g=" + g + "&id_att=" + id_att, true);
		xhttp.send();
	}

	function aggiungi() {
		var att = "<?php echo $id_att ?>";
		var g = "<?php echo $giorno ?>";
		var id = document.getElementById("id_utente").value;
		var nome = document.getElementById("nome").value;
		var cognome = document.getElementById("cognome").value;
		var classe = document.getElementById("classe").value;
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {

				if (this.responseText == " <img src='img/accept.png'> Ok") {
					document.getElementById("id_utente").value = "";
					document.getElementById("nome").value = "";
					document.getElementById("cognome").value = "";
					document.getElementById("classe").value = "";
					document.getElementById("ok2").innerHTML = this.responseText + ". Attendi...";

					setTimeout(function () {
						document.getElementById("ok2").innerHTML = "";
						location.reload(true);
					}, 4000);
				} else {
					document.getElementById("ok2").innerHTML = this.responseText;
				}

			}
		};

		if (id == "") {
			xhttp.open("GET", "actions/addPersone.php?nome=" + nome + "&cognome=" + cognome + "&classe=" + classe + "&att=" + att + "&g=" + g, true);
		} else {
			xhttp.open("GET", "actions/addPersone.php?id=" + id + "&att=" + att + "&g=" + g, true);
		}

		xhttp.send();
	}
	</script><?php
}

} else if ($_SESSION['assenze'] == 0) {
	echo "<div class='jumbotron text-center jumbotron-fluid'>Inserisci assenze</div>Al momento non è possibile inserire le assenze. " . $_SESSION['motivo-assenze'];
}
