<?php
session_start();

if (count($_SESSION) === 0) header('Location:index.php');

include_once('process/process_list_msg.php');

include_once('partials/header.php');
?>
<section>
        <?php foreach ($userMessages as $user) { ?>
            <div class="border p-2 m-2">
                <img class="pdp" src="assets/images/<?= $user['avatar']; ?>">
                <a href="msg.php?id_user=<?= $user['id_user']; ?>#basdepage">
                <?php echo $user['pseudo']; ?>
                </a>
            </div>
        <?php } ?>
</section>
<?php
    include_once ('partials/navbar.php');
?>
