<?php

require_once('process/process_profil.php');

$posts = getPosts();

include('partials/header.php');

if (count($posts) > 0) {
?>

<section class="vh-100 d-flex flex-row flex-wrap justify-content-start align-items-start align-content-start">

<?php
foreach($posts as $post) {
?>

<a href="profil.php?post=<?= $post['id_post'] ?>" id="post_<?= $post['id_post'] ?>" class="d-block overflow-hidden" style="width:calc(100vw/3); height:calc(100vw/3);">
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

?>
