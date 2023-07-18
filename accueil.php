<?php
require_once('utils/db-connect.php');
include_once('partials/header.php');
session_start();
?>

<section class="container">
    <div class="row d-flex p-3 mb-2 text-black align-items-center">
        <div class="col-6 d-flex justify-content-start">
            <a href="./accueil.php" class="text-decoration-none text-black">
                <h1>Instagram</h1>
            </a>
        </div>
        <div class="col-6 d-flex justify-content-end m-0 p-0">
            <ul class="col-6 d-flex justify-content-around m-0 p-0">
                <li><a href="#" class=""><img src="./assets/svg/heart.svg" alt="heart"></a></li>
                <li><a href="#"><img src="./assets/svg/send.svg" alt="send"></i></a></li>
            </ul>
        </div>
    </div>
</section>
<section class="container">
    <div class="row d-flex p-3 mb-2 text-black align-items-center">
        <div class="d-flex justify-content-center">
            <ul class="col-6 m-0 p-0 d-flex justify-content-between ">
                <a href="" class="rounded-circle profil text-decoration-none text-black">img</a>
                <a href="" class="rounded-circle profil text-decoration-none text-black">img</a>
                <a href="" class="rounded-circle profil text-decoration-none text-black">img</a>
                <a href="" class="rounded-circle profil text-decoration-none text-black">img</a>
            </ul>
        </div>
    </div>
</section>
<section class="container">
    <div class="row d-flex p-3 mb-2 text-white align-items-center">
        <div class="d-flex justify-content-center">
        </div>
    </div>
</section>

<footer>
    <?php
    include_once('./partials/navbar.php');
    ?>
</footer>