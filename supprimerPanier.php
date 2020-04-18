<?php

    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_GET['idacht']))
    {  
        $idacheteur = $_GET['idacht'];
        $idarticle = $_GET['idart'];
        $idvendeur = $_GET['idvend'];
        $nom = $_GET['nom'];
        $categorie = $_GET['categorie'];
        $prix = $_GET['prix'];
        $typedevente = $_GET['typedevente'];
        $description = $_GET['description'];
        $photo = $_GET['photo'];
        $video = $_GET['video'];
     
        $ajouterarticle = $bdd->prepare("INSERT INTO article(Nom, Categorie, Prix, Typedevente, Description, idVendeur, Photo, Video, idAcheteur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ajouterarticle->execute(array($nom, $categorie, $prix, $typedevente, $description, $idvendeur, $photo, $video, ''));
        
        $deletearticlepanier = $bdd->prepare("DELETE FROM panier WHERE idArticle = ?");
        $deletearticlepanier->execute(array($idarticle));
        
        header('Location: panier.php?id='.$idacheteur);
        
        
       
        
        
    }
?>