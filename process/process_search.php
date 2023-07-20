<?php

require_once('utils/db-connect.php');

/* ** */
function searchUsers($search) {
    global $db;

    $sql = 'SELECT * FROM users WHERE pseudo LIKE :search';

    $request = $db->prepare($sql);
    $request->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $request->execute();

    return $request->fetchAll();
}

/* ** */
function searchPosts($search) {
    global $db;

    $sql = 'SELECT * FROM posts WHERE description LIKE :search';

    $request = $db->prepare($sql);
    $request->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $request->execute();

    return $request->fetchAll();
}

/* ** */
function searchTags($search) {
    global $db;

    $sql = 'SELECT * FROM tags WHERE tag LIKE :search';

    $request = $db->prepare($sql);
    $request->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    $request->execute();

    return $request->fetchAll();
}

/* ** Vérifie que le champ de recherche exite et n'est pas vide.
* Si le champ n'est pas vide, éxécute la recherche sur diférentes tables de la base de données.
* La recherche se fait sur les utilisateurs, les tags et les posts.
* */
function search() {
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $users = searchUsers(htmlspecialchars($_GET['search']));
        $posts = searchPosts(htmlspecialchars($_GET['search']));
        $tags = searchTags(htmlspecialchars($_GET['search']));

        $result = [
            'status' => 0,
            'users' => $users,
            'posts' => $posts,
            'tags' => $tags
        ];

        return $result;
    } else {
        $result = [
            'status' => 31,
            'message' => 'Le champs de recherche est vide.'
        ];

        return $result;
    }
}

?>
