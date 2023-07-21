<?php

session_start();

require_once('utils/db-connect.php');

/* ** Récupère tous les posts d'un utilisateur.
* */
function getPosts() {
    global $db;

    $sql='SELECT p.id_post, p.photo, p.description, p.date_heure, u.id_user, u.pseudo, u.avatar
          FROM posts p
          INNER JOIN users u ON p.id_user = u.id_user
          WHERE p.id_user = :id_user';

    $request = $db->prepare($sql);
    $request->bindParam(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
    $request->execute();

    return $request->fetchAll(PDO::FETCH_ASSOC);
}

?>
