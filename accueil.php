<?php
require_once('utils/db-connect.php');
session_start();

if (count($_SESSION) === 0) header('Location:index.php');

include_once('partials/header.php');
?>

<section class="container">
    <div class="row d-flex p-3 mb-2 text-black align-items-center">
        <div class="col-6 d-flex justify-content-start">
            <a href="./accueil.php" class="text-decoration-none text-black">
                <h1 class="titre">Instatome</h1>
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end m-0 p-0">
            <ul class="col-6 d-flex justify-content-around m-0 p-0">
                <li><a href="#" class=""><img src="./assets/svg/heartVide.svg" alt="heart"></a></li>
                <li><a href="./list_msg.php"><img src="./assets/svg/send.svg" alt="send"></i></a></li>
            </ul>
        </div>
    </div>
</section>

<?php
include_once('./process/process_accueil.php');

foreach ($postsfollow as $post) {
?>

    <article class="container" data-article="<?php echo $post['id_post']; ?>">
        <div class="row">
            <div class="d-flex user align-item-center">
                <div class=" rounded-circle avatar d-flex align-items-center">
                    <img class="rounded-circle d-flex align-items-center img" src="assets/images/<?= $post['avatar']; ?>" alt="Image">
                </div>
                <div class="d-flex align-items-center">
                    <?php echo $post['pseudo']; ?>
                </div>
                <div>
                    <!-- burger -->
                </div>
            </div>
        </div>
        <div  class="photo" >
            <img src="assets/post/<?= $post['photo'] ?>">
        </div>
        <div>
            <div>
                <?php 
                $query = 'SELECT * FROM likes WHERE id_user=:id_user AND id_post=:id_post';
                $request = $db->prepare($query);
                $request->execute([
                    'id_user' => $_SESSION['id_user'],
                    'id_post' => $post['id_post']
                ]);
                $isLike = $request->fetch();
                ?>
                <?php  if ($isLike) { ?>                 
                    <img class="heartVide" src="../assets/svg/heartPlein.svg" alt="HeartPlein" data-post="<?php echo $post['id_post']; ?>">  
                <?php } else { ?>
                    <img class="heartVide" src="../assets/svg/heartVide.svg" alt="HeartVide" data-post="<?php echo $post['id_post']; ?>">
                <?php } ?>
                <span data-article="<?php echo $post['id_post']; ?>"></span>
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
?>
<section class="container">
    <div class="row d-flex p-3 mb-2 text-white align-items-center">
        <div class="d-flex justify-content-center">
        </div>
    </div>
</section>


<footer>
    <?php
    include_once('./partials/footer.php');
    include_once('./partials/navbar.php');
    ?>
</footer>
