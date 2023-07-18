<?php
    require_once('../utils/db-connect.php');

    $UserId = 1;
    $query="SELECT users.id_user, users.pseudo, messages.id_user_send
            FROM messages
            INNER JOIN users ON users.id_user = messages.id_user_send
            WHERE messages.id_user = $UserId";

    $result = $db->query($query);

    if ($result !== false && $result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "Message de " . $row["pseudo"] . ": <br>";
        }
    } else {
        echo "Aucun message privé trouvé.";
    }
