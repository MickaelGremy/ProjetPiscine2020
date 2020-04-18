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
        
        $ajouterpanier = $bdd->prepare("INSERT INTO panier(idAcheteur, idArticle, idVendeur, Nom, Categorie, Prix, Typedevente, Description, Photo, Video, Somme) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $ajouterpanier->execute(array($idacheteur, $idarticle, $idvendeur, $nom, $categorie, $prix, $typedevente, $description, $photo, $video, ''));
        
        $deletearticle = $bdd->prepare("DELETE FROM article WHERE id = ?");
        $deletearticle->execute(array($idarticle));
        
        
        header('Location: achat-categorie.php?id='.$idacheteur.'&categorie='.$categorie);
    }
?>