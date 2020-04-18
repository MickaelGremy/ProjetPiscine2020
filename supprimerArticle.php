<?php

    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_GET['idvend']) AND $_GET['idart'])
    {  
        $idvendeur = $_GET['idvend'];
        $idarticle = $_GET['idart'];

        $deletearticle = $bdd->prepare("DELETE FROM article WHERE id = ? AND idVendeur = ?");
        $deletearticle->execute(array($idarticle, $idvendeur));
        
        header('Location: vente.php?id='.$idvendeur);
    


    }
?>