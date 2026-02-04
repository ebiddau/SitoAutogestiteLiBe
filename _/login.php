<?php
if (isset($_SESSION['username'])) {
	if (isset($_GET['location'])) {
		header("Location: index.php?page=" . $_GET['location']);
	} else {
		header("Location: index.php");
	}
} else {

	require("template/header.php");
	require("template/menu.php");

	if (isset($_GET["level"])) {
		if ($_GET["level"] == "admin") {
			$msg = "<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Accesso ad area moooolto riservata</span></div><div class='page_text'>Devi essere un amministratore per accedere a questa pagina<br><br>";
		} else if ($_GET["level"] == "comm") {
			$msg = "<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Accesso ad area molto riservata</span></div><div class='page_text'>Devi essere un membro della commissione per accedere a questa pagina<br><br>";
		} else {
			$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'>";
		}
	} else {
		$msg = "<div class='jumbotron text-center jumbotron-fluid'><span id='scritto'>Accesso ad area riservata</span></div><div class='page_text'>";
	}
	echo "<script>console.log('boh')</script>";
	if (isset($_POST['invia'])) {
		$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
		$username = $conn->real_escape_string($username);
		$username = trim(strtolower($username));
		echo "<script>console.log('$username')</script>";
		$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$password = $conn->real_escape_string($password);
		echo "<script>console.log('$password')</script>";
		$result = $conn->query("SELECT * FROM utenti WHERE username = '$username'");
		$row = $result->fetch_object();
		echo "<script>console.log('$row->username')</script>";
		echo "<script>console.log('$row->password')</script>";
		$password_sha = sha1($password);
		if ($row->username == $username and $row->password == $password_sha)  {
			echo "<script>console.log('Funziona')</script>";
		

		// imap_errors();
		// imap_alerts();

		// if (!$imap) {
		// 	if (!isset($errore_login)) {
		// 		$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'><h3 style='color:red;'>Username o password sono sbagliati, ritenta.</h3>";
		// 		$msg .= "<br>Non hai la password o l'hai smarrita? Contatta il tuo docente di classe che chiederà per conto tuo una nuova password ai Sistemisti<br><br>";
		// 		$msg .= "Riesci ad accedere ai PC scolastici ma non al sito delle autogestite? Accedi ad un PC scolastico, cambia password (CTRL+ALT+DEL e appare l'opzione) e ritenta<br><br>";


		// 		$errore_login = true;
		// 	} else {
		// 		$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'><h3 style='color:red;'>Username o password sono sbagliati.</h3>Se hai problemi di accesso, <a href='index.php?page=contatti' target='_blank'>contatta il supporto tecnico</a>.<br><br>";
		// 	}

		// } else {
			if ($result->num_rows == 0) {
				$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'><h3 style='color:red;'>C'è un problema con il database, <a href='index.php?page=contatti' target='_blank'>contatta il supporto tecnico</a>.</h3>";
			} else {
				$secret = "jZF#3z9sZZuYxgya%6Ba87jBhN7s7YRms%tuuTJpysTV_?UTMYQyb*FwK7H8pF2qUUBM^zUT8KKkyyVdY#+WRd&FTZcwwbbCQ=Feb7SQX-5mD4s+XRf-C@YRSdcUNexb^gX==J&3Xxr%n3Mw_7w8^AVY3qq-Zn*w#LfnSyG@=s5_#!Bj^Mpa6y^Jzh$#ch";

				$row = $result->fetch_object();

				if ($_POST['ricordami'] == "y") {
					$token = sha1($username) . sha1(date(DATE_ISO8601)); // generate a token

					$resultUpdate = $conn->query("UPDATE utenti SET token='" . $token . "' WHERE username='" . $username . "'");

					$cookie = $username . ':' . $token;
					$mac = hash_hmac('sha256', $cookie, $secret);
					$cookie .= ':' . $mac;
					setcookie('remembermeAutogest', $cookie, time() + (86400 * 30)); // 86400 = 1 day
				}

				$_SESSION['id'] = $row->id_utente;
				$_SESSION['nome'] = $row->nome;
				$_SESSION['cognome'] = $row->cognome;
				$_SESSION['classe'] = $row->classe;
				$_SESSION['username'] = $row->username;
				$_SESSION['admin'] = $row->admin;
				$_SESSION['comm'] = $row->comm;
				$_SESSION['aiuto'] = $row->aiuto;
				$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];

				// Così si può decidere quando aprire le iscrizioni, modificando il valore nel database
				$_SESSION['iscrizione'] = $row->iscrizione;
				$_SESSION['assenze'] = 1;
				$_SESSION['apertura_iscrizione'] = "2021-03-14 12:00:00";

				mysqli_free_result($result);
				imap_close($imap);

				if (!empty($_POST['location'])) {
					header ("Location: index.php?page=" . $_POST['location']);
				} else {
					header ("Location: index.php");
				}
			}
		}
		else {
			if (!isset($errore_login)) {
				$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'><h3 style='color:red;'>Username o password sono sbagliati, ritenta.</h3>";
				$msg .= "<br>Non hai la password o l'hai smarrita? Contatta il tuo docente di classe che chiederà per conto tuo una nuova password ai Sistemisti<br><br>";
				$msg .= "Riesci ad accedere ai PC scolastici ma non al sito delle autogestite? Accedi ad un PC scolastico, cambia password (CTRL+ALT+DEL e appare l'opzione) e ritenta<br><br>";
			
				$errore_login = true;
			} 
			else {
				$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'><h3 style='color:red;'>Username o password sono sbagliati.</h3>Se hai problemi di accesso, <a href='index.php?page=contatti' target='_blank'>contatta il supporto tecnico</a>.<br><br>";
			}}
	}  // fine isset post

	require("actions/openSession.php");		//se l'utente ha il cookie, fa il login e lo porta alla home
	?>
	<?php
	echo $msg;
	?>

		<form action="login.php" method="POST" style="width: 100%; max-width: 330px; display: block; margin: 0 auto;">
			<input type="hidden" name="location" value="<?php echo $_GET['location'];?>">
			Effettua il login con i tuoi dati del liceo per accedere alle aree riservate.<br><br>
			<div class="form-group">
				<label for="username">Nome utente:</label>
				<input name="username" type="text" class="form-control" id="username" required>
			</div>
			<div class="form-group">
				<label for="username">Password:</label>
				<div id="tutta">
				<input name="password" type="password" class="form-control" id="password" required>
				<div id="togglePassword" class="eye-icon">👁️</div>
			</div>
			<input name="ricordami" type="checkbox" value="y" checked> Ricordami<br><br>
			<input name="invia" type="submit" value="Login" class="btn btn-lg btn-primary btn-block">
		</form>
	</div>

	<style> 
			.page_text {
				color: white;
				margin-left: 30%;
  				margin-right: 30%;
				padding-right: 5%;
				padding-left: 5%;
				padding-top: 50px;
				padding-bottom: 200px;
				background-color: #252020;
				border-radius: 20px;
				filter: opacity(90%);
				margin-bottom: 200px;
				position: relative;
				z-index: 2;
			}
		</style>
	<?php

	require("template/footer.php");
	
} ?>

