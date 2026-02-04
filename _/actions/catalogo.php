<?php session_start(); ?>
<script>
    console.log("<?php echo $_SESSION['giorni'][2]; ?>");
</script>
<!Doctype HTML>
<html lang="it">
<style media="screen">
	@font-face {
		font-family: Seventy;
		src: url("/autogestite/font/Prisma.otf");
	}
</style>

<head>
	<title>Autogestite LiBe - Catalogo</title>
	<meta name="description" content="Il sito ufficiale delle autogestite del liceo di Bellinzona. Autogestisciti anche tu!">
	<meta charset="UTF-8">

	<link href="../img/favicon.ico" rel="icon">
	<link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@900&display=swap" rel="stylesheet">
</head>

<body>

	<style>
		/* per scroll */
 		html {
			scroll-behavior: smooth;
			width: 100%;
			height: 100%;
		}
		body {
			background:#2c3e50;
			font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif !important;
			color: white;
		}
		#non-printable > a, button {
			background: #0066FF;
			border: 2px solid #0066FF;
			border-radius: 5px;
			color: white;
			padding: 10px 0;
			text-decoration: none;
			font-family: sans-serif;
			font-size: 16px;
			display: inline-block;
			text-align: center;
			box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.19);
			transition: 0.25s;
		}
		.backtotop {
			background: #0066FF;
			border: 2px solid #0066FF;
			border-radius: 5px;
			color: white;
			padding: 10px 0;
			text-decoration: none;
			font-family: sans-serif;
			font-size: 16px;
			display: inline-block;
			text-align: center;
			box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.19);
			transition: 0.25s;
		}



		.button,
		button {
			margin: 10px 5px;
			width: 10%;
		}

		.backtotop {
			display: block;
			margin-top: 10px;
			margin-bottom: 5px;
		}

		a:hover,
		button:hover {
			background-color: white;
			border-color: #0066FF;
			color: #0066FF;
			cursor: pointer;
			transition: 0.25s;
		}

		a:active,
		button:active {
			transition: 0.4s;
		}

		table {
			background: linear-gradient(#2c3e50 50%, #1c1618 99%) !important;
			height: 21cm;
			width: 100%;
			border-collapse: collapse;
		}

		tr {
			page-break-inside: avoid;
			page-break-after: auto;
		}

		td {
			border: 1px solid black;
			padding: 4px;
		}

		@media print {
			table {
				page-break-inside: auto
			}

			tr {
				page-break-inside: avoid;
				page-break-after: auto
			}

			#non-printable,
			header,
			nav,
			footer {
				display: none;
			}
		}

		body {
			-webkit-print-color-adjust: exact;
			-moz-print-color-adjust: exact;
			font-family: sans-serif;
		}


		.jumbotron {
			color: white;
			font-size: 70px;
			height: 40vh;
			display: flex;
			align-items: center;
			justify-content: center;
			margin-bottom: 0 !important;
			font-family:'Exo 2', sans-serif;
			letter-spacing: 3px;
			background-color: #2c3e50 !important;
			flex-flow: row wrap;

			}
		.navveloce{
			margin-bottom: 100px;
		}
		.navveloce > ul {
			list-style-type: none;
		}
		.navveloce > ul > li {
			margin-bottom: 10px;
		}
		.navveloce > ul > li > a {
			color: white;
			text-decoration: none;
			font-size: 20px;
		}
		.navveloce > ul > li > a:hover {
    		color: grey; 
    		font-size: 22px; 
		}

	</style>
	<?php

	require("../config/config.php");

	if (!isset($_SESSION['giorni'])) {
		$_SESSION['webmaster'] = "fontanam@liceobellinzona.ch";

		$queryGiorni = "SELECT * FROM giorni ORDER BY id_giorno ASC";
		$resultGiorni = $conn->query($queryGiorni);

		$i = 1;

?>
<script>
console.log("<?php echo $_SESSION['giorni'][1]; ?>");
<script>
<?php
		while ($rowGiorni = $resultGiorni->fetch_array()) {
			$_SESSION['giorni'][$i] = $rowGiorni['giorno'];
			$i++;
		}
		
		
		?>
	<script>
		alert("Sessione creata");
	</script>
	<?php

		mysqli_free_result($resultGiorni);

		$queryOn = "SELECT * FROM funzioni";
		$resultOn = $conn->query($queryOn);

		while ($rowOn = $resultOn->fetch_assoc()) {
			$_SESSION[$rowOn['funzione']] = $rowOn['abilitata']; //ok

			$roba = 'motivo-' . $rowOn['funzione']; //boh
			$_SESSION[$roba] = $rowOn['motivo'];
		}

		mysqli_free_result($resultOn);
	}

	 //if ($_SESSION['catalogo'] == 0 && $_SESSION['comm'] == 0) {
	//die("<h1>Il catalogo è in fase di preparazione, devi pazientare ancora un po'.</h1>");
	//}	

	?>

	<div id="non-printable">
		<a class="button" href="../index.php">Indietro</a>
		<button onclick="window.print()">Stampa</button>
		<!--<button onclick="scarica()">Scarica</button>--><br><br>
	</div>
	<?php
	echo "<div class='jumbotron text-center jumbotron-fluid'>
	<span id='scritto'>Autogestite 2025</span>
	</div>";
	echo "<center><div class='navveloce'>
    <h2>Vai alla giornata:</h2>
    <ul>
      <li><a href='#lun1'>Lunedì 24 marzo mattina 8:30-10:00</a></li>
      <li><a href='#lun2'>Lunedì 24 marzo mattina 10:30-12:00</a></li>
      <li><a href='#lun3'>Lunedì 24 marzo pomeriggio 14:00-15:30</a></li>
      <li><a href='#mar1'>Martedì 25 marzo mattina 8:30-10:00</a></li>
      <li><a href='#mar2'>Martedì 25 marzo mattina 10:30-12:00</a></li>
      <li><a href='#mar3'>Martedì 25 marzo pomeriggio 14:00-15:30</a></li>
      <li><a href='#mer1'>Mercoledì 26 marzo mattina 8:30-10:00</a></li>
      <li><a href='#mer2'>Mercoledì 26 marzo mattina 10:30-12:00</a></li>
      <li><a href='#mer3'>Mercoledì 26 marzo pomeriggio 14:00-15:30</a></li>
    </ul>
  </div></center>";
	// echo "<table><tr><td colspan='5' style='height: 18cm; text-align:center; font-size:70pt; font-weight: normal; font-family: Seventy;   background: linear-gradient(90deg, rgba(63,94,251,1) 0%, rgba(252,70,107,1) 100%); '><b style='color: white;'>CATALOGO AUTOGESTITE " . date("Y") . "</b></td></tr>"; //copertina


	echo "<table><tr><td colspan='5'><h3 id='lun1'>" . $_SESSION['giorni'][1] . "</h3></td></tr>
				<tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 1";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td>" . $row["titolo"] . "</td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='lun2'>" . $_SESSION['giorni'][2] . "</h3></td></tr>
				<tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 2";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td>" . $row["titolo"] . "</td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='lun3'>" . $_SESSION['giorni'][3] . "</h3></td></tr>
				<tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 3";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td>" . $row["titolo"] . "</td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='mar1'>" . $_SESSION['giorni'][4] . "</h3></td></tr>
				<tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 4";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td>" . $row["titolo"] . "</td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='mar2'>" . $_SESSION['giorni'][5] . "</h3></td></tr>
				<tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 5";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td>" . $row["titolo"] . "</td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		}
	}



	echo "<tr><td colspan='5'><h3 id='mar3'>" . $_SESSION['giorni'][6] . "</h3></td></tr>
				<tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 6";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td>" . $row["titolo"] . "</td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
				<td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
				<td>" . $row["descrizione"] . "</td>
				<td>" . $relatori . "</td>
				<td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='mer1'>" . $_SESSION['giorni'][7] . "</h3></td></tr>
		    <tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 7";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
		    <td>" . $row["titolo"] . "</td>
		    <td>" . $row["descrizione"] . "</td>
		    <td>" . $relatori . "</td>
		    <td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
		    <td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
		    <td>" . $row["descrizione"] . "</td>
		    <td>" . $relatori . "</td>
		    <td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='mer2'>" . $_SESSION['giorni'][8] . "</h3></td></tr>
		    <tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 8";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
		    <td>" . $row["titolo"] . "</td>
		    <td>" . $row["descrizione"] . "</td>
		    <td>" . $relatori . "</td>
		    <td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
		    <td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
		    <td>" . $row["descrizione"] . "</td>
		    <td>" . $relatori . "</td>
		    <td>" . $row["referenze"] . "</td></tr>";
		}
	}


	echo "<tr><td colspan='5'><h3 id='mer3'>" . $_SESSION['giorni'][9] . "</h3></td></tr>
		    <tr style='border:3px solid black'><td>ID</td><td>Titolo</td><td>Descrizione</td><td>Relatore/i</td><td>Referenze</td></tr>";

	$query = "SELECT * FROM proposte WHERE id_att > 0 AND accettata=1 AND giorno = 9";
	$result = $conn->query($query);

	while ($row = $result->fetch_assoc()) {
		$id_att = $row["id_att"];

		$queryColor = "SELECT nome, colore FROM percorsi pe, proposte p WHERE pe.nome= p.nome_percorso AND p.id_att=" . $id_att;
		$resultColor = $conn->query($queryColor);

		while ($rowColor = $resultColor->fetch_assoc()) {
			$colore = $rowColor['colore'];
			$nomep = $rowColor['nome'];
		}

		if ($row["relatore3"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"] . ", " . $row["relatore3"];
		} else if ($row["relatore2"] != "") {
			$relatori = $row["relatore1"] . ", " . $row["relatore2"];
		} else {
			$relatori = $row["relatore"];
		}

		if ($nomep == "Nessuno") {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
		    <td>" . $row["titolo"] . "</td>
		    <td>" . $row["descrizione"] . "</td>
		    <td>" . $relatori . "</td>
		    <td>" . $row["referenze"] . "</td></tr>";
		} else {
			echo "<tr><td id='id" . $id_att . "'>" . $id_att . "</td>
		    <td style='background-image: url(../img/colori/" . $colore . ".png)'>" . $row["titolo"] . "<br><br><span style='font-size:small'>(" . $nomep . ")</span></td>
		    <td>" . $row["descrizione"] . "</td>
		    <td>" . $relatori . "</td>
		    <td>" . $row["referenze"] . "</td></tr>";
		}
	}

	echo "</table>";

	mysqli_free_result($result);
	mysqli_free_result($resultColor); ?>
	<a href="#" class="backtotop">Torna in alto</a>
</body>

</html>


