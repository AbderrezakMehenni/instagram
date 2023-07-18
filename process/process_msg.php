<?php
require_once('utils/db-connect.php');
session_start();
$pseudoValue = $_SESSION['pseudo'];

$queryUserId = "SELECT id_user FROM users WHERE pseudo = :pseudo";
$stmtUserId = $db->prepare($queryUserId);
$stmtUserId->bindParam(':pseudo', $pseudoValue, PDO::PARAM_STR);
$stmtUserId->execute();

$resultUserId = $stmtUserId->fetch(PDO::FETCH_ASSOC);
if ($resultUserId !== false && !empty($resultUserId["id_user"])) {
    $userId = $resultUserId["id_user"];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['message']) && !empty($_POST['message'])) {
            $messageContent = $_POST['message'];
            $date_heure = date('Y-m-d H:i:s');

            $queryInsertMessage="INSERT INTO messages (id_user, id_user_send, date_heure, content) 
                                VALUES (:userId, :userIdSend, :dateHeure, :content)
                                ON DUPLICATE KEY UPDATE content = :content, date_heure = :dateHeure";
            $stmtInsertMessage = $db->prepare($queryInsertMessage);
            $stmtInsertMessage->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmtInsertMessage->bindParam(':userIdSend', $userId, PDO::PARAM_INT);
            $stmtInsertMessage->bindParam(':dateHeure', $date_heure, PDO::PARAM_STR);
            $stmtInsertMessage->bindParam(':content', $messageContent, PDO::PARAM_STR);
            $stmtInsertMessage->execute();

            header('Location: msg.php');
            exit();
        }
    }
}
?>