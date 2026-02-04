<?php
if ($_SESSION['comm'] != 1 && $_SESSION['aiuto'] != 1){
	header ("Location: login.php?level=comm&location=listaProposte");
} ?>
<div class='jumbotron text-center jumbotron-fluid'>Lista proposte</div>
<div class="page_text">

<?php
	if (!isset($_POST['seleziona']) && !$assenza_loggato) { ?>
		<p>Inserisci l'ID dell'attività</p><br>
		<form method="POST" action="index.php?page=listaProposte">

			ID attività:<br>
			<input type="number" name="id" required class="form-control mb-2"><br><br>

			<input type="submit" name="seleziona" value="Seleziona attività" class="btn btn-primary">
		</form>

		<b>Istruzioni per l'utilizzo</b><br>
		Se dovete scartare/eliminare una proposta, usate la pagina <a href="index.php?page=accettaProposte">Accetta proposte</a> ma non cancellate il contenuto della proposta!<br>
		Percorsi culturali: inserite il nome corretto (es. Informatica), la lista è disponibile alla pagina <a href="index.php?page=modificaPercorsi">Modifica percorsi</a>.<br>
		Attenzione: ogni bottone "aggiorna" aggiorna solo i dati della rispettiva proposta!<br>
		Se vi rendete conto di aver fatto una ****ata, scrivete <b>subito</b> a <a href="<?php echo $_SESSION['webmaster']; ?>"><?php echo $_SESSION['webmaster']; ?></a><br><br>
		<h3>Scegli cosa visualizzare</h3>

<?php

	} else {

	$id_att = $_POST['id'];

	if (!isset($_POST['invia'])) {
		$_POST['funz'] = array("desc", "niscr", "perc", "relat", "altro", "prop");
	}

	if ($_POST['funz'] == "") {
		$_POST['funz'] = array();
	}?>
	<form method="POST" action="index.php?page=listaProposte">
		<labe><input type="radio" name="lista" value="iscritti" id="iscritti"> Visualizza l'attività nr. <input type="number" style="width:50px;" name="id_att" min="1" onfocus="selezionaIscritti()"></label>
		<label><input type="checkbox" name="funz[]" value="desc" <?php if(in_array('desc', $_POST['funz'])) echo "checked"; ?>> Descrizione e referenze</label>
		<label><input type="checkbox" name="funz[]" value="niscr" <?php if(in_array('niscr', $_POST['funz'])) echo "checked"; ?>> Numero iscritti e limiti</label>
		<label><input type="checkbox" name="funz[]" value="perc" <?php if(in_array('perc', $_POST['funz'])) echo "checked"; ?>> Percorso</label>
		<label><input type="checkbox" name="funz[]" value="relat" <?php if(in_array('relat', $_POST['funz'])) echo "checked"; ?>> Relatori</label>
		<label><input type="checkbox" name="funz[]" value="altro" <?php if(in_array('altro', $_POST['funz'])) echo "checked"; ?>> Altre info</label>
		<label><input type="checkbox" name="funz[]" value="prop" <?php if(in_array('prop', $_POST['funz'])) echo "checked"; ?>> Proponente</label>
		<input type="submit" name="invia" value="Aggiorna">
	</form><br><?php

	$query = "SELECT * FROM proposte pr, percorsi pe WHERE pr.id_att = $_POST[id]";
	$result = $conn->query($query);

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$id_att = $row["id_att"];

			$query2 = "SELECT count(*) AS num_iscritti FROM scelte WHERE att1=" . $id_att . " OR att2=" . $id_att . " OR att3=" . $id_att . " OR att4=" . $id_att . " OR att5=" . $id_att . " OR att6=" . $id_att . " OR att7=" . $id_att . " OR att8=" . $id_att . " OR att9=" . $id_att;
			$result2 = $conn->query($query2);

			$num_iscritti = $result2->fetch_object()->num_iscritti;

			echo "ID att - Giorno - Titolo<br>

				<textarea cols='5' id='id" . $id_att . "' readonly>" . $id_att . "</textarea>
				<textarea cols='5' id='giorno" . $id_att . "' placeholder='Giorno'>" . $row["giorno"] . "</textarea>
				<textarea style='width:585px;' id='titolo" . $id_att . "' placeholder='Titolo'>" . $row["titolo"] . "</textarea><br><br>";

			if (in_array('desc', $_POST['funz'])) {
				echo "Descrizione - Referenze<br>
				<textarea class='large' id='descrizione" . $id_att . "' placeholder='Descrizione'>" . $row["descrizione"] . "</textarea>
				<textarea class='large' id='referenze" . $id_att . "' placeholder='Referenze'>" . $row["referenze"] . "</textarea><br><br>";
			}

			if (in_array('niscr', $_POST['funz'])) {
				echo "Min - Iscritti - Max<br>
				<textarea cols='5' id='min_iscritti" . $id_att . "' placeholder='Min iscritti'>" . $row["min_iscritti"] . "</textarea>
				<textarea cols='5' id='num_iscritti" . $id_att . "' readonly>" . $num_iscritti . "</textarea>
				<textarea cols='5' id='max_iscritti" . $id_att . "' placeholder='Max iscritti'>" . $row["max_iscritti"] . "</textarea><br><br>";
			}

			if (in_array('perc', $_POST['funz'])) {
				echo "Percorso<br>
				<textarea id='percorso" . $id_att . "' placeholder='Percorso'>" . $row["nome"] . "</textarea><br><br>";
			}

			if (in_array('relat', $_POST['funz'])) {
				echo "Relatori<br>
				<textarea id='relatore1" . $id_att . "' placeholder='Relatore 1'>" . $row["relatore1"] . "</textarea>
				<textarea id='relatore2" . $id_att . "' placeholder='Relatore 2'>" . $row["relatore2"] . "</textarea>
				<textarea id='relatore3" . $id_att . "' placeholder='Relatore 3'>" . $row["relatore3"] . "</textarea>
				<textarea id='numtelrel" . $id_att . "' placeholder='Telefono relatore'>" . $row["numtelrel"] . "</textarea>
				<textarea id='emailrel" . $id_att . "' placeholder='E-mail relatore'>" . $row["emailrel"] . "</textarea><br><br>";
			}

			if (in_array('altro', $_POST['funz'])) {
				echo "Disponibilità - Materiale - Osservazioni - Aula<br>
				<textarea id='disponibilita" . $id_att . "' placeholder='Disponibilità'>" . $row["disponibilita"] . "</textarea>
				<textarea id='materiale" . $id_att . "' placeholder='Materiale'>" . $row["materiale"] . "</textarea>
				<textarea id='osservazioni" . $id_att . "' placeholder='Osservazioni'>" . $row["osservazioni"] . "</textarea>
				<textarea cols='5' id='aula" . $id_att . "' placeholder='Aula'>" . $row["aula"] . "</textarea><br><br>";
			}

			if (in_array('prop', $_POST['funz'])) {
				echo "Proponente (allievo)<br>
				<textarea cols='5' id='id_utente" . $id_att . "' readonly>" . $row["id_utente"] . "</textarea>
				<textarea id='email" . $id_att . "' placeholder='E-mail proponente'>" . $row["email"] . "</textarea>
				<textarea id='numtel" . $id_att . "' placeholder='Telefono proponente'>" . $row["numtel"] . "</textarea>";
			}

			echo "<div class='aggbutton'>
					<button type='button'  onclick='modProposte(" . $id_att . ")'>Aggiorna</button><br><br>
					<span id='span" . $id_att . "'></span>
				</div>
				<br><hr><br>";
		}
	} else {
		echo "Errore<br><br>";
	}

	}

	?>
</div>
<script>
	function modProposte(ia) {

		$.post("actions/modProposte.php",
		{
			//name: "Donald Duck",

			id : document.getElementById("id" + ia).value,

			giorno : document.getElementById("giorno" + ia).value,
			titolo : document.getElementById("titolo" + ia).value,

			min_iscritti : document.getElementById("min_iscritti" + ia).value,
			max_iscritti : document.getElementById("max_iscritti" + ia).value,

			relatore1 : document.getElementById("relatore1" + ia).value,
			relatore2 : document.getElementById("relatore2" + ia).value,
			relatore3 : document.getElementById("relatore3" + ia).value,
			numtelrel : document.getElementById("numtelrel" + ia).value,
			emailrel : document.getElementById("emailrel" + ia).value,
			referenze : document.getElementById("referenze" + ia).value,
			disponibilita : document.getElementById("disponibilita" + ia).value,

			descrizione : document.getElementById("descrizione" + ia).value,
			materiale : document.getElementById("materiale" + ia).value,
			osservazioni : document.getElementById("osservazioni" + ia).value,
			aula : document.getElementById("aula" + ia).value,
			email : document.getElementById("email" + ia).value,
			percorso : document.getElementById("percorso" + ia).value,
			numtel : document.getElementById("numtel" + ia).value
		},

		function(data, status){
			document.getElementById("span" + ia).innerHTML = data;
			setTimeout(function () {
				document.getElementById("span" + ia).innerHTML = "";
			}, 4000);
		});

	}

</script>
