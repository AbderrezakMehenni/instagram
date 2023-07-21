<?php
require_once('utils/db-connect.php');

// Récupère l'ID de l'utilisateur sélectionné depuis l'URL
if (isset($_GET['id_user'])) { 
    // Traiter le formulaire et enregistrer le message
if (isset($_POST['envoyer']) && isset($_POST['message'])) {
    $message = $_POST['message'];
    $id_user_send = $_SESSION['id_user']; // L'utilisateur actuel qui envoie le message
    $id_user_receive = $_GET['id_user']; // L'utilisateur sélectionné qui recevra le message
    // Requête pour insérer le message dans la table 'messages'
    $queryInsertMessage="INSERT INTO messages (id_user, id_user_send, content, date_heure)
                        VALUES (:id_user, :id_user_send, :content, NOW())";
    $stmtInsertMessage = $db->prepare($queryInsertMessage);
    $stmtInsertMessage->bindParam(':id_user', $id_user_receive, PDO::PARAM_INT);
    $stmtInsertMessage->bindParam(':id_user_send', $id_user_send, PDO::PARAM_INT);
    $stmtInsertMessage->bindParam(':content', $message, PDO::PARAM_STR);
    if ($stmtInsertMessage->execute()) {
        // Le message a été enregistré avec succès
        header('Location: msg.php?id_user='.$_GET['id_user'].'#basdepage'); // Rediriger vers la page avec la liste des messages
    } else {
        // Une erreur s'est produite lors de l'enregistrement du message
        echo "Erreur lors de l'enregistrement du message.";
    }
} else {
    // Redirige vers la page précédente si le formulaire n'a pas été soumis correctement
    // Vous pouvez supprimer cette partie si elle n'est pas nécessaire
    // header('Location: index.php?id_user=' . $_GET['id_user']);
}
    $selectedUserId = $_GET['id_user'];
    // Récupère le pseudo de l'utilisateur sélectionné
    $querySelectedUser = "SELECT pseudo FROM users WHERE id_user = :selectedUserId";
    $stmtSelectedUser = $db->prepare($querySelectedUser);
    $stmtSelectedUser->bindParam(':selectedUserId', $selectedUserId, PDO::PARAM_INT);
    $stmtSelectedUser->execute();
    $selectedUser = $stmtSelectedUser->fetch(PDO::FETCH_ASSOC);
    if ($selectedUser !== false) {
        $queryMessages = "SELECT m.content, m.date_heure, m.id_user, m.id_user_send, u.pseudo, u.avatar
            FROM messages m
            LEFT JOIN users u ON m.id_user_send = u.id_user
            WHERE (m.id_user = :id_user AND m.id_user_send = :selectedUserId) OR
                (m.id_user = :selectedUserId AND m.id_user_send = :id_user)
            ORDER BY m.date_heure";
        $stmtMessages = $db->prepare($queryMessages);
        $stmtMessages->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT); // Remplace $userId par l'ID de l'utilisateur actuel
        $stmtMessages->bindParam(':selectedUserId', $_GET['id_user'], PDO::PARAM_INT);
        $stmtMessages->execute();
        if ($stmtMessages->errorCode() !== '00000') {
            $errorInfo = $stmtMessages->errorInfo();
            echo "Erreur lors de l'exécution de la requête : " . $errorInfo[2];
        }
        $messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Redirige vers la page précédente si l'utilisateur sélectionné n'existe pas
        header('Location: list_msg.php');
    }
} else {
    // Redirige vers la page précédente si aucun utilisateur n'a été sélectionné
    header('Location: list_msg.php');
}
?>
