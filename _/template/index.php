<?php
require("template/header.php");

if (!isset($_SESSION['giorni'])) {
	$_SESSION['webmaster'] = "tami@liceobellinzona.ch";

	$queryGiorni = "SELECT * FROM giorni ORDER BY id_giorno ASC";
	$resultGiorni = $conn->query($queryGiorni);

	$i = 1;

	while ($rowGiorni = $resultGiorni->fetch_array()) {
		$_SESSION['giorni'][$i] = $rowGiorni['giorno'];
		$i++;
	}

	mysqli_free_result($resultGiorni);

	$queryOn = "SELECT * FROM funzioni";
	$resultOn = $conn->query($queryOn);

	while ($rowOn = $resultOn->fetch_assoc()) {
		$_SESSION[$rowOn['funzione']] = $rowOn['abilitata'];	//ok

		$roba = 'motivo-' . $rowOn['funzione'];		//boh
		$_SESSION[$roba] = $rowOn['motivo'];
	}

	mysqli_free_result($resultOn);
}


require("template/menu.php");

$page = "home";						//pagina di default

if (isset($_GET['page'])) {   		//pagina passata via parametro
	$page = $_GET['page'];
	if ($page != basename($page) || !preg_match("/^[A-Za-z0-9\-_]+$/", $page) || $page == "index" || !file_exists("content/" . $page . ".php")) {
		$page = "error404";     			//pagina di errore 404
	}
}

require("content/" . $page . ".php");

require("template/footer.php");
