
<script>
	console.log("ciao");
    console.log("<?php echo $_SESSION['giorni'][1]; ?>");
	console.log("<?php echo isset($_SESSION['giorni']); ?>");
</script>

<?php
require("template/header.php"); #starta la sessione in header.php e si collega al database tramite config.php requirato in header.php

if (!isset($_SESSION['giorni'])) { #se la variabile giorni della sessione è nulla il webmaster della sessione è tami
	$_SESSION['webmaster'] = "fontanam@liceobellinzona.ch";

	$queryGiorni = "SELECT * FROM giorni ORDER BY id_giorno ASC";
	$resultGiorni = $conn->query($queryGiorni); #query al database dei giorni

	$i = 1;

	while ($rowGiorni = $resultGiorni->fetch_array()) {
		$_SESSION['giorni'][$i] = $rowGiorni['giorno'];
		$i++;
	}

	?>
<script>
	console.log("ciao");
    console.log("<?php echo $_SESSION['giorni'][1]; ?>");
</script>
	<?php

	mysqli_free_result($resultGiorni);

	$queryOn = "SELECT * FROM funzioni"; # query al database delle funzioni 
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

?>

