<?php

    $env = parse_ini_file('.env');

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