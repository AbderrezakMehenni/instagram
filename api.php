<?php

require_once('./utils/db-connect.php');

function getGoodResponse($database) {
    $postIdIsOk = (isset($_GET['id']) && !empty($_GET['id'])); // Regarde que l'utilisateur a renseigné un id de post
    if ($postIdIsOk) { // Si l'utilisateur a renseigné un id de post
        $request = $database->prepare(
            'SELECT id_post
            FROM posts 
            WHERE id_post = :post;
            ');
        $request->bindValue(':post', $_GET['id'], PDO::PARAM_INT);
        $request->execute();

        $rawResponse = $request->fetch(PDO::FETCH_ASSOC); // Récupère la reponse de l'utilisateur

        echo json_encode($rawResponse); // Envoie la reponse de l'utilisateur

    // } if (isset($postIdIsOk) && !empty($postIdIsOk)) { // Si l'utilisateur n'a pas renseigné un id de post
    //     $request = $database->prepare(
    //         'INSERT id_post
    //         FROM likes 
    //         WHERE id_post = :likes;
    //         ');
    //     $request->bindValue(':likes', $_GET['id'], PDO::PARAM_INT);
    //     $request->execute();

    // } else {
    //     $request = $database->prepare(
    //         'DELETE id_post
    //         FROM likes 
    //         WHERE id_post = :likes;
    //         ');
    //     $request->bindValue(':likes', $_GET['id'], PDO::PARAM_INT);
    //     $request->execute();

    }
}

getGoodResponse($db); // Appelle de la fonction getGoodResponse

?>