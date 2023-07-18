<?php
include_once('process/process_list_msg.php');
?>
<section>
    <ul>
        <?php foreach ($usersMessages as $user) { ?>
            <li>
                <a href="msg.php?userId=<?php $user['id_user']; ?>">
                    <?php $user['pseudo']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</section>