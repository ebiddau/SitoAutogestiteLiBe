<?php
if ($_SESSION['comm'] != 1){
	header ("Location: login.php?level=comm&location=modificaPercorsi");
} ?>
<div class='jumbotron text-center jumbotron-fluid'>Modifica percorsi</div>
<div class="page_text">
	<style>
		table, td {
			border: 1px solid black;
		}
	</style>
	Cercate di usare colori un po' diversi, non troppo scuri. <u>Non è possibile aggiungere altri percorsi.</u><br><br>
	<?php

	$queryCol = "SELECT * FROM percorsi WHERE id_percorso > 0";
	$resultCol = $conn->query($queryCol);

	echo "<table><tr><td><b>ID</b></td><td><b>Percorso</b></td><td><b>Colore</b></td><td><b>Attivato</b></td></tr>";

	while($rowCol = $resultCol->fetch_assoc()) {
		echo "
			<tr>
				<td><textarea id='id" . $rowCol["id_percorso"] . "' cols='5' readonly>" . $rowCol["id_percorso"] . "</textarea></td>
				<td><textarea id='nome" . $rowCol["id_percorso"] . "' placeholder='Percorso'>" . $rowCol["nome"] . "</textarea></td>
				<td><img width='40px' height='40px' src='img/colori/" . $rowCol["colore"] . ".png'></td>";
				if ($rowCol["attivato"] == 1) {
					echo "<td><label><input checked type='radio' value='1' name='on" . $rowCol["id_percorso"] . "' id='attivato" . $rowCol["id_percorso"] . "'> Si</label><label><input type='radio' value='0' name='on" . $rowCol["id_percorso"] . "' id='attivato" . $rowCol["id_percorso"] . "'> No</label></td>";
				} else {
					echo "<td><label><input type='radio' value='1' name='on" . $rowCol["id_percorso"] . "' id='attivato" . $rowCol["id_percorso"] . "'> Si</label><label><input checked type='radio' value='0' name='on" . $rowCol["id_percorso"] . "' id='attivato" . $rowCol["id_percorso"] . "'> No</label></td>";
				}
		echo 	"<td><button onclick='modifica(" . $rowCol["id_percorso"] . ")'>Salva</button><span id='ok" . $rowCol["id_percorso"] . "'></span></td>
			</tr>";
	}

	echo "</table>"; ?>
</div>
<script>
	function modifica(ia) {
		var id = document.getElementById("id" + ia).value;
		var nome = document.getElementById("nome" + ia).value;
		var attivato = $('input[name="on' + ia + '"]:checked').val();

		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById("ok" + ia).innerHTML = this.responseText;
				setTimeout(function () {
					document.getElementById("ok" + ia).innerHTML = "";
				}, 4000);
			}
		};
		xhttp.open("GET", "actions/modPercorsi.php?id=" + id + "&nome=" + nome + "&attivato=" + attivato, true);
		xhttp.send();
	}
</script>
