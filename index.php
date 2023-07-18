<?php
require_once('utils/db-connect.php'); // J'appelle la base de données

include_once('partials/header.php');

?>
<section class="container d-flex align-items-center vh-100 justify-content-center">
    <div class="row justify-content-center w-100">
        <div class="bg-test col-12 mt-5 mb-5 p-5 rounded-4">
            <form method="POST" class="text-center" action="./process/process_connexion.php">
                <input type="text" name="pseudo" class=" input form-control mb-5" size="80" placeholder="Votre pseudo">
                <input type="text" name="mdp" class=" input form-control mb-5" size="80" placeholder="Votre mot de passe">
                <button type="submit" name="connexion" class="btn btn-primary">Se connecter</button>
            </form>
        </div>
    </div> 
</section>

<?php
include_once('partials/footer.php');
?>
