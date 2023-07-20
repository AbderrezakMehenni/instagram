<?php
include_once('process/process_msg.php');

// var_dump($messages);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instatome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/msg.css">
</head>

<body>
    <section>
        <div class="header">
            <?php if (count($messages) > 0) { ?>
                <h1><?= $messages[0]['pseudo']; ?></h1>
            <?php } else { ?>
                <h1>Aucun message disponible.</h1>
            <?php } ?>
        </div>
        <?php foreach ($messages as $message) { ?>
            <div class="message <?php echo ($message['id_user_send'] == $_SESSION['id_user']) ? 'message-receive' : 'message-send'; ?>">
                <img class="pdp" src="assets/images/<?= $message['avatar']; ?>">
                <div class="content">
                    <?= $message['content']; ?>
                    <div class="date">
                        <?= $message['date_heure']; ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </section>
    <section class="container">
        <form id="basdepage" action="msg.php?id_user=<?= $_GET['id_user']; ?>#basdepage" method="POST">
            <textarea name="message" placeholder="Votre message"></textarea>
            <input type="hidden" name="ip">
            <button type="submit" name="envoyer">Envoyer</button>
        </form>
    </section>
</body>

</html>