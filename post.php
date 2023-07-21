<?php

session_start();

if (count($_SESSION) === 0) header('Location:index.php');

include('partials/header.php');

?>

<form action="process/process_post.php" method="POST"  enctype="multipart/form-data">
    <label for="media">Votre média :</label>
    <input type="file" name="media">

    <label for="description">Votre description :</label>
    <textarea name="description" placeholder="Votre description"></textarea>

    <label for="tags">Tags :<label>
    <input type="text" name="tags" placeholder="Ajoutez vos tags">

    <input type="submit" name="addNewPost" value="Poster">
</form>

<?php include('partials/navbar.php'); ?>
