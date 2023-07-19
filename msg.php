<?php
include_once('process/process_msg.php');
?>
<ul>
    <?php if (count($messages) > 0) {
        foreach ($messages as $message) { ?>
            <li>
                <strong><?= htmlspecialchars($message['sender']); ?>:</strong> <?= htmlspecialchars($message['content']); ?> (<?= $message['date_heure']; ?>)
            </li>
    <?php }
    } else { ?>
        <li>Aucun message disponible.</li>
    <?php } ?>
</ul>