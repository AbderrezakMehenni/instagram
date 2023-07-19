<?php

session_start();

require_once('utils/db-connect.php');

/* ** Récupère tous les posts d'un utilisateur.
* */
function getPosts() {
    global $db;

    $sql = 'SELECT id_post, photo FROM posts WHERE id_user = :user;';

    $request = $db->prepare($sql);
    $request->bindParam(':user', $_SESSION['id_user'], PDO::PARAM_INT);
    $request->execute();

    return $request->fetchAll(PDO::FETCH_ASSOC);
}

?>
