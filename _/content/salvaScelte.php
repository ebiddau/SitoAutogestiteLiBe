<?php
if (isset($_SESSION['username'])) {

	if (isset($_GET['g'])) {
		if ($_GET['g'] == 1) {

			$att1 = $_POST['1'];
			$att2 = $_POST['2'];
			$att3 = $_POST['3'];

			// Controllo se l'attività dura tutta la mattinata; se è così, faccio il controllo in modo diverso
			if($att1 == $att2) {

				$queryC1 = "SELECT max_iscritti FROM proposte WHERE giorno=1 AND accettata=1 AND id_att=$att1" ;
				$resultC1 = $conn->query($queryC1);
				while ($rowC1 = $resultC1->fetch_array()) {
					$max_iscrittiC1 = $rowC1['max_iscritti'];
					$query1 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att1=$att1 AND accettata=1 AND s.att1=p.id_att AND p.giorno=1";
					$result1 = $conn->query($query1);
					$conteggio1 = $result1->fetch_object()->conteggio;
				}

				$max_iscrittiC2 = $max_iscrittiC1;
				$resultC2 = $resultC1;
				$result2 = $result1;

				mysqli_free_result($resultC1);
				mysqli_free_result($result1);

			} else {

				$queryC1 = "SELECT max_iscritti FROM proposte WHERE giorno=1 AND accettata=1 AND id_att=$att1" ;
				$resultC1 = $conn->query($queryC1);
				while ($rowC1 = $resultC1->fetch_array()) {
					$max_iscrittiC1 = $rowC1['max_iscritti'];
					$query1 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att1=$att1 AND accettata=1 AND s.att1=p.id_att AND p.giorno=1";
					$result1 = $conn->query($query1);
					$conteggio1 = $result1->fetch_object()->conteggio ;
				}

				mysqli_free_result($resultC1);
				mysqli_free_result($result1);

				$queryC2 = "SELECT max_iscritti FROM proposte WHERE giorno=2 AND accettata=1 AND id_att=$att2" ;
				$resultC2 = $conn->query($queryC2);
				while ($rowC2 = $resultC2->fetch_array()) {
					$max_iscrittiC2 = $rowC2['max_iscritti'];
					$query2 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att2=$att2 AND accettata=1 AND s.att2=p.id_att AND p.giorno=2";
					$result2 = $conn->query($query2);
					$conteggio2 = $result2->fetch_object()->conteggio ;
				}

				mysqli_free_result($resultC2);
				mysqli_free_result($result2);

			}

			$queryC3 = "SELECT max_iscritti FROM proposte WHERE giorno=3 AND accettata=1 AND id_att=$att3" ;
			$resultC3 = $conn->query($queryC3);
			while ($rowC3 = $resultC3->fetch_array()) {
			  $max_iscrittiC3 = $rowC3['max_iscritti'];
			  $query3 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att3=$att3 AND accettata=1 AND s.att3=p.id_att AND p.giorno=3";
			  $result3 = $conn->query($query3);
			  $conteggio3 = $result3->fetch_object()->conteggio ;
			}

			mysqli_free_result($resultC3);
			mysqli_free_result($result3);

			if ($conteggio1 < $max_iscrittiC1 && $conteggio2 < $max_iscrittiC2 && $conteggio3 < $max_iscrittiC3) {

				$user_id = $_SESSION['id'];

				$sqlUpdateS1 = "UPDATE scelte SET att1=" . $att1 . " WHERE id_utente=" . $_SESSION['id'];
				if ($conn->query($sqlUpdateS1) === TRUE) {
				 //   echo "Scelte effettuate con successo!";
				} else {
					echo "Errore S1: " . $conn->error;
				}

				$sqlUpdateS2 = "UPDATE scelte SET att2=" . $att2 . " WHERE id_utente=" . $_SESSION['id'];
				if ($conn->query($sqlUpdateS2) === TRUE) {
				 //   echo "Scelte effettuate con successo!";
				} else {
					echo "Errore S2: " . $conn->error;
				}

				$sqlUpdateS3 = "UPDATE scelte SET att3=" . $att3 . " WHERE id_utente=" . $_SESSION['id'];
				if ($conn->query($sqlUpdateS3) === TRUE) {
				 //   echo "Scelte effettuate con successo!";
				} else {
				  echo "Errore S3: " . $conn->error;
				}

				echo "<script>window.location='index.php?page=giornata2';</script>";

			} else {
				echo "<script>window.location='index.php?page=iscrizioneAll&msg=202';</script>";
			}

		} else if ($_GET['g'] == 2) {

			$att4 = $_POST['4'];
			$att5 = $_POST['5'];
			$att6 = $_POST['6'];

			if($att4 == $att5) {

			  $queryC4 = "SELECT max_iscritti FROM proposte WHERE giorno=4 AND accettata=1 AND id_att=$att4" ;
			  $resultC4 = $conn->query($queryC4);
			  while ($rowC4 = $resultC4->fetch_array()) {
			    $max_iscrittiC4 = $rowC4['max_iscritti'];
			    $query4 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att4=$att4 AND accettata=1 AND s.att4=p.id_att AND p.giorno=4";
			    $result4 = $conn->query($query4);
			    $conteggio4 = $result4->fetch_object()->conteggio;
			  }

			  $max_iscrittiC5 = $max_iscrittiC4;
			  $resultC5 = $resultC4;
			  $result5 = $result4;

			  mysqli_free_result($resultC4);
			  mysqli_free_result($result4);

			} else {

			  $queryC4 = "SELECT max_iscritti FROM proposte WHERE giorno=4 AND accettata=1 AND id_att=$att4" ;
			  $resultC4 = $conn->query($queryC4);
			  while ($rowC4 = $resultC4->fetch_array()) {
			    $max_iscrittiC4 = $rowC4['max_iscritti'];
			    $query4 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att4=$att4 AND accettata=1 AND s.att4=p.id_att AND p.giorno=4";
			    $result4 = $conn->query($query4);
			    $conteggio4 = $result4->fetch_object()->conteggio ;
			  }

			  mysqli_free_result($resultC4);
			  mysqli_free_result($result4);

			  $queryC5 = "SELECT max_iscritti FROM proposte WHERE giorno=5 AND accettata=1 AND id_att=$att5" ;
			  $resultC5 = $conn->query($queryC5);
			  while ($rowC5 = $resultC5->fetch_array()) {
			    $max_iscrittiC5 = $rowC5['max_iscritti'];
			    $query5 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att5=$att5 AND accettata=1 AND s.att5=p.id_att AND p.giorno=5";
			    $result5 = $conn->query($query5);
			    $conteggio5 = $result5->fetch_object()->conteggio ;
			  }

			  mysqli_free_result($resultC5);
			  mysqli_free_result($result5);

			}

			$queryC6 = "SELECT max_iscritti FROM proposte WHERE giorno=6 AND accettata=1 AND id_att=$att6" ;
			$resultC6 = $conn->query($queryC6);
			while ($rowC6 = $resultC6->fetch_array()) {
			  $max_iscrittiC6 = $rowC6['max_iscritti'];
			  $query6 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att6=$att6 AND accettata=1 AND s.att6=p.id_att AND p.giorno=6";
			  $result6 = $conn->query($query6);
			  $conteggio6 = $result6->fetch_object()->conteggio ;
			}

			mysqli_free_result($resultC6);
			mysqli_free_result($result6);

				if($conteggio4 < $max_iscrittiC4 && $conteggio5 < $max_iscrittiC5 && $conteggio6 < $max_iscrittiC6) {

					$sqlUpdateS4 = "UPDATE scelte SET att4=" . $att4 . " WHERE id_utente=" . $_SESSION['id'];
					if ($conn->query($sqlUpdateS4) === TRUE) {
					 //   echo "Scelte effettuate con successo!";
					} else {
					  echo "Errore S4: " . $conn->error;
					}

					$sqlUpdateS5 = "UPDATE scelte SET att5=" . $att5 . " WHERE id_utente=" . $_SESSION['id'];
					if ($conn->query($sqlUpdateS5) === TRUE) {
					 //   echo "Scelte effettuate con successo!";
					} else {
					  echo "Errore S5: " . $conn->error;
					}

					$sqlUpdateS6 = "UPDATE scelte SET att6=" . $att6 . " WHERE id_utente=" . $_SESSION['id'];
					if ($conn->query($sqlUpdateS6) === TRUE) {
					 //   echo "Scelte effettuate con successo!";
					} else {
					  echo "Errore S6: " . $conn->error;
					}

					echo "<script>window.location='index.php?page=giornata3';</script>";
				} else {
					echo "<script>window.location='index.php?page=giornata2&msg=202';</script>";
				}


		} else if ($_GET['g'] == 3) {

			$att7 = $_POST['7'];
			$att8 = $_POST['8'];
			$att9 = $_POST['9'];

			if($att7 == $att8) {

			  $queryC7 = "SELECT max_iscritti FROM proposte WHERE giorno=7 AND accettata=1 AND id_att=$att7" ;
			  $resultC7 = $conn->query($queryC7);
			  while ($rowC7 = $resultC7->fetch_array()) {
			    $max_iscrittiC7 = $rowC7['max_iscritti'];
			    $query7 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att7=$att7 AND accettata=1 AND s.att7=p.id_att AND p.giorno=7";
			    $result7 = $conn->query($query7);
			    $conteggio7 = $result7->fetch_object()->conteggio;
			  }

			  $max_iscrittiC8 = $max_iscrittiC7;
			  $resultC8 = $resultC7;
			  $result8 = $result7;

			  mysqli_free_result($resultC7);
			  mysqli_free_result($result7);

			} else {

			  $queryC7 = "SELECT max_iscritti FROM proposte WHERE giorno=7 AND accettata=1 AND id_att=$att7" ;
			  $resultC7 = $conn->query($queryC7);
			  while ($rowC7 = $resultC7->fetch_array()) {
			    $max_iscrittiC7 = $rowC7['max_iscritti'];
			    $query7 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att7=$att7 AND accettata=1 AND s.att7=p.id_att AND p.giorno=7";
			    $result7 = $conn->query($query7);
			    $conteggio7 = $result7->fetch_object()->conteggio ;
			  }

			  mysqli_free_result($resultC7);
			  mysqli_free_result($result7);

			  $queryC8 = "SELECT max_iscritti FROM proposte WHERE giorno=8 AND accettata=1 AND id_att=$att8" ;
			  $resultC8 = $conn->query($queryC8);
			  while ($rowC8 = $resultC8->fetch_array()) {
			    $max_iscrittiC8 = $rowC8['max_iscritti'];
			    $query8 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att8=$att8 AND accettata=1 AND s.att8=p.id_att AND p.giorno=8";
			    $result8 = $conn->query($query8);
			    $conteggio8 = $result8->fetch_object()->conteggio ;
			  }

			  mysqli_free_result($resultC8);
			  mysqli_free_result($result8);

			}

			$queryC9 = "SELECT max_iscritti FROM proposte WHERE giorno=9 AND accettata=1 AND id_att=$att9" ;
			$resultC9 = $conn->query($queryC9);
			while ($rowC9 = $resultC9->fetch_array()) {
			  $max_iscrittiC9 = $rowC9['max_iscritti'];
			  $query9 = "SELECT count(*) as conteggio FROM scelte s,proposte p WHERE s.att9=$att9 AND accettata=1 AND s.att9=p.id_att AND p.giorno=9";
			  $result9 = $conn->query($query9);
			  $conteggio9 = $result9->fetch_object()->conteggio ;
			}

			mysqli_free_result($resultC9);
			mysqli_free_result($result9);

				if ($conteggio7 < $max_iscrittiC7 && $conteggio8 < $max_iscrittiC8 && $conteggio9 < $max_iscrittiC9) {

					$sqlUpdateS7 = "UPDATE scelte SET att7=" . $att7 . " WHERE id_utente=" . $_SESSION['id'];
					if ($conn->query($sqlUpdateS7) === TRUE) {
					 //   echo "Scelte effettuate con successo!";
					} else {
					  echo "Errore S7: " . $conn->error;
					}

					$sqlUpdateS8 = "UPDATE scelte SET att8=" . $att8 . " WHERE id_utente=" . $_SESSION['id'];
					if ($conn->query($sqlUpdateS8) === TRUE) {
					 //   echo "Scelte effettuate con successo!";
					} else {
					  echo "Errore S8: " . $conn->error;
					}

					$sqlUpdateS9 = "UPDATE scelte SET att9=" . $att9 . " WHERE id_utente=" . $_SESSION['id'];
					if ($conn->query($sqlUpdateS9) === TRUE) {
					 //   echo "Scelte effettuate con successo!";
					} else {
					  echo "Errore S9: " . $conn->error;
					}

					//iscrizione completata
					echo "<script>window.location='index.php?page=profilo&status=1';</script>";

				} else {
					echo "<script>window.location='index.php?page=giornata3&msg=202';</script>";
				}


		} else {
			echo "<script>window.location='index.php?page=iscrizioneAll';</script>";
		}
	} else {
		echo "<script>window.location='index.php?page=iscrizioneAll';</script>";
	}
} else {
	echo "<script>window.location='login.php?location=iscrizioneAll';</script>";
} ?>
