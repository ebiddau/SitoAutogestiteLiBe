<?php
if (!isset($_SESSION['username'])){
	header ("Location: login.php?location=feedback");
}
?>

<div class='jumbotron text-center jumbotron-fluid non-printable'>Feedback autogestite</div>
<div class="page_text">

<?php

$queryOn = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiFeedback'");
$resultOn = $queryOn->fetch_object();
$abilitata = $resultOn->abilitata;

if ($abilitata == 1) {

  $user_id = $_SESSION['id'];
  $result = $conn->query("SELECT * FROM feedback WHERE id_utente = '$user_id'");
  if($result->num_rows == 0) {
  ?>

  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    $user_id = $_SESSION['id'];
    $commento = test_input($_POST['commento']);

    for ($i=1; $i<=9 ; $i++) {
      ${"votoatt" . $i} = test_input($_POST['votoatt' . $i]);
      if (${"votoatt" . $i} == "") {
        ${"votoatt" . $i} = 'NULL';
      }
    }
    $sqlUpdateVoti = "INSERT INTO feedback (id_utente, commento, votoatt1, votoatt2, votoatt3, votoatt4, votoatt5, votoatt6, votoatt7, votoatt8, votoatt9)
    VALUES ($user_id, '$commento', $votoatt1, $votoatt2, $votoatt3, $votoatt4, $votoatt5, $votoatt6, $votoatt7, $votoatt8, $votoatt9)";
    if ($conn->query($sqlUpdateVoti) === TRUE) {
     //   echo "Scelte effettuate con successo!";
    } else {
      echo "Errore: " . $conn->error;
    }
  }


  if (isset($_GET['status'])) {
  	if ($_GET['status'] == 1) {
  		echo "<div class='alert alert-success alert-dismissible alert-floating'><button type='button' class='close' data-dismiss='alert'>&times;</button>Le tue risposte sono state registrate correttamente!</div>";
  	}
  }


  ?>


  	<div class="col-md-12"><?php

  	$expgiorno1 = explode(" ", $_SESSION['giorni'][1]);
  	$expgiorno2 = explode(" ", $_SESSION['giorni'][2]);
  	$expgiorno3 = explode(" ", $_SESSION['giorni'][3]);
  	$expgiorno4 = explode(" ", $_SESSION['giorni'][4]);
  	$expgiorno5 = explode(" ", $_SESSION['giorni'][5]);
  	$expgiorno6 = explode(" ", $_SESSION['giorni'][6]);
  	$expgiorno7 = explode(" ", $_SESSION['giorni'][7]);
  	$expgiorno8 = explode(" ", $_SESSION['giorni'][8]);
  	$expgiorno9 = explode(" ", $_SESSION['giorni'][9]);

  	?><!--chiude non-printable-->
  		<?php


  	/////////////////////////// STUDENTE - VEDI SCELTE e ASSENZE /////////////////////////////////
  		if ($_SESSION['comm'] == 0 || $_SESSION['admin'] == 1) {

  			for ($i = 1; $i < 10; $i++) {

  				$query = "SELECT id_att, aula, timestamp, titolo FROM scelte s, proposte p WHERE s.id_utente = '" . $_SESSION['id'] . "' AND p.id_att=s.att" . $i;
  				$result = $conn->query($query);

  				$obj = $result->fetch_object();

  				$att[$i] = $obj->id_att;
  				$aula[$i] = $obj->aula;
  				$titolo[$i] = $obj->titolo;

  				if ($att[$i] == 0) {
  					$att[$i] = "Non iscritto";
  				}

  				if ($aula[$i] != "") {
  					$aula[$i] = " (aula " . $aula[$i] . ")";
  				}
  			}

  			$timestamp = $obj->timestamp;

  			mysqli_free_result($result); ?>

        <form method="POST" action="index.php?page=feedback&status=1">


          <h5>Cosa si potrebbe migliorare delle autogestite?</h5>
          <p><i>Scrivici consigli, critiche e suggerimenti!</i></p>
          <textarea class="form-control" name="commento" rows="5" cols="40"></textarea>
          <span style="font-size: 8px">Nota: Sono severamente vietate le critiche rivolte al supremo admin <i>urel</i>.</span>

          <br><br>

    			<h5>Valutazione attività</h5>
          <p><i>Dai un voto da 1 a 5 alle attività a cui hai partecipato. Se non hai partecipato ad una certa attività, lascia vuoto il relativo campo.</i></p>

  			  <br>

          <table class="table table-striped">
          <?php
          for ($i=1; $i<=9 ; $i++) {
            ${"expgiorno" . $i} = explode(" ", $_SESSION['giorni'][$i]);
            ?>
      			<tr>
      				<td><?php echo ${"expgiorno" . $i}[0] . " " . ${"expgiorno" . $i}[1] . " " . ${"expgiorno" . $i}[2] . " " . ${"expgiorno" . $i}[3] . ", " . ${"expgiorno" . $i}[4] . "<br>"; ?></td>
      				<td><?php echo "Attività " . $att[$i] . " <br><i> " . $titolo[$i] . "</i>"; ?></td>
              <td style="width: 30%">
                <div class="form-group">
                  <label for="<?php echo "votoAttivita" . $i; ?>">Voto (1: minimo; 5: massimo)</label>
                  <select class="form-control" id="<?php echo "votoAttivita" . $i; ?>" name="<?php echo "votoatt" . $i; ?>">
                    <option disabled selected value=""> -- seleziona un valore -- </option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                </div>
              </td>
      			</tr>
          <?php } ?>
        </table>

        <br><br>
        <input type="submit" name="submit" value="Invia" class="btn btn-primary btn-block">

        </form>


  		</div>
  		<div class="col-md-6 non-printable">

  	<?php
  	} else {
  		echo "Sei un membro della commissione: in quanto tale, del tuo feedback non ce ne frega una mazza.";
  	}
  } else {
    echo "Hai già lasciato un feedback.";
  }
  $conn->close();

} else {
	echo "Non è più possibile lasciare un feedback.";
}
?>
</div>
