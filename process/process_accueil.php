<?php
require_once('./utils/db-connect.php');


$sql = "SELECT id_post, avatar, pseudo, photo, description, date_heure FROM posts
        JOIN follow ON follow.id_user_follow = posts.id_user
        JOIN users ON users.id_user = follow.id_user_follow
        WHERE follow.id_user = ?
        ORDER BY date_heure DESC"; // TU ES UN DINGUE 

$stmt = $db->prepare($sql);
$stmt->execute([
    $_SESSION['id_user']
]);
$postsfollow = $stmt->fetchAll(PDO::FETCH_ASSOC);  // on récupère toutes les lignes de la table users

var_dump($postsfollow);

?>