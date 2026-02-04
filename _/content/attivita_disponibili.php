<?php
if ($_SESSION['comm'] != 1 && $_SESSION['aiuto'] != 1){
			header ("Location: login.php?level=comm&location=vediScelte");
		}
		?>
		<div class='jumbotron text-center jumbotron-fluid'><span id="scritto">Vedi iscritti attività</span></div>
		<div class="page_text">

            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 2";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                        
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att2" . "= $id_att";
                        $max =  $row["max_iscritti"];
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                        $diff = $max - $numero_iscritti;
                        echo "<h1> id: $id_att, max:" . $row['max_iscritti'] . " , isc: " . $numero_iscritti . "diff: $diff" . "</h1>";
                        if ($numero_iscritti < $row["max_iscritti"] ) {
                            $query_inserisci = "INSERT INTO attivita_disponibili (id_att, posti_disponibili, giorno) values ($id_att, $diff, $data_attivita)";
                            echo "<h1> $query_inserisci </h1>";
                            $resultInserisci = $conn->query($query_inserisci);
                        }
                    
                    }?>
                    </div> </div>
             

