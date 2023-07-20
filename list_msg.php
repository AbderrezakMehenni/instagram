<?php
include_once('process/process_list_msg.php');

include_once('partials/header.php');
?>
<section>
    <ul>
        <?php foreach ($userMessages as $user) { ?>
            <li>
                <a href="msg.php?id_user=<?= $user['id_user']; ?>#basdepage">
                <?php echo $user['pseudo']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>
<?php
    include_once ('partials/navbar.php');
?>