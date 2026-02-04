<?php
// Controlla se l'utente è già loggato; se sì lo reindirizza alla home o alla location richiesta
if (isset($_SESSION['username'])) {
	if (isset($_GET['location'])) {
		header("Location: index.php?page=" . $_GET['location']);
	} else {
		header("Location: index.php");
	}
} else {

	// Carica header e menu del template (visualizzazione pagina di login)
	require("template/header.php");
	require("template/menu.php");

	// Costruisce il messaggio iniziale in base al parametro 'level' (es. admin, comm)
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

	// Se è stato inviato il form di login: elabora i dati
	if (isset($_POST['invia'])) {
		// Sanitizza e normalizza lo username (rimuove spazi, filtra stringhe e mette in minuscolo)
		$username = htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
		$user_stmt = $conn->prepare("SELECT * FROM utenti WHERE username = ?");
		$username = trim(strtolower($username));
		$user_stmt->bind_param('s',$username);
		$user_stmt->execute();
		

		// Sanitizza la password (attenzione: non dovrebbe essere loggata o esposta)
		$passwordInserita = $_POST['password'];
		
		// Query per ottenere i dati dell'utente corrispondente allo username immesso
		$result = $user_stmt->get_result();
		$user = $result->fetch_object();
		
		// Crittografa la password inviata dall'utente (qui viene usata sha1, considerare password_hash per maggiore sicurezza)
		$hashSalvato = $user->password;
		// Confronto username e password: se corrispondono si fa il login
		if ($user && password_verify($passwordInserita, $hashSalvato))  {
		
			// Controllo addizionale sul numero di righe del risultato (se 0 indica problema DB)
			if ($result->num_rows == 0) {
				$msg = "<div class='jumbotron text-center jumbotron-fluid'>Accesso ad area riservata</div><div class='page_text'><h3 style='color:red;'>C'è un problema con il database, <a href='index.php?page=contatti' target='_blank'>contatta il supporto tecnico</a>.</h3>";
			} else {
				// Secret usato per il MAC del cookie "ricordami" (non mostrarlo in output)
				$secret = "jZF#3z9sZZuYxgya%6Ba87jBhN7s7YRms%tuuTJpysTV_?UTMYQyb*FwK7H8pF2qUUBM^zUT8KKkyyVdY#+WRd&FTZcwwbbCQ=Feb7SQX-5mD4s+XRf-C@YRSdcUNexb^gX==J&3Xxr%n3Mw_7w8^AVY3qq-Zn*w#LfnSyG@=s5_#!Bj^Mpa6y^Jzh$#ch";
				session_regenerate_id(true);
				$user = $result->fetch_object();

				// Se l'utente ha chiesto di essere ricordato, genera token, lo salva nel DB e imposta cookie con HMAC
				if ($_POST['ricordami'] == "y") {
					$token = sha1($username) . sha1(date(DATE_ISO8601)); // genera token
					$resultUpdate = $conn->query("UPDATE utenti SET token='" . $token . "' WHERE username='" . $username . "'");
					$cookie = $username . ':' . $token;
					$mac = hash_hmac('sha256', $cookie, $secret);
					$cookie .= ':' . $mac;
					setcookie('remembermeAutogest', $cookie, time() + (86400 * 30)); // durata 30 giorni
				}

				// Imposta variabili di sessione dell'utente per tenerlo loggato
				$_SESSION['id'] = $user->id_utente;
				$_SESSION['nome'] = $user->nome;
				$_SESSION['cognome'] = $user->cognome;
				$_SESSION['classe'] = $user->classe;
				$_SESSION['username'] = $user->username;
				$_SESSION['admin'] = $user->admin;
				$_SESSION['comm'] = $user->comm;
				$_SESSION['aiuto'] = $user->aiuto;
				$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];

				// Variabili di configurazione legenda: iscrizioni, assenze, data di apertura iscrizioni
				$_SESSION['iscrizione'] = $user->iscrizione;
				$_SESSION['assenze'] = 1;
				$_SESSION['apertura_iscrizione'] = "2021-03-14 12:00:00";

				// Libera risorse e chiude connessioni esterne (es. IMAP)
				mysqli_free_result($result);

				// Reindirizza l'utente alla pagina originaria (se specificata) o alla home
				if (!empty($_POST['location'])) {
					header ("Location: index.php?page=" . $_POST['location']);
				} else {
					header ("Location: index.php");
				}
			}
		}
		else {
			// Gestione degli errori di login: mostra messaggio appropriato (primo tentativo o successivi)
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

	// Se l'utente ha il cookie 'rememberme', actions/openSession.php prova a loggarlo automaticamente
	require("actions/openSession.php");		//se l'utente ha il cookie, fa il login e lo porta alla home
	?>
	<?php
	// Stampa del messaggio costruito in precedenza (info, errori, ecc.)
	echo $msg;
	?>

		<!-- Form di login: invia username, password e opzione 'ricordami' -->
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
			/* Stili per il box che contiene il messaggio di testo della pagina */
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

	// Include del footer del template
	require("template/footer.php");
	
} ?>

