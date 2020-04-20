<?php

    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_GET['idacht']))
    {  
        $idacheteur = $_GET['idacht'];
     
        
        $deletearticlepanier = $bdd->prepare("DELETE FROM panier WHERE idAcheteur = ?");
        $deletearticlepanier->execute(array($idaacheteur));
        
        header('Location: panier.php?id='.$idacheteur);
        
        
       
        
        
    }
?>