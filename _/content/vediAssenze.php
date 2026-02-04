<?php
if ($_SESSION['comm'] != 1 && $_SESSION['aiuto'] != 1){
	header ("Location: login.php?level=comm&location=vediAssenze");
} ?>

<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Resoconto assenze</span></div>
<div class="page_text"><?php

	$expgiorno1 = explode(" ", $_SESSION['giorni'][1]);
	$expgiorno2 = explode(" ", $_SESSION['giorni'][2]);
	$expgiorno3 = explode(" ", $_SESSION['giorni'][3]);
	$expgiorno4 = explode(" ", $_SESSION['giorni'][4]);
	$expgiorno5 = explode(" ", $_SESSION['giorni'][5]);
	$expgiorno6 = explode(" ", $_SESSION['giorni'][6]);
	$expgiorno7 = explode(" ", $_SESSION['giorni'][7]);
	$expgiorno8 = explode(" ", $_SESSION['giorni'][8]);
	$expgiorno9 = explode(" ", $_SESSION['giorni'][9]);

	$contaTot = "SELECT COUNT(id_utente) AS totale FROM utenti WHERE classe != 'Docente' AND admin=0 AND comm=0 AND aiuto=0";
	$resultTot = $conn->query($contaTot);

	$totale = $resultTot->fetch_object()->totale;


	$conta1 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza1=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result1 = $conn->query($conta1);

	$assenti1 = $result1->fetch_object()->assenti;


	$conta2 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza2=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result2 = $conn->query($conta2);

	$assenti2 = $result2->fetch_object()->assenti;


	$conta3 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza3=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result3 = $conn->query($conta3);

	$assenti3 = $result3->fetch_object()->assenti;


	$conta4 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza4=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result4 = $conn->query($conta4);

	$assenti4 = $result4->fetch_object()->assenti;


	$conta5 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza5=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result5 = $conn->query($conta5);

	$assenti5 = $result5->fetch_object()->assenti;


	$conta6 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza6=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result6 = $conn->query($conta6);

	$assenti6 = $result6->fetch_object()->assenti;


	$conta7 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza7=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result7 = $conn->query($conta7);

	$assenti7 = $result7->fetch_object()->assenti;


	$conta8 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza8=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result8 = $conn->query($conta8);

	$assenti8 = $result8->fetch_object()->assenti;


	$conta9 = "SELECT COUNT(a.id_utente) AS assenti FROM assenze a, utenti u WHERE assenza9=1 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$result9 = $conn->query($conta9);

	$assenti9 = $result9->fetch_object()->assenti;


	$contaS1 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza1=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS1 = $conn->query($contaS1);

	$nonMarcati1 = $resultS1->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati1 == 0) {
		$percento1 = "0%";
	} else {
		$percento1 = $assenti1/($totale-$nonMarcati1)*100;
		$percento1 = round($percento1, 2) . "%";
	}


	$contaS2 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza2=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS2 = $conn->query($contaS2);

	$nonMarcati2 = $resultS2->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati2 == 0) {
		$percento2 = "0%";
	} else {
		$percento2 = $assenti2/($totale-$nonMarcati2)*100;
		$percento2 = round($percento2, 2) . "%";
	}


	$contaS3 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza3=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS3 = $conn->query($contaS3);

	$nonMarcati3 = $resultS3->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati3 == 0) {
		$percento3 = "0%";
	} else {
		$percento3 = $assenti3/($totale-$nonMarcati3)*100;
		$percento3 = round($percento3, 2) . "%";
	}


	$contaS4 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza4=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS4 = $conn->query($contaS4);

	$nonMarcati4 = $resultS4->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati4 == 0) {
		$percento4 = "0%";
	} else {
		$percento4 = $assenti4/($totale-$nonMarcati4)*100;
		$percento4 = round($percento4, 2) . "%";
	}


	$contaS5 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza5=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS5 = $conn->query($contaS5);

	$nonMarcati5 = $resultS5->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati5 == 0) {
		$percento5 = "0%";
	} else {
		$percento5 = $assenti5/($totale-$nonMarcati5)*100;
		$percento5 = round($percento5, 2) . "%";
	}


	$contaS6 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza6=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS6 = $conn->query($contaS6);

	$nonMarcati6 = $resultS6->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati6 == 0) {
		$percento6 = "0%";
	} else {
		$percento6 = $assenti6/($totale-$nonMarcati6)*100;
		$percento6 = round($percento6, 2) . "%";
	}


	$contaS7 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza7=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS7 = $conn->query($contaS7);

	$nonMarcati7 = $resultS7->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati7 == 0) {
		$percento7 = "0%";
	} else {
		$percento7 = $assenti7/($totale-$nonMarcati7)*100;
		$percento7 = round($percento7, 2) . "%";
	}


	$contaS8 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza8=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS8 = $conn->query($contaS8);

	$nonMarcati8 = $resultS8->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati8 == 0) {
		$percento8 = "0%";
	} else {
		$percento8 = $assenti8/($totale-$nonMarcati8)*100;
		$percento8 = round($percento8, 2) . "%";
	}


	$contaS9 = "SELECT COUNT(a.id_utente) AS sconosciuti FROM assenze a, utenti u WHERE assenza9=0 AND u.id_utente=a.id_utente AND admin=0 AND comm=0 AND aiuto=0";
	$resultS9 = $conn->query($contaS9);

	$nonMarcati9 = $resultS9->fetch_object()->sconosciuti;

	if ($totale-$nonMarcati9 == 0) {
		$percento9 = "0%";
	} else {
		$percento9 = $assenti9/($totale-$nonMarcati9)*100;
		$percento9 = round($percento9, 2) . "%";
	}
	$media = ($percento1+$percento2+$percento3+$percento4+$percento5+$percento6)/6; ?>

	<div id="non-printable">
		<a class="button" onclick="window.print();">Stampa</a><br><br>
	</div><!--chiude non-printable-->
	<div id="tabella_assenze" style ="color: white !important;">
	<table border="1">
		<tr>
			<th>Giorno</th>
			<th>Presenti</th>
			<th>Assenti</th>
			<th>Non marcati</th>
			<th>Percentuale assenza</th>
		</tr>

		<tr>
			<td><?php echo $expgiorno1[0] . " " . $expgiorno1[1] . " " . $expgiorno1[2] . "<br>" . $expgiorno1[3]; ?></td>
			<td><?php echo $totale-$assenti1-$nonMarcati1; ?></td>
			<td><?php echo $assenti1; ?></td>
			<td><?php echo $nonMarcati1; ?></td>
			<td><?php echo $percento1; ?></td>
		</tr>
		<tr>
			<td><?php echo $expgiorno2[0] . " " . $expgiorno2[1] . " " . $expgiorno2[2] . "<br>" . $expgiorno2[3]; ?></td>
			<td><?php echo $totale-$assenti2-$nonMarcati2; ?></td>
			<td><?php echo $assenti2; ?></td>
			<td><?php echo $nonMarcati2; ?></td>
			<td><?php echo $percento2; ?></td>
		</tr>
		<tr>
			<td><?php echo $expgiorno3[0] . " " . $expgiorno3[1] . " " . $expgiorno3[2] . "<br>" . $expgiorno3[3]; ?></td>
			<td><?php echo $totale-$assenti3-$nonMarcati3; ?></td>
			<td><?php echo $assenti3; ?></td>
			<td><?php echo $nonMarcati3; ?></td>
			<td><?php echo $percento3; ?></td>
		</tr>
		<tr>
			<td><?php echo $expgiorno4[0] . " " . $expgiorno4[1] . " " . $expgiorno4[2] . "<br>" . $expgiorno4[3]; ?></td>
			<td><?php echo $totale-$assenti4-$nonMarcati4; ?></td>
			<td><?php echo $assenti4; ?></td>
			<td><?php echo $nonMarcati4; ?></td>
			<td><?php echo $percento4; ?></td>
		</tr>
		<tr>
			<td><?php echo $expgiorno5[0] . " " . $expgiorno5[1] . " " . $expgiorno5[2] . "<br>" . $expgiorno5[3]; ?></td>
			<td><?php echo $totale-$assenti5-$nonMarcati5; ?></td>
			<td><?php echo $assenti5; ?></td>
			<td><?php echo $nonMarcati5; ?></td>
			<td><?php echo $percento5; ?></td>
		</tr>
		<tr>
			<td><?php echo $expgiorno6[0] . " " . $expgiorno6[1] . " " . $expgiorno6[2] . "<br>" . $expgiorno6[3]; ?></td>
			<td><?php echo $totale-$assenti6-$nonMarcati6; ?></td>
			<td><?php echo $assenti6; ?></td>
			<td><?php echo $nonMarcati6; ?></td>
			<td><?php echo $percento6; ?></td>
		</tr>
		<tr>
		  <td><?php echo $expgiorno7[0] . " " . $expgiorno7[1] . " " . $expgiorno7[2] . "<br>" . $expgiorno7[3]; ?></td>
		  <td><?php echo $totale-$assenti7-$nonMarcati7; ?></td>
		  <td><?php echo $assenti7; ?></td>
		  <td><?php echo $nonMarcati7; ?></td>
		  <td><?php echo $percento7; ?></td>
		</tr>
		<tr>
		  <td><?php echo $expgiorno8[0] . " " . $expgiorno8[1] . " " . $expgiorno8[2] . "<br>" . $expgiorno8[3]; ?></td>
		  <td><?php echo $totale-$assenti8-$nonMarcati8; ?></td>
		  <td><?php echo $assenti8; ?></td>
		  <td><?php echo $nonMarcati8; ?></td>
		  <td><?php echo $percento8; ?></td>
		</tr>
		<tr>
		  <td><?php echo $expgiorno9[0] . " " . $expgiorno9[1] . " " . $expgiorno9[2] . "<br>" . $expgiorno9[3]; ?></td>
		  <td><?php echo $totale-$assenti9-$nonMarcati9; ?></td>
		  <td><?php echo $assenti9; ?></td>
		  <td><?php echo $nonMarcati9; ?></td>
		  <td><?php echo $percento9; ?></td>
		</tr>
	</table></div><br>Totale allievi: <?php echo $totale; ?><br><br>La percentuale non tiene conto dei non marcati. Media assenza: <?php echo round($media, 2) . "%";?><br><br><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][1] . "</h3><br>";

	$queryLista1 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza1=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista1 = $conn->query($queryLista1);

	while($rowL1 = $resultLista1->fetch_array()) {
		echo $rowL1['nome'] . " " . $rowL1['cognome'] . " " . $rowL1['classe'] . "<br>";
	}

	if ($resultLista1->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>
	<?php
	if ($nonMarcati1 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][1] . "</h3><br>";

		$queryLista1 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza1=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista1 = $conn->query($queryLista1);

		while($rowL1 = $resultLista1->fetch_array()) {
			echo $rowL1['nome'] . " " . $rowL1['cognome'] . " " . $rowL1['classe'] . "<br>";
		}

		if ($resultLista1->num_rows == 0) {
			echo "Nessuno<br>";
		}
	}	?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][2] . "</h3><br>";

	$queryLista2 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza2=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista2 = $conn->query($queryLista2);

	while($rowL2 = $resultLista2->fetch_array()) {
		echo $rowL2['nome'] . " " . $rowL2['cognome'] . " " . $rowL2['classe'] . "<br>";
	}

	if ($resultLista2->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>
	<?php
	if ($nonMarcati2 > 0) { ?>

		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][2] . "</h3><br>";

		$queryLista1 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza2=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista1 = $conn->query($queryLista1);

		while($rowL1 = $resultLista1->fetch_array()) {
			echo $rowL1['nome'] . " " . $rowL1['cognome'] . " " . $rowL1['classe'] . "<br>";
		}

		if ($resultLista1->num_rows == 0) {
			echo "Nessuno<br>";
		}
	}?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][3] . "</h3><br>";

	$queryLista3 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza3=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista3 = $conn->query($queryLista3);

	while($rowL3 = $resultLista3->fetch_array()) {
		echo $rowL3['nome'] . " " . $rowL3['cognome'] . " " . $rowL3['classe'] . "<br>";
	}

	if ($resultLista3->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati3 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][3] . "</h3><br>";

		$queryLista3 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza3=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista3 = $conn->query($queryLista3);

		while($rowL3 = $resultLista3->fetch_array()) {
			echo $rowL3['nome'] . " " . $rowL3['cognome'] . " " . $rowL3['classe'] . "<br>";
		}

		if ($resultLista3->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][4] . "</h3><br>";

	$queryLista4 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza4=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista4 = $conn->query($queryLista4);

	while($rowL4 = $resultLista4->fetch_array()) {
		echo $rowL4['nome'] . " " . $rowL4['cognome'] . " " . $rowL4['classe'] . "<br>";
	}

	if ($resultLista4->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati4 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][4] . "</h3><br>";

		$queryLista4 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza4=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista4 = $conn->query($queryLista4);

		while($rowL4 = $resultLista4->fetch_array()) {
			echo $rowL4['nome'] . " " . $rowL4['cognome'] . " " . $rowL4['classe'] . "<br>";
		}

		if ($resultLista4->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][5] . "</h3><br>";

	$queryLista5 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza5=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista5 = $conn->query($queryLista5);

	while($rowL5 = $resultLista5->fetch_array()) {
		echo $rowL5['nome'] . " " . $rowL5['cognome'] . " " . $rowL5['classe'] . "<br>";
	}

	if ($resultLista5->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati5 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][5] . "</h3><br>";

		$queryLista5 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza5=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista5 = $conn->query($queryLista5);

		while($rowL5 = $resultLista5->fetch_array()) {
			echo $rowL5['nome'] . " " . $rowL5['cognome'] . " " . $rowL5['classe'] . "<br>";
		}

		if ($resultLista5->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][6] . "</h3><br>";

	$queryLista6 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza6=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista6 = $conn->query($queryLista6);

	while($rowL6 = $resultLista6->fetch_array()) {
		echo $rowL6['nome'] . " " . $rowL6['cognome'] . " " . $rowL6['classe'] . "<br>";
	}

	if ($resultLista6->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati6 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][6] . "</h3><br>";

		$queryLista6 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza6=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista6 = $conn->query($queryLista6);

		while($rowL6 = $resultLista6->fetch_array()) {
			echo $rowL6['nome'] . " " . $rowL6['cognome'] . " " . $rowL6['classe'] . "<br>";
		}

		if ($resultLista6->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][7] . "</h3><br>";

	$queryLista7 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza7=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista7 = $conn->query($queryLista7);

	while($rowL7 = $resultLista7->fetch_array()) {
		echo $rowL7['nome'] . " " . $rowL7['cognome'] . " " . $rowL7['classe'] . "<br>";
	}

	if ($resultLista7->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati7 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][7] . "</h3><br>";

		$queryLista7 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza7=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista7 = $conn->query($queryLista7);

		while($rowL7 = $resultLista7->fetch_array()) {
			echo $rowL7['nome'] . " " . $rowL7['cognome'] . " " . $rowL7['classe'] . "<br>";
		}

		if ($resultLista7->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][8] . "</h3><br>";

	$queryLista8 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza8=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista8 = $conn->query($queryLista8);

	while($rowL8 = $resultLista8->fetch_array()) {
		echo $rowL8['nome'] . " " . $rowL8['cognome'] . " " . $rowL8['classe'] . "<br>";
	}

	if ($resultLista8->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati8 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][8] . "</h3><br>";

		$queryLista8 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza8=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista8 = $conn->query($queryLista8);

		while($rowL8 = $resultLista8->fetch_array()) {
			echo $rowL8['nome'] . " " . $rowL8['cognome'] . " " . $rowL8['classe'] . "<br>";
		}

		if ($resultLista8->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
	<br><hr><br>

	<h3>Assenti <?php echo $_SESSION['giorni'][9] . "</h3><br>";

	$queryLista9 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza9=1 AND admin=0 AND comm=0 AND aiuto=0";
	$resultLista9 = $conn->query($queryLista9);

	while($rowL9 = $resultLista9->fetch_array()) {
		echo $rowL9['nome'] . " " . $rowL9['cognome'] . " " . $rowL9['classe'] . "<br>";
	}

	if ($resultLista9->num_rows == 0) {
		echo "Nessuno<br>";
	} ?>

	<?php
	if ($nonMarcati9 > 0) { ?>
		<br><br><h3>Non marcati <?php echo $_SESSION['giorni'][9] . "</h3><br>";

		$queryLista9 = "SELECT nome, cognome, classe FROM utenti u, assenze a WHERE u.id_utente=a.id_utente AND a.assenza9=0 AND admin=0 AND comm=0 AND aiuto=0";
		$resultLista9 = $conn->query($queryLista9);

		while($rowL9 = $resultLista9->fetch_array()) {
			echo $rowL9['nome'] . " " . $rowL9['cognome'] . " " . $rowL9['classe'] . "<br>";
		}

		if ($resultLista9->num_rows == 0) {
			echo "Nessuno<br>";
		}
	} ?>
</div>
