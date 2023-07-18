<?php

    $env = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/.env'); // DOCUMENT_ROOT va chercher la racine sous laquelle le script courant est exécuté, comme défini dans la configuration du serveur.

    $address = $env['LOCAL_ADDRESS'];

    $dns="mysql:host=" . $address . ";dbname=instatome";
    $user="root";
    $password="";

    try{
        $db=new PDO($dns,$user,$password);
        // echo "<p>Connected</p>";
    }
    catch(Exception $message){
        echo "J'crois y a une dinguerie dans ton code frérot "."<pre>$message</pre>";
    }
?>