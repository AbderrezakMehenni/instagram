<?php
require_once('../utils/db-connect.php');
session_start();

$sql = "SELECT * 
    FROM users 
    JOIN follow ON users.id_user = follow.id_user";

$stmt = $db->prepare($sql);
$stmt->execute();
$user = $stmt->fetchAll(PDO::FETCH_ASSOC); // On récupère la question au hasard

// var_dump($user);
// var_dump($_SESSION['pseudo']);

$sql = "SELECT * 
    FROM follow 
    JOIN users ON follow.id_user_follow = users.id_user";

$stmt = $db->prepare($sql);
$stmt->execute();
$follow = $stmt->fetchAll(PDO::FETCH_ASSOC); // On récupère la question au hasard

var_dump($follow);

$var= [];

foreach($follow as $foll) {
        $sql = "SELECT * 
            FROM posts 
            JOIN users ON posts.id_user = users.id_user
            WHERE posts.id_user = ?";    

        $stmt = $db->prepare($sql);
        $stmt->execute([$foll['id_user_follow']]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC); // On récupère la question au hasard


array_push($var, $post);
var_dump($var);
}
?>

<article>
    <div>
        <div>
            <!-- avatar -->
        </div>
        <div>
            <?php echo $var[0]['photo'] ?>
        </div>
        <div>
            <!-- burger -->
        </div>
    </div>
    <div>
        <!-- <p>contenu</p> -->
    </div>
    <div>
        <div>
            <!-- svg -->
        </div>
        <div>
            <!-- like -->
        </div>
        <div>
            <!-- commentaire du contenu -->
        </div>
        <div>
            <!-- commentaire des autres users (possibilité de liker un commentaire) -->
        </div>
    </div>
</article>