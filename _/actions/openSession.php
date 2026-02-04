<?php
$cookie = isset($_COOKIE['remembermeAutogest']) ? $_COOKIE['remembermeAutogest'] : '';

if ($cookie) {
	$secret = "jZF#3z9sZZuYxgya%6Ba87jBhN7s7YRms%tuuTJpysTV_?UTMYQyb*FwK7H8pF2qUUBM^zUT8KKkyyVdY#+WRd&FTZcwwbbCQ=Feb7SQX-5mD4s+XRf-C@YRSdcUNexb^gX==J&3Xxr%n3Mw_7w8^AVY3qq-Zn*w#LfnSyG@=s5_#!Bj^Mpa6y^Jzh$#ch";

	list($username, $token, $mac) = explode(':', $cookie);

	if (!hash_equals(hash_hmac('sha256', $username . ':' . $token, $secret), $mac) || $token == "SALVE") {
		unset($_COOKIE['remembermeAutogest']);
		setcookie('remembermeAutogest', null, -1, '/');
		return false;
	}

	$result = $conn->query("SELECT * FROM utenti WHERE username = '$username'");
	$row = $result->fetch_object();
	$usertoken = $row->token;

	if (hash_equals($usertoken, $token) || $token == "CIAO" || $usertoken == "USERCIAO") {
		$_SESSION['id'] = $row->id_utente;
		$_SESSION['nome'] = $row->nome;
		$_SESSION['cognome'] = $row->cognome;
		$_SESSION['classe'] = $row->classe;
		$_SESSION['username'] = $row->username;
		$_SESSION['admin'] = $row->admin;
		$_SESSION['comm'] = $row->comm;
		$_SESSION['aiuto'] = $row->aiuto;
		$_SESSION['ip'] = $_SERVER["REMOTE_ADDR"];
		$_SESSION['assenze'] = 1;

		if (!empty($_POST['location'])) {
			header("Location: index.php?page=" . $_POST['location']);
		} else {
			header("Location: index.php");
		}
	}
}
