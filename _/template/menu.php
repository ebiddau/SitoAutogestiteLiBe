<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top"><?php
	if (isset($_GET['page'])) {
		$loc = $_GET['page'];
	} else if (isset($_GET['location'])) {
		$loc = $_GET['location'];
	} else {
		$loc = "home";
	}

		// Verifico se le proposte sono aperte. User� dopo nel codice la variabile 'abilitata' (che pu� assumere valore 0 e 1)
	$queryOn = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiProposte'");
	$resultOn = $queryOn->fetch_object();
	$proposteAbilitate = $resultOn->abilitata;

	$queryOn2 = $conn->query("SELECT * FROM funzioni WHERE funzione = 'permettiFeedback'");
	$resultOn2 = $queryOn2->fetch_object();
	$feedbackAbilitato = $resultOn2->abilitata;
	?>


	<a class="navbar-brand" href="index.php">Autogestite LiBe</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="myNavbar">
		<ul class="navbar-nav ml-auto">
			<?php

			if ($_SESSION['admin'] == 1) { ?>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" <?php if (in_array($loc, ["accettaProposte", "displayProposte", "generaPassword", "gestioneFunzioni", "iscrizioneComm", "listaProposte", "modificaPercorsi", "modificaScelte", "resetAssenze", "resetTotaleAssenze", "resetScelte", "tecnici", "resetTotaleScelte", "vediAssenze", "vediScelte"])) echo "style='color: #000000'"; ?>>Tools Pro</a>
					<ul class="dropdown-menu">

						<li class="nav-item dropdown">
							<a class="dropdown-item dropdown-toggle" <?php if ($loc == "resetAssenze" || $loc == "resetTotaleAssenze" || $loc == "vediAssenze") echo "style='color: #000000'"; ?>>Assenze</a>
							<ul class="dropdown-menu">

								<li><a class="dropdown-item" <?php if ($loc == "resetAssenze") echo "style='color: #000000' "; ?>href="index.php?page=resetAssenze">Reset assenze</a></li>
								<li><a class="dropdown-item" <?php if ($loc == "resetTotaleAssenze") echo "style='color: #000000' "; ?>href="index.php?page=resetTotaleAssenze">Reset totale assenze</a></li>
								<li><a class="dropdown-item" <?php if ($loc == "vediAssenze") echo "style='color: #000000' "; ?>href="index.php?page=vediAssenze">Vedi assenze</a></li>

							</ul>
						</li>

						<li><a class="dropdown-item" <?php if ($loc == "displayProposte") echo "style='color: #000000' "; ?>href="index.php?page=displayProposte">Display proposte</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "gestioneFunzioni") echo "style='color: #000000' "; ?>href="index.php?page=gestioneFunzioni">Gestione funzioni</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "iscrizioneComm") echo "style='color: #000000' "; ?>href="index.php?page=iscrizioneComm">Iscrizione commissione</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "liste") echo "style='color: #000000' "; ?>href="index.php?page=liste">Liste</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "modificaAnnunci") echo "style='color: #000000' "; ?>href="index.php?page=modificaAnnunci">Modifica annunci</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "modificaPercorsi") echo "style='color: #000000' "; ?>href="index.php?page=modificaPercorsi">Modifica percorsi</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "listaProposte") echo "style='color: #000000' "; ?>href="index.php?page=listaProposte">Modifica proposte</a></li>

						<li><a class="dropdown-item" <?php if ($loc == "accettaProposte") echo "style='color: #000000' "; ?>href="index.php?page=accettaProposte">Accetta proposte</a></li>

						<li class="nav-item dropdown">
							<a class="dropdown-item dropdown-toggle" data-toggle="dropdown" <?php if ($loc == "modificaScelte" || $loc == "resetScelte" || $loc == "resetTotaleScelte" || $loc == "vediScelte") echo "style='color: #000000'"; ?>>Scelte</a>
							<ul class="dropdown-menu">

								<li><a class="dropdown-item" <?php if ($loc == "modificaScelte") echo "style='color: #000000' "; ?>href="index.php?page=modificaScelte">Modifica scelte</a></li>
								<li><a class="dropdown-item" <?php if ($loc == "resetScelte") echo "style='color: #000000' "; ?>href="index.php?page=resetScelte">Reset scelte</a></li>
								<li><a class="dropdown-item" <?php if ($loc == "resetTotaleScelte") echo "style='color: #000000' "; ?>href="index.php?page=resetTotaleScelte">Reset totale scelte</a></li>
								<li><a class="dropdown-item" <?php if ($loc == "vediScelte") echo "style='color: #000000' "; ?>href="index.php?page=vediScelte">Vedi scelte</a></li>

							</ul>
						</li>
						<li><a class="dropdown-item" <?php if ($loc == "tecnici") echo "style='color: #000000' "; ?>href="index.php?page=tecnici">Supporto tecnico</a></li>

					</ul>
				</li><?php

						}
						if ($_SESSION['comm'] == 1) { ?>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" <?php if (in_array($loc, ["accettaProposte", "listaProposte", "modificaPercorsi", "modificaScelte", "tecnici", "vediAssenze", "vediScelte", "liste"])) echo "style='color: #000000'"; ?>>Tools Plus</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" <?php if ($loc == "modificaScelte") echo "style='color: #000000' "; ?>href="index.php?page=modificaScelte">Modifica scelte</a>
						<a class="dropdown-item" <?php if ($loc == "inserisciAssenze") echo "style='color: #000000' "; ?>href="index.php?page=inserisciAssenze">Inserisci assenze</a>
						<a class="dropdown-item" <?php if ($loc == "modificaAnnunci") echo "style='color: #000000' "; ?>href="index.php?page=modificaAnnunci">Modifica annunci</a>
						<a class="dropdown-item" <?php if ($loc == "liste") echo "style='color: #000000' "; ?>href="index.php?page=liste">Liste</a>
						<a class="dropdown-item" <?php if ($loc == "vediAssenze") echo "style='color: #000000' "; ?>href="index.php?page=vediAssenze">Vedi assenze</a>
						<a class="dropdown-item" <?php if ($loc == "vediScelte") echo "style='color: #000000' "; ?>href="index.php?page=vediScelte">Vedi scelte</a>
						<a class="dropdown-item" <?php if ($loc == "tabella_scelte") echo "style='color: #000000' "; ?>href="index.php?page=tabella_scelte">Vedi iscritti attività</a>
						<a class="dropdown-item" <?php if ($loc == "attivita_cambiare") echo "style='color: #000000' "; ?>href="index.php?page=attivita_cambiare">Vedi att per iscrivere</a>

					</div>
				</li><?php

						}
					/*	if ($_SESSION['aiuto'] == 1) { ?>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" data-toggle="dropdown" <?php if (in_array($loc, ["accettaProposte", "listaProposte", "modificaPercorsi", "modificaScelte", "tecnici", "vediAssenze", "vediScelte", "liste"])) echo "style='color: #000000'"; ?>>Tools</a>
					<div class="dropdown-menu">
						<a class="dropdown-item" <?php if ($loc == "tecnici") echo "style='color: #000000' "; ?>href="index.php?page=tecnici">Supporto tecnico</a>

					</div>
				</li>

			<?php } */ ?>

			<li class="nav-item"><a class="nav-link" <?php if ($loc == "home") echo "style='color: #000000' "; ?>href="index.php?page=home">Home</a></li>

			<li class="nav-item"><a class="nav-link" <?php if ($loc == "profilo") echo "style='color: #000000' "; ?>href="index.php?page=profilo">Profilo</a></li>

			<li class="nav-item"><a class="nav-link" <?php if ($loc == "iscrizioneAll" || $loc == "giornata1" || $loc == "giornata2" || $loc == "giornata3" || $loc == "giornata4" || $loc == "giornata5") echo "style='color: #000000' "; ?>href="index.php?page=iscrizioneAll">Iscrizione</a></li>

			<?php if ($proposteAbilitate == 1) { ?>
				<li class="nav-item"><a class="nav-link" <?php if ($loc == "proposta") echo "style='color: #000000' "; ?>href="index.php?page=proposta">Proposta attività</a></li>
			<?php } ?>

			<?php if ($feedbackAbilitato == 1) { ?>
				<li class="nav-item"><a class="nav-link" <?php if ($loc == "feedback") echo "style='color: #000000' "; ?>href="index.php?page=feedback">Feedback autogestite</a></li>
			<?php } ?>

			<li class="nav-item"><a class="nav-link" href='actions/catalogo.php'>Catalogo</a></li>

			<?php	/*
			}
			*/ ?>

			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" data-toggle="dropdown" <?php if ($loc == "galleria2015" || $loc == "galleria2016" || $loc == "galleria2017" || $loc == "galleria2018" || $loc == "galleria2019" || $loc == "galleria2020" || $loc == "galleria2021" || $loc == "galleria2022") echo "style='color: #000000'"; ?>>Galleria</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" <?php if ($loc == "galleria2024") echo "style='color: #000000' "; ?> href="index.php?page=galleria2025">2025</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2024") echo "style='color: #000000' "; ?> href="index.php?page=galleria2024">2024</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2023") echo "style='color: #000000' "; ?> href="index.php?page=galleria2023">2023</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2022") echo "style='color: #000000' "; ?> href="index.php?page=galleria2022">2022</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2021") echo "style='color: #000000' "; ?> href="index.php?page=galleria2021">2021</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2020") echo "style='color: #000000' "; ?> href="index.php?page=galleria2020">2020</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2019") echo "style='color: #000000' "; ?> href="index.php?page=galleria2019">2019</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2017") echo "style='color: #000000' "; ?> href="index.php?page=galleria2017">2017</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2016") echo "style='color: #000000' "; ?> href="index.php?page=galleria2016">2016</a>
					<a class="dropdown-item" <?php if ($loc == "galleria2015") echo "style='color: #000000' "; ?> href="index.php?page=galleria2015">2015</a>
				</div>
			</li>

			<li class="nav-item"><a class="nav-link" <?php if ($loc == "contatti") echo "style='color: #000000' "; ?>href="index.php?page=contatti">Contattaci</a></li>

		</ul>
		<?php if (isset($_SESSION['username'])) { ?>
			<a href="actions/closeSession.php" class="btn btn-primary" role="button" style="margin-left:10px">Logout</a>
		<?php } ?>
	</div>
</nav>

<main id="main">