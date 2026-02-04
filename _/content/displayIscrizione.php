<?php
	$queryConta = "SELECT COUNT(*) AS conta FROM scelte WHERE att6 != 0";
	$resultConta = $conn->query($queryConta);
	
	$queryComm = "SELECT COUNT(*) AS comm FROM utenti WHERE classe != 'Docente' AND comm=1";
	$resultComm = $conn->query($queryComm);
	
	$queryTotale = "SELECT COUNT(*) AS totale FROM utenti WHERE classe != 'Docente'";
	$resultTotale = $conn->query($queryTotale);

	$iscritti = $resultConta->fetch_object()->conta + $resultComm->fetch_object()->comm;
	$totale = $resultTotale->fetch_object()->totale;

	mysqli_free_result($resultConta);
	mysqli_free_result($resultComm);
	mysqli_free_result($resultTotale);
	
	$num = intval(100*$iscritti/$totale);

	if ($num > 100) {
		$num = 100;
	}

	$percento = $num . "%"; ?>

	<center>
		<h1 style="font-size:40px">Iscritti attuali: <?php echo $iscritti . " su " . $totale; ?></div><?php
		if ($num == 100) {
			echo '
				<style>
					.lol {    
						width:600px;
						height:200px;
						margin:50px auto;
						border:4px solid rgb(50,50,50);
						background-image: linear-gradient(left, green, green 100%, transparent 100%, transparent 100%);
						background-image: -webkit-linear-gradient(left, green, green 100%, transparent 100%, transparent 100%)  
					}
				</style>
				
				<div class="lol"></div>';
		} else {
			echo '
				<style>
					.lol {    
						width:600px;
						height:200px;
						margin:50px auto;
						border:4px solid rgb(50,50,50);
						background-image: linear-gradient(left, red, red ' . $percento . ', transparent ' . $percento . ', transparent 100%);
						background-image: -webkit-linear-gradient(left, red, red ' . $percento . ', transparent ' . $percento . ', transparent 100%)  
					}
				</style>
				
				<div class="lol"></div>';		
		} ?>	
	</center>