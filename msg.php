<?php
include_once('process/process_msg.php');
?>
<ul>
    <?php foreach ($messages as $message) { ?>
        <li>
            <strong><?= $message['sender']; ?>:</strong> <?= $message['content']; ?> (<?= $message['date_heure']; ?>)
        </li>
    <?php } ?>
</ul>