<?php

    session_start();
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_GET['idvend']))
    {  
        $idvendeur = $_GET['idvend'];

        $deletevendeur = $bdd->prepare("DELETE FROM vendeur WHERE id = ?");
        $deletevendeur->execute(array($idvendeur));
        
        header('Location: admin.php?id='.$_SESSION['id']);
    


    }
?>