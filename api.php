<?php
session_start();
require_once('./utils/db-connect.php');


function getGoodResponse($database)
{
    $postIdIsOk = (isset($_GET['id']) && !empty($_GET['id']));
    $postId = $_GET['id'];

    if ($postIdIsOk) { // Si l'utilisateur a renseigné un id de post
        $request = $database->prepare(
            'SELECT id_post
            FROM posts 
            WHERE id_post = :post;
            '
        );
        $request->bindValue(':post', $postId, PDO::PARAM_INT);
        $request->execute();

        $rawResponse = $request->fetch(PDO::FETCH_ASSOC); // Récupère la reponse de l'utilisateur

        // on vérifie si le post existe, et si il existe il me recherche les likes effectué sur ce post par un utilisateur
        $request = $database->prepare(
            'SELECT * 
                FROM likes 
                WHERE id_post = :post AND id_user = :id_user'
        );
        $request->bindValue(':post', $postId, PDO::PARAM_INT);
        $request->bindValue(':id_user', $_SESSION['id_user'], PDO::PARAM_INT);
        $request->execute();

        $usersLikes = $request->fetch(PDO::FETCH_ASSOC); // Récupère la reponse de l'utilisateur

        // var_dump($usersLikes);


        if ($usersLikes) {
            $status = "dislikes";
            $request = $database->prepare('DELETE FROM likes WHERE id_post = :post AND id_user = :id_user;'); // Si l'utilisateur a déjà liké, on supprime son like
        } else {
            $status = "likes";
            $request = $database->prepare('INSERT INTO likes (id_post, id_user) VALUES (:post, :id_user);'); // Sinon, on ajoute un like
        }
        $userId = $_SESSION['id_user'];
        $request->bindValue(':post', $postId, PDO::PARAM_INT);
        $request->bindValue(':id_user', $userId, PDO::PARAM_INT);
        $request->execute();


        // $request = $database->prepare('SELECT COUNT(*) AS total_likes FROM likes WHERE id_post = :post;'); // Récupérer le nombre total de likes pour ce post
        // $request->bindValue(':post', $postId, PDO::PARAM_INT);
        // $request->execute();

        // $rawResponse = $request->fetch(PDO::FETCH_ASSOC); // Récupère la réponse

        echo json_encode($status); // Envoie la réponse au client (JavaScript)

    }
}

if (isset($_GET['id'])) getGoodResponse($db); // Appelle de la fonction getGoodResponse

function getTotalLike($database)
{
    $postIdIsOk = (isset($_GET['post']) && !empty($_GET['post']));
    $postId = $_GET['post'];

    if ($postIdIsOk) {
        $request = $database->prepare('SELECT COUNT(*) AS total_likes FROM likes WHERE id_post = :post;'); // Récupérer le nombre total de likes pour ce post
        $request->bindValue(':post', $postId, PDO::PARAM_INT);
        $request->execute();

        $rawResponse = $request->fetch(PDO::FETCH_ASSOC); // Récupère la réponse

    }

    echo json_encode($rawResponse); // Envoie la réponse au client (JavaScript)

}

if (isset($_GET['post'])) getTotalLike($db); // Appelle de la fonction getGoodResponse
