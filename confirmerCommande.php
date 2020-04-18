<?php

    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_GET['id']))
    {  
        $idacheteur = $_GET['id'];

        $deletepanier = $bdd->prepare("DELETE FROM panier WHERE idAcheteur = ?");
        $deletepanier->execute(array($idacheteur));
        
        
    
        echo "<script>alert('Test')</script>";
        
        header('Location: panier.php?id='.$_SESSION['id']);

    }
?>