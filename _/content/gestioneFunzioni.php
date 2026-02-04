<?php
if ($_SESSION['admin'] != 1){
	header ("Location: login.php?level=admin&location=gestisciFunzioni");
} ?>
<div class='jumbotron text-center jumbotron-fluid'>Gestione funzioni</div>
<div class="page_text"><?php

	$queryOn = "SELECT * FROM funzioni";
	$resultOn = $conn->query($queryOn);
	?>

	<table class="table table-striped">
		<thead class="thead-light">
			<tr>
				<th>Nome Funzione</th>
				<th>Descrizione</th>
				<th>Attiva?</th>
			</tr>
		</thead>
		<tbody>
			<?php while ($rowOn = $resultOn->fetch_assoc()) { ?>
			<tr>
				<td><?php echo $rowOn["funzione"]; ?></td>
				<td><?php echo $rowOn["descrizione"]; ?></td>
				<?php if ($rowOn["abilitata"] == 1) {
					echo "<td><label><input checked type='radio' value='1' onclick='attiva(" . $rowOn["id_funzione"] . ")' name='on" . $rowOn["id_funzione"] . "' id='attivato" . $rowOn["id_funzione"] . "'> Si</label><label><input type='radio' onclick='attiva(" . $rowOn["id_funzione"] . ")' value='0' name='on" . $rowOn["id_funzione"] . "' id='attivato" . $rowOn["id_funzione"] . "'> No</label></td><td><span id='ok" . $rowOn["id_funzione"] . "'></span></td>";
				} else {
					echo "<td><label><input type='radio' onclick='attiva(" . $rowOn["id_funzione"] . ")' value='1' name='on" . $rowOn["id_funzione"] . "' id='attivato" . $rowOn["id_funzione"] . "'> Si</label><label> <input checked type='radio' value='0' onclick='attiva(" . $rowOn["id_funzione"] . ")' name='on" . $rowOn["id_funzione"] . "' id='attivato" . $rowOn["id_funzione"] . "'> No</label></td><td><span id='ok" . $rowOn["id_funzione"] . "'></span></td>";
				} ?>
			</tr>
			<?php } ?>

	</tbody>
</table><br><br>

</div>
<script>
	function attiva(id) {
		var att = $('input[name=on' + id + ']:checked').val();
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("ok" + id).innerHTML = this.responseText;
				setTimeout(function () {
					document.getElementById("ok" + id).innerHTML = "";
				}, 4000);
			}
		};
		xhttp.open("GET", "actions/modFunzioni.php?id=" + id + "&att=" + att, true);
		xhttp.send();
	}
</script>
