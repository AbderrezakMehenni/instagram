<?php

require_once('./utils/db-connect.php');
session_start();

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

        if ($request->rowCount() > 0) { // On test si l'utilisateur a deja liké le post
            $request = $database->prepare(
                'SELECT * 
                FROM likes 
                WHERE id_post = :post;
                INNER JOIN users ON likes.id_user = users.id_user'
            );
            $request->bindValue(':post', $postId, PDO::PARAM_INT);
            $request->execute();


            // var_dump($request);


            if ($request->rowCount() > 0) {
                $request = $database->prepare('DELETE FROM likes WHERE id_post = :post AND id_user = :id_user;'); // Si l'utilisateur a déjà liké, on supprime son like
            } else {
                $request = $database->prepare('INSERT INTO likes (id_post, id_user) VALUES (:post, :id_user);'); // Sinon, on ajoute un like
            }
            $userId = $_SESSION['id_user'];
            $request->bindValue(':post', $postId, PDO::PARAM_INT);
            $request->bindValue(':id_user', $userId, PDO::PARAM_INT);
            $request->execute();


            $request = $database->prepare('SELECT COUNT(*) AS total_likes FROM likes WHERE id_post = :post;'); // Récupérer le nombre total de likes pour ce post
            $request->bindValue(':post', $postId, PDO::PARAM_INT);
            $request->execute();

            $rawResponse = $request->fetch(PDO::FETCH_ASSOC); // Récupère la réponse

            echo json_encode($rawResponse); // Envoie la réponse au client (JavaScript)

        }
    }
}

getGoodResponse($db); // Appelle de la fonction getGoodResponse

