<?php
if ($_SESSION['comm'] != 1){
	header ("Location: login.php?level=comm&location=modificaAnnunci");
}

if(isset($_POST['submit'])){
		$sql = "UPDATE news SET long_desc='".$_POST["long_desc"]."'";
		if ($conn->query($sql) === TRUE) {
		 //   echo "Scelte effettuate con successo!";
		} else {
			echo "Errore S1: " . $conn->error;
		}
}

$result = $conn->query("SELECT long_desc FROM news");
$row = $result->fetch_object();
$long_desc = $row->long_desc;

?>

<div class='jumbotron text-center jumbotron-fluid'>
<span id='scritto'>Modifica gli annunci</span>
</div>
<div class="page_text">

	<form method='post' action=''>
		<textarea id='long_desc' name='long_desc' ><?php echo $long_desc; ?></textarea><br>

		<input type="submit" name="submit" value="Invia">
	</form>
</div>

	<!-- Script -->
	<script src="js/ckeditor/ckeditor.js" ></script>
	<script type="text/javascript">

	CKEDITOR.replace('long_desc',{

	  width: "100%",
	  height: "200px",

	});

	</script>
