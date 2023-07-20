<?php
require_once('utils/db-connect.php');
session_start();
$idUserValue = $_SESSION['id_user'];

// Sélectionne le pseudo et l'id pour afficher ses messages
$queryUsersMessages="SELECT DISTINCT u.id_user, u.pseudo, u.avatar
                    FROM users u
                    INNER JOIN messages m ON u.id_user = m.id_user_send
                    WHERE m.id_user = :userId";

$stmtUsersMessages = $db->prepare($queryUsersMessages);
$stmtUsersMessages->bindParam(':userId', $idUserValue, PDO::PARAM_INT); // Remplace $userId par l'ID de l'utilisateur actuel
$stmtUsersMessages->execute();

$userMessages = $stmtUsersMessages->fetchAll(PDO::FETCH_ASSOC);
?>