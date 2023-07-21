<?php

session_start();

if (count($_SESSION) === 0) header('Location:index.php');

include('partials/header.php');

require_once('process/process_search.php');

?>
<section class="container">

    <!-- Search form -->
    <div class="row">
        <div class="col-6 mx-auto">
            <form action="search.php" method="get">
                <div class="input-group flex-nowrap m-5">
                    <label for="search" class="input-group-text d-none">Votre recherche :</label>
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Rechercher" aria-label="search-field">
                    <input type="submit" class="form-control text-white bg-primary" value="Rechercher">
                </div>
            </form>
        </div>
    </div>

    <!-- Search result -->
    <div class="row">
<?php
// Exécute la fonction search() si $_GET n'est pas vide
if (count($_GET) > 0) {
    $results = search();

    if ($results['status'] === 0) {
        echo '<p>Résultat pour "' . htmlspecialchars($_GET['search']) . '" : </p>';

        echo '<p>Utilisateurs <span class="badge rounded-pill bg-primary">' . count($results['users']) . '</span>:</p>';

        foreach($results['users'] as $user) {
            include('partials/search_results_user.php');
        }

        echo '<p>Posts <span class="badge rounded-pill bg-primary">' . count($results['posts']) . '</span>:</p>';

        foreach($results['posts'] as $post) {
            include('partials/search_results_post.php');
        }

        echo '<p>Tags <span class="badge rounded-pill bg-primary">' . count($results['tags']) . '</span>:</p>';

        foreach($results['tags'] as $tag) {
            include('partials/search_results_tag.php');
        }

    } else {
        echo '<div><p class="mx-auto">' . $results['message'] . '</p></div>';
    }
}
?>
    </div>
</section>

<?php

include('partials/navbar.php');

?>
