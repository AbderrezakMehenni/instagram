<?php
    include_once('process/process_list_msg.php');
?>
<ul>
    <?php foreach ($usersMessages as $user) { ?>
        <li>
            <a href="messages_with_user.php?userId=<?= $user['id_user']; ?>">
                <?php $user['pseudo']; ?>
            </a>
        </li>
    <?php } ?>
</ul>