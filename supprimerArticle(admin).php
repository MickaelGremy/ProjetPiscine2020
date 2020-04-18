<?php

    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');

    if(isset($_GET['idart']))
    {  
        $idarticle = $_GET['idart'];

        $deletearticle = $bdd->prepare("DELETE FROM article WHERE id = ?");
        $deletearticle->execute(array($idarticle));
        
        header('Location: admin.php?id='.$_SESSION['id']);
    }
?>