<section class="container d-flex">
    <div>
        <?php
        include_once('process/process_msg.php');

        $pseudoValue = "VotrePseudo";

        $query = "SELECT users.pseudo, messages.content, messages.date_heure
                    FROM messages
                    INNER JOIN users ON users.id_user = messages.id_user_send
                    WHERE messages.id_user = :userId";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($messages as $message) {
            echo "<div><p>De " . $message['pseudo'] . " :</p><p>" . $message['content'] . "</p></div>";
        }
        ?>
    </div>
    <div>
        <form method="POST">
            <input type="text" name="message" placeholder="Votre message">
            <button type="submit">Envoyer</button>
        </form>
    </div>
</section>