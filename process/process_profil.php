<?php

session_start();

require_once('utils/db-connect.php');

/* ** Récupère tous les posts d'un utilisateur.
* */
function getPosts() {
    global $db;

    /*$sql='SELECT p.id_post, p.photo, p.description, p.date_heure, u.id_user, u.pseudo, u.avatar
          FROM users u
          JOIN posts p ON p.id_user = u.id_user
          WHERE p.id_user = :id_user';*/

    $userSQL = 'SELECT * FROM users WHERE id_user = :id_user';
    $postsSQL = 'SELECT * FROM posts WHERE id_user = :id_user';

    $ifGetExist = (isset($_GET['user']) && !empty($_GET['user']));
    $user = $ifGetExist?$_GET['user']:$_SESSION['id_user'];

    $requestUser = $db->prepare($userSQL);
    $requestUser->bindParam(':id_user', $user, PDO::PARAM_INT);
    $requestUser->execute();
    $currentUser = $requestUser->fetch(PDO::FETCH_ASSOC);

    $requestPosts = $db->prepare($postsSQL);
    $requestPosts->bindParam(':id_user', $user, PDO::PARAM_INT);
    $requestPosts->execute();
    $posts = $requestPosts->fetchAll(PDO::FETCH_ASSOC);

    return [
        'user' => $currentUser,
        'posts' => $posts
    ];
}

?>
