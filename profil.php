<?php

require_once('process/process_profil.php');

if (count($_SESSION) === 0) header('Location:index.php');

if (isset($_GET['logout'])) {
    unset($_SESSION['pseudo']);
    unset($_SESSION['mdp']);
    unset($_SESSION['id_user']);

    session_destroy();

    header('Location:index.php');
}

$userAndPosts = getPosts();
$posts = $userAndPosts['posts'];

include('partials/header.php');

if ($userAndPosts['user']) {
?>
<section class="d-flex justify-content-start align-items-center border-bottom mb-3">
    <div clas="rounded-circle border border-2" style="width:48px; height:48px;">
        <img class="rounded-circle" src="assets/images/<?= $userAndPosts['user']['avatar']; ?>" alt="profile photo" style="width:100%;">
    </div>
    <h1 class="pt-2"><?= $userAndPosts['user']['pseudo']; ?></h1>
<?php if (!isset($_GET['user'])) { ?>
    <button class="btn ms-auto" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
            <path d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z"/>
            <path d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z"/>
        </svg>
    </button>

    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <p class="offcanvas-title" id="offcanvasBottomLabel">
                Paramètres 
                <a href="profil.php?logout=true" class="text-decoration-none">Se déconnecter</a>
            </p>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body small">
            <ul class="list-group">
                <li class="list-group-item"><a href="#" class="text-decoration-none">Paramètres</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none">Compte</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none">Confidentialtés</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none">Mentions légales</a></li>
                <li class="list-group-item"><a href="#" class="text-decoration-none">A propos</a></li>
            </ul>
        </div>
    </div>
<?php } ?>
</section>
<?php

}

if (count($posts) > 0) {
    // var_dump($posts);
?>
<section class="vh-100 d-flex flex-row flex-wrap justify-content-start align-items-start align-content-start">

<?php
foreach($posts as $post) {
?>

<a href="profil_post.php?post=<?= $post['id_post'] ?>" id="post_<?= $post['id_post'] ?>" class="d-block overflow-hidden" style="width:calc(100vw/3); height:calc(100vw/3);">
    <img src="assets/post/<?= $post['photo'] ?>" class="w-100">
</a>

<?php
} // foreach end
?>

</section>

<?php

} else {

?>

<div>
    <p>Vous n'avez encore rien poster pour le moment.</p>
</div>

<?php

} // if/else end

include('partials/navbar.php');
include('partials/footer.php');

?>
