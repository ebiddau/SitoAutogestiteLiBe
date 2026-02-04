<?php
	$queryConta = "SELECT COUNT(id_att) AS contare FROM proposte WHERE id_att > 0 AND accettata = 1";
	$resultConta = $conn->query($queryConta);

	$contat = $resultConta->fetch_object()->contare;

	mysqli_free_result($resultConta);

	$num = intval(100*$contat/180);

	if ($num > 100) {
		$num = 100;
	}

	$percento = $num . "%";    //calcolando 180 come necessarie

	?>

	
<center><div class="jumbotron text-center jumbotron-fluid"><span id="scritto">Proposte attuali: <?php echo $contat; ?></span></div><center>
<div class="page_text"></div>
