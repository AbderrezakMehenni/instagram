<?php
require_once('utils/db-connect.php');
session_start();
$pseudoValue = $_SESSION['pseudo'];

// Récupère l'ID de l'utilisateur sélectionné depuis l'URL
if (isset($_GET['id_user'])) {
    $selectedUserId = $_GET['id_user'];

    // Récupère le pseudo de l'utilisateur sélectionné
    $querySelectedUser = "SELECT pseudo FROM users WHERE id_user = :selectedUserId";
    $stmtSelectedUser = $db->prepare($querySelectedUser);
    $stmtSelectedUser->bindParam(':selectedUserId', $selectedUserId, PDO::PARAM_INT);
    $stmtSelectedUser->execute();
    $selectedUser = $stmtSelectedUser->fetch(PDO::FETCH_ASSOC);

    if ($selectedUser !== false) {
        // Récupère tous les messages entre l'utilisateur actuel et l'utilisateur sélectionné
        $queryMessages="SELECT m.content, m.date_heure, u.pseudo AS sender
                        FROM messages m
                        INNER JOIN users u ON m.id_user_send = u.id_user
                        WHERE (m.id_user = :id_user AND m.id_user_send = :selectedUserId) OR
                            (m.id_user = :selectedUserId AND m.id_user_send = :id_user)
                        ORDER BY m.date_heure";

        $stmtMessages = $db->prepare($queryMessages);
        $stmtMessages->bindParam(':id_user', $pseudoValue, PDO::PARAM_INT); // Remplace $userId par l'ID de l'utilisateur actuel
        $stmtMessages->bindParam(':selectedUserId', $selectedUserId, PDO::PARAM_INT);
        $stmtMessages->execute();
        $messages = $stmtMessages->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Redirige vers la page précédente si l'utilisateur sélectionné n'existe pas
        header('Location: list_msg.php');
        exit();
    }
} else {
    // Redirige vers la page précédente si aucun utilisateur n'a été sélectionné
    header('Location: list_msg.php');
    exit();
}
