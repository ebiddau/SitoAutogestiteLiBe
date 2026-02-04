<?php
if ($_SESSION['comm'] == 1 || $_SESSION['aiuto'] == 1){
	header ("Location: ../login.php?level=comm");
}

require("../config/config.php");

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

<!DOCTYPE html>
<html>
<head>
	<title>Modifica le notizie</title>

	<!-- CSS -->
	<style type="text/css">
	.cke_textarea_inline{
		border: 1px solid black;
	}
	</style>

	<!-- CKEditor -->
	<script src="../js/ckeditor/ckeditor.js" ></script>
</head>
<body>

	<a href="index.php">Torna alla home</a><br><br>

	<form method='post' action=''>
		Modifica gli annunci:
		<textarea id='long_desc' name='long_desc' ><?php echo $long_desc; ?></textarea><br>

		<input type="submit" name="submit" value="Submit">
	</form>

	<!-- Script -->
	<script type="text/javascript">

	CKEDITOR.replace('long_desc',{

	  width: "500px",
	  height: "200px"

	});

	</script>
</body>
</html>
