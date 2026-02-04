

<?php
if ($_SESSION['comm'] != 1 && $_SESSION['aiuto'] != 1){
			header ("Location: login.php?level=comm&location=vediScelte");
		}
		?>
		<div class='jumbotron text-center jumbotron-fluid'><span id="scritto">Vedi iscritti attività</span></div>
		<div class="page_text">

        <h1> <?php echo "$conn->error"?></h1>
   <h1> <?php print_r($_SESSION['giorni'][1])?> </h1s> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 1";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att1" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>

            <span> <?php print_r($_SESSION['giorni'][2])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE  giorno = 2";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att2" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][3])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 3";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att3" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][4])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 4";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att4" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][5])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 5";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att5" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][6])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 6";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att6" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][7])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE  giorno = 7";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att7" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][8])?> </span> <br>
            <p><div class = "tabella_scelte">
            
                <table>
                    <thead>
                        <tr>
                            <th>ID Attività</th>
                            <th>Titolo</th>
                            <th>Iscritti</th>
                            <th>Max Iscritti</th>
                            <th> Differenza </th>
                        </tr>
                    </thead>
                    <tbody>
                   
            <?php
                   ; ?>
            <?php

                        $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 8";
                        $resultProposte= $conn->query($queryProposte);  
                    
                    while ($row = $resultProposte->fetch_assoc()) {
                        $id_att = $row["id_att"];
                        $data_attivita = $row["giorno"]; 
                    
                        // Query per contare il numero di iscritti per questa attività in quel giorno
                        $queryIscritti = "SELECT * FROM scelte where att8" . "= $id_att";
                    
                        $resultIscritti = $conn->query($queryIscritti);
                        $numero_iscritti = $resultIscritti->num_rows;
                    
                        echo "<tr>";
                        echo "<td>" . $id_att . "</td>";
                        echo "<td>" . $row["titolo"] . "</td>";
                        echo "<td>" . $numero_iscritti . "</td>";
                        echo "<td>" . $row["max_iscritti"] . "</td>";
                        echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                        
                        echo "</tr>";
                    }?>
                    </tbody>
                </table>
                 
    </div></p>
            <span> <?php print_r($_SESSION['giorni'][9])?> </span>
            <p><div class = "tabella_scelte">
            
            <table>
                <thead>
                    <tr>
                        <th>ID Attività</th>
                        <th>Titolo</th>
                        <th>Iscritti</th>
                        <th>Max Iscritti</th>
                        <th> Differenza </th>
                    </tr>
                </thead>
                <tbody>
               
        <?php
               ; ?>
        <?php

                    $queryProposte = "SELECT id_att, titolo, max_iscritti, giorno FROM proposte WHERE giorno = 9";
                    $resultProposte= $conn->query($queryProposte);  
                
                while ($row = $resultProposte->fetch_assoc()) {
                    $id_att = $row["id_att"];
                    $data_attivita = $row["giorno"]; 
                
                    // Query per contare il numero di iscritti per questa attività in quel giorno
                    $queryIscritti = "SELECT * FROM scelte where att9" . "= $id_att";
                
                    $resultIscritti = $conn->query($queryIscritti);
                    $numero_iscritti = $resultIscritti->num_rows;
                
                    echo "<tr>";
                    echo "<td>" . $id_att . "</td>";
                    echo "<td>" . $row["titolo"] . "</td>";
                    echo "<td>" . $numero_iscritti . "</td>";
                    echo "<td>" . $row["max_iscritti"] . "</td>";
                    echo "<td>" . strval($row["max_iscritti"] -$numero_iscritti) . "</td>";
                    
                    echo "</tr>";
                }?>
                </tbody>
            </table>
             
</div></p> </div>