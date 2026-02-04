<?php
if (!isset($_SESSION['username'])){
	header ("Location: login.php?location=generaPassword");
} ?>
<div class='jumbotron text-center jumbotron-fluid'>Password assenze</div>

<style>
table {
	page-break-inside:auto
}

tr {
	page-break-inside:avoid;
	page-break-after:auto;
}

td {
	border: 1px solid black;
	padding: 4px;
}

@media print {
    table { page-break-inside:auto }
	tr    { page-break-inside:avoid; page-break-after:auto }
}
</style>

<div class="page_text">
	<div id="non-printable">
		<form action="index.php?page=generaPassword" method="POST">
			<select name="giorno" required>
				<option value="">Scegli il giorno</option>
				<option value="1"><?php echo $_SESSION['giorni'][1]; ?></option>
				<option value="2"><?php echo $_SESSION['giorni'][2]; ?></option>
				<option value="3"><?php echo $_SESSION['giorni'][3]; ?></option>
				<option value="4"><?php echo $_SESSION['giorni'][4]; ?></option>
				<option value="5"><?php echo $_SESSION['giorni'][5]; ?></option>
				<option value="6"><?php echo $_SESSION['giorni'][6]; ?></option>
				<option value="6"><?php echo $_SESSION['giorni'][7]; ?></option>
				<option value="6"><?php echo $_SESSION['giorni'][8]; ?></option>
				<option value="6"><?php echo $_SESSION['giorni'][9]; ?></option>
			</select>
			<input type="submit" value="Visualizza" name="invia">

			<a class="button" onclick="window.print();">Stampa</a>
		</form>
	</div>

	<?php if (isset($_POST['invia'])) {
		$queryList = "SELECT id_att FROM proposte WHERE accettata=1 AND id_att > 0 AND giorno=" . $_POST['giorno'];
		$resultList = $conn->query($queryList);

		echo "<br><h3>" . $_SESSION['giorni'][$_POST['giorno']] . "</h3><table>";

		while($rowList = $resultList->fetch_assoc()) {
			echo "
			<tr><td>ID attività</td><td>Codice</td></tr>
			<tr><td>" . $rowList['id_att'] . "</td><td>" . substr(sha1($rowList['id_att']), 0, 9) . "</td></tr>
			<tr style='height:30px'><colspan='2'></tr>";
		}

		echo "</table>";
		mysqli_free_result($resultList);
	} ?>
</div>
