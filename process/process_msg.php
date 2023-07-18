<?php
require_once('../utils/db-connect.php');

$pdostmt = $db->prepare('SELECT users.pseudo, users.avatar, messages.content, messages.date_heure, messages.id_user_send 
                        FROM users INNER JOIN messages ON users.id_user = messages.id_user');
$pdostmt->execute();
$chat = $pdostmt->fetchAll(PDO::FETCH_ASSOC);
?>
<section class="container d-flex">
    <div>
        <?php foreach ($chat as $message) { ?>
            <div>
                <p> <?= $message['pseudo'] ?> </p>
            </div>
            <div>
                <p> <?= $message['content'] ?> </p>
            </div>
            <div>
                <p> <?= $message['date_heure'] ?> </p>
            </div>
            <div>
            <p> ID de l'expéditeur: <?= $message['id_user_send'] ?> </p>
            </div>
        <?php } ?>
    </div>
    <div>
        <form method="POST">
            <input type="text" name="message" placeholder="Votre message">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>