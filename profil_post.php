<?php
require_once('./process/process_profil.php');

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
    $postDetails = getPosts();

    if ($posts !== null) {
        // Affichage des détails du post
        foreach ($posts as $post) {
?>
            <article class="container">
                <div class="row">
                    <div class="d-flex user align-item-center">
                        <div class=" rounded-circle avatar d-flex align-items-center">
                            <?php echo '<img class="rounded-circle d-flex align-items-center img" src="' . $post['avatar'] . '" alt="Image">'; ?>
                        </div>
                        <div class="d-flex align-items-center">
                            <?php echo $post['pseudo']; ?>
                        </div>
                        <div>
                            <!-- burger -->
                        </div>
                    </div>
                </div>
                <div class="photo">
                    <?php echo '<img src="' . $post['photo'] . '" alt="Image">' ?>
                </div>
                <div>
                    <div>
                        <a href="../api.php?id=<?php echo $post['id_post']; ?>"><img src="../assets/svg/heart.svg" alt=""></a>
                    </div>
                    <div>
                        <!-- like -->
                    </div>
                    <div>
                        <?php echo '<p>' . $post['description'] . "</p>  <p>  " . $post['date_heure'] . '</p>'; ?>
                    </div>
                    <div>
                        <!-- commentaire des autres users (possibilité de liker un commentaire) -->
                    </div>
                </div>
            </article>
<?php
        }
    } else {
        echo "Le post avec l'id donné n'existe pas ou n'appartient pas à l'utilisateur actuel.";
    }
} else {
    echo "L'id du post n'a pas été spécifié dans l'URL";
}
?>