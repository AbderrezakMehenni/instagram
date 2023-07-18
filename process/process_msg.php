<?php
    require_once('../utils/db-connect.php');

    $UserId = 1;
    $query="SELECT users.id_user, users.pseudo, messages.id_user_send, messages.content
            FROM messages
            INNER JOIN users ON users.id_user = messages.id_user_send
            WHERE messages.id_user = $UserId";

    global $db;
    
    $result = $db->query($query);

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "Message de ".$row["pseudo"].": <br>";
        echo $row["content"]."</br>";
    }
} else {
    echo "Aucun message privé trouvé.";
}