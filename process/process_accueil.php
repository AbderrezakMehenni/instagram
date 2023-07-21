<?php
require_once('./utils/db-connect.php');


$sql = "SELECT id_post, avatar, pseudo, photo, description, date_heure 
        FROM posts
        INNER JOIN follow ON follow.id_user_follow = posts.id_user
        INNER JOIN users ON users.id_user = follow.id_user_follow
        WHERE follow.id_user = ?
        ORDER BY date_heure DESC"; // TU ES UN DINGUE 


$stmt = $db->prepare($sql);
$stmt->execute([
    $_SESSION['id_user']
]);
$postsfollow = $stmt->fetchAll(PDO::FETCH_ASSOC);  // on récupère toutes les lignes de la table users

$likes= "SELECT * 
        FROM likes 
        INNER JOIN posts ON likes.id_post = posts.id_post 
        WHERE likes.id_user = ?;";

$stmt = $db->prepare($likes);
$stmt->execute([
    $_SESSION['id_user']
]);
$likesfollow = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($likesfollow);

?>