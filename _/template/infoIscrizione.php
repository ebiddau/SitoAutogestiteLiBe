<h3>Dati personali</h3><br>
<table class="table">
  <thead>
    <tr>
      <th>Nome</th>
      <th>Cognome</th>
      <th>Classe</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?php echo $_SESSION['nome']; ?></td>
      <td><?php echo $_SESSION['cognome']; ?></td>
      <td><?php echo $_SESSION['classe']; ?></td>
    </tr>
  </tbody>
</table>

<div style="background-color: #ffffcc; color: #333; padding: 10px; border-radius: 8px; margin-left: 10px;">
  <h2>Leggere con attenzione!</h2>
  <p>Per scegliere un'attività, clicca il pallino corrispondente. In cima alla lista delle attività apparirà il numero
    di allievi iscritti e il massimo consentito. <span style="color:#f20000;">Se non puoi selezionare un'attività vuol
      dire che è già piena.</span></p>
  <br>
  <p>Quando si clicca il pulsante "Avanti" le scelte per quella giornata saranno registrate, quindi fai attenzione a
    cosa scegli!</p>
</div><br>

<h3>Sei un allievo relatore?</h3>
<p>Iscriviti alla tua attività. Se non vi fossero più posti disponibili, <a target="_blank" href="index.php?page=contatti">contattaci</a>.</p><br>
<!--
<h3>Vuoi dare una mano durante le giornate?</h3>
Significa che ti verrà assegnato un ruolo e dovrai venire alle riunioni. Scrivi un'e-mail a autogestite.libe@gmail.com solo se ne sei assolutamente convinto.<br><br>
-->
<p>Per qualsiasi problema non esitare, <a class="button" target="_blank" href="index.php?page=contatti">Contattaci!</a>
</p>

<?php
if (!isset($_SESSION['nomiPercorsi'])) {
  $queryPercorso = "SELECT nome, colore FROM percorsi WHERE attivato=1";
  $resultPercorso = $conn->query($queryPercorso);

  $i = 0;
  while ($rowPercorso = $resultPercorso->fetch_assoc()) {
    $_SESSION['nomiPercorsi'][$i] = $rowPercorso['nome'];
    $_SESSION['coloriPercorsi'][$i] = $rowPercorso['colore'];
    $i++;
  }

  mysqli_free_result($resultPercorso);
}
?>
<hr>
<h3>Percorsi culturali</h3>
<p>Abbiamo raggruppato in categorie le attività che trattano temi simili. Ognuna ha il suo colore:</p><br>
<table class="table">
  <thead>
    <tr>
      <th>Colore</th>
      <th>Tema</th>
    </tr>
  </thead>
  <tbody>
    <?php
    for ($x = 0; $x < count($_SESSION['nomiPercorsi']); $x++) {
    ?>
      <tr>
        <td><img width='15px' height='15px' src='img/colori/<?php echo $_SESSION['coloriPercorsi'][$x] ?>.png'></td>
        <td><?php echo $_SESSION['nomiPercorsi'][$x]; ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>
<br><br>