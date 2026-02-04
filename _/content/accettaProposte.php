<?php
if ($_SESSION['comm'] != 1){
	header ("Location: login.php?level=comm&location=accettaProposte");
}?>
<div class='jumbotron text-center'>Accetta proposte</div>
<div class="page_text">
	<h5 style="margin-bottom:0px;text-decoration:none;"> Si - No</h5>
	<?php

	$queryC1 = "SELECT titolo, id_att, accettata FROM proposte WHERE id_att > 0";
	$resultC1 = $conn->query($queryC1);

	while($row1 = $resultC1->fetch_array()) {
		$id_att = $row1['id_att'];
		$titolo = $row1['titolo'];
		$accettata = $row1['accettata'];

		if ($accettata == 1) {
			echo "<input type='radio' name='$id_att' value='1' required checked onclick='aggiorna($id_att)'><input type='radio' name='$id_att' value='0' onclick='aggiorna($id_att)'><span id='$id_att'></span>" . $id_att . " - " . $titolo . "<br>";
		} else {
			echo "<input type='radio' name='$id_att' value='1' required onclick='aggiorna($id_att)'><input type='radio' name='$id_att' value='0' checked onclick='aggiorna($id_att)'><span id='$id_att'></span>" . $id_att . " - " . $titolo . "<br>";
		}
	}

	mysqli_free_result($resultC1); ?>
</div>
<script>
	function aggiorna(id) {
		var acc = $('input[name=' + id + ']:checked').val();
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				document.getElementById(id).innerHTML = this.responseText;
				setTimeout(function () {
					document.getElementById(id).innerHTML = "";
				}, 4000);
			}
		};
		xhttp.open("GET", "actions/aggProposte.php?id=" + id + "&acc=" + acc, true);
		xhttp.send();
	}
</script>
