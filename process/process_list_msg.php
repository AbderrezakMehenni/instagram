<?php
require_once('utils/db-connect.php');
session_start();
$idUserValue = $_SESSION['id_user'];

$queryUsersMessages="SELECT DISTINCT u.id_user, u.pseudo
                    FROM users u
                    INNER JOIN messages m ON u.id_user = m.id_user_send
                    WHERE m.id_user = :userId";

$stmtUsersMessages = $db->prepare($queryUsersMessages);
$stmtUsersMessages->bindParam(':userId', $userId, PDO::PARAM_INT); // Remplacez $userId par l'ID de l'utilisateur actuel
$stmtUsersMessages->execute();

$usersMessages = $stmtUsersMessages->fetchAll(PDO::FETCH_ASSOC);
?>