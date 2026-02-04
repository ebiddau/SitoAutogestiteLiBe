<?php 




$sql = "SELECT id_utente FROM scelte WHERE att1 IS NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id_att = $row["id_utente"];

        // Seleziona un'attività casuale con posti disponibili
        $sql_att = "SELECT id_att FROM attivita_disponibili WHERE posti_disponibili > 0 and giorno = 1 ORDER BY RAND() LIMIT 1";
        $result_att = $conn->query($sql_att);

        if ($result_att->num_rows > 0) {
            $att = $result_att->fetch_assoc();
            $id_attivita = $att['id_att'];

            // Aggiorna la tabella 'scelte' assegnando l'attività
            $update_scelte = "UPDATE scelte SET id_att = $id_attivita WHERE id = $id_scelta";
            $conn->query($update_scelte);

            // Decrementa i posti disponibili
            $update_posti = "UPDATE attivita_disponibili SET posti_disponibili = posti_disponibili - 1 WHERE id_att = $id_attivita";
            $conn->query($update_posti);
        }
    }
}

// Chiude la connessione
$conn->close();

echo "Aggiornamento completato!";




?>
