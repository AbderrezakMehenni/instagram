<?php

session_start();

require_once('../utils/db-connect.php');

/* ** Ajoute un nouveau post dans la base.
* 
* @param String $mediaName Le nom du fichier média (image, vidéo).
* @param String $description La description du post.
* @param Int $userId L'id d'un utilisateur.
*
* @return Boolean Retourne true si l'insert à réussi, false sinon.
* */
function createPost($mediaName, $description, $userId) {
    global $db;

    $sql = 'INSERT INTO posts (photo, description, date_heure, id_user) VALUES (:media, :description, NOW(), :user);';

    $request = $db->prepare($sql);

    $request->bindParam(':media', $mediaName, PDO::PARAM_STR);
    $request->bindParam(':description', $description, PDO::PARAM_STR);
    $request->bindParam(':user', $userId, PDO::PARAM_STR);

    $insertOk = $request->execute();

    return $insertOk;
}

/* ** 
* */
function getLastIdPost() {
    global $db;

    $sql = 'SELECT MAX(id_post) id FROM posts;';

    $request = $db->prepare($sql);

    $request->execute();

    $lastId = $request->fetch(PDO::FETCH_ASSOC);

    return $lastId['id'];

}

/* ** 
* */
function getLastIdTag() {
    global $db;

    $sql = 'SELECT MAX(id_tag) id FROM tags;';

    $request = $db->prepare($sql);

    $request->execute();

    $lastId = $request->fetch(PDO::FETCH_ASSOC);

    return $lastId['id'];

}

/* ** Ajoute un ou plusieurs tags dans la base.
* 
* @param Array $tags Un tableau de tags.
*
* @return Array Un tableau des derniers id des tags insérés.
* */
function createTags($tags) {
    global $db;

    $lastIds = [];

    foreach($tags as $tag) {
        $sql = 'INSERT INTO tags (tag) VALUES (:tag);';

        $request = $db->prepare($sql);

        $request->bindParam(':tag', $tag, PDO::PARAM_STR);

        $insertOk = $request->execute();

        if ($insertOk) {
            $lastIdTag = getLastIdTag();

            array_push($lastIds, $lastIdTag);
        }
    }

    return $lastIds;
}

/* ** Ajoute les liaisons entre les posts et les tags.
* 
* @param Int $post L'id d'un post.
* @param Array $tags Un tableau contenant les ids des derniers tags insérés.
*
* @return Boolean Retourne true si l'insert est un succès, false sinon.
* */
function createPostTags($post, $tags) {
    global $db;

    $insertOk = false;

    foreach($tags as $tag) {
        $sql = 'INSERT INTO post_tag (id_post, id_tag) VALUES (:post, :tag);';

        $request = $db->prepare($sql);

        $request->bindParam(':post', $post, PDO::PARAM_INT);
        $request->bindValue(':tag', $tag, PDO::PARAM_INT);

        $insertOk = $request->execute();
    }

    return $insertOk;
}

/* ** Gère globalement les insertions en base de données.
* 
* @param String $media Le nom de l'image du post.
* @param String $description La description du post.
* @param Array $tags Une liste de tags, liés au post.
* @param Int $user L'id d'un utilisateur connecté.
*
* @return Int Retourne 0 en cas de succés, un autre entier positif sinon.
* */
function dbInsertManager($media, $description, $tags, $user) {
    $postCreated = createPost(
        pathinfo($media, PATHINFO_BASENAME),
        $description,
        $user
    );

    if ($postCreated) {
        $lastPost = getLastIdPost();
        $idTagsCreated = createTags(explode(' ', $tags));

        if (count($idTagsCreated) > 0) {
            $postTagsCreated = createPostTags($lastPost, $idTagsCreated);

            if ($postTagsCreated) {
                return 0;
            } else {
                return 75;
            }
        } else {
            return 74;
        }
    } else {
        return 73;
    }
}

/* ** Gère l'ajout d'un nouveau post dans la base de données.
* Effectue une redirection, vers post.php en cas d'erreurs, vers profil.php en cas de succès.
* */
function createNewPost() {
    $validExtensions = ['jpg', 'jpeg', 'png', 'gif', 'svg'];
    $uploadDir = '../assets/images/';

    $mediaIsValid = (isset($_FILES['media']) && !empty($_FILES['media']));
    $descriptionIsValid = (isset($_POST['description']) && !empty($_POST['description']));
    $tagsIsValid = (isset($_POST['tags']) && !empty($_POST['tags']));

    if ($mediaIsValid && $descriptionIsValid && $tagsIsValid) {
        $targetFile = $uploadDir . basename($_FILES["media"]["name"]);

        if (in_array(pathinfo($targetFile, PATHINFO_EXTENSION), $validExtensions)) {
            $dbInsertStatus = dbInsertManager(
                $targetFile,
                htmlspecialchars($_POST['description']),
                htmlspecialchars($_POST['tags']),
                $_SESSION['id_user']
            );

            if ($dbInsertStatus === 0) {
                if (move_uploaded_file($_FILES["media"]["name"], $targetFile)) {
                    header('Location:../profil.php?newpost=true');
                } else {
                    header('Location:../post.php?newpost=false&status=76');
                }
            } else {
                header('Location:../post.php?newpost=false&status=' . $dbInsertStatus);
            }
        } else {
            header('Location:../post.php?newpost=false&status=72');
        }
    } else {
        header('Location:../post.php?newpost=false&status=71');
    }
}

// Si on reçoit des informations via $_POST.
if (count($_POST) > 0) {
    createNewPost();
}

?>
