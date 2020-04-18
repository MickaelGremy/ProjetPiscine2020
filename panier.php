<?php
session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{  

    $getid = intval($_GET['id']);
    $verifpanier = $bdd->prepare('SELECT * FROM panier WHERE idAcheteur = ?');
    $verifpanier->execute(array($getid));

    
    $verifacheteur = $bdd->prepare('SELECT * FROM acheteur WHERE id = ?');
    $verifacheteur->execute(array($getid));
    $afficheracheteur = $verifacheteur->fetch();
        
    $sommepanier = $bdd->prepare('SELECT SUM(Prix) AS Somme FROM panier WHERE idAcheteur = ?');
    $sommepanier->execute(array($getid));
    $affichertotal = $sommepanier->fetch();

?>


<!DOCTYPE html>
<html>

     <head>
        <title>Page Panier</title>
        
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="styleP.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">
         <link rel="stylesheet" type="text/css" href="deletebutton.css">
         
        
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('.header').height($(window).height());
            });
        </script>
        
        
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>

    <body>
        
        <nav class="navbar navbar-expand-md">
            <a href="home.php?id=<?php echo $_SESSION['id']?>"><img src="EbayECE.jpg" height="65" width="auto"></a>
            <div class="navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item deroulant"><a class="nav-link" href="#">Catégories</a>
                    <ul class="sous">
                        <li><a href="achat-categorie.php?id=<?php echo $_SESSION['id']; echo"&"; echo"categorie=Ferraille ou Tresor";?>">Ferraille ou trésor</a></li>
                        <li><a href="achat-categorie.php?id=<?php echo $_SESSION['id']; echo"&"; echo"categorie=Bon pour Musee";?>">Bon pour le musée</a></li>
                        <li><a href="achat-categorie.php?id=<?php echo $_SESSION['id']; echo"&"; echo"categorie=Accessoire VIP";?>">Accessoires VIP</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="achat.php?id=<?php echo $_SESSION['id']?>">Acheter</a></li>
                <li class="nav-item"><a class="nav-link" href="connexionVendeur.php">Vendre</a></li>
            </ul>
            </div>
            
            
            
            <div class="navbar-end" id="main-navigation">
            <ul class="navbar-nav">
               <li class="nav-item"><a class="nav-link" href="panier.php?id=<?php echo $_SESSION['id']?>">Panier</a></li>
                <li class="nav-item"><a class="nav-link" href="compte.php?id=<?php echo $_SESSION['id']?>">Mon compte</a></li>
            </ul>
            </div>
        </nav>
        
        
        
        <div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 titre">
                    
                        
                        <h1>Panier de <?php echo $afficheracheteur['Prenom'];?></h1>
                    
                    
                    </div>
                </div>
            </div>
        </div>
        
        <?php
        if(isset($_SESSION['id']) AND $getid==$_SESSION['id'])
        {
        ?>
        
        <?php
    
        while($data = $verifpanier->fetch())
        {
        ?>
        
        <div>
            <div class="containercontenu">
                <div class="row">
                    <div class="col-md-6 col-lg-3 offset-lg-2 image">
                  
                        <?php 
            
                        if(!empty($data['Photo']))
                        {
                        ?>
                            <img src="article/photo/<?php echo $data['Photo'];"" ?>" style="width:90%"> <br><br>

                        <?php

                        }
                        else
                        {
                        ?>

                            <img src="https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_960_720.png" width="98%"><br><br>

                        <?php
                        }
                        ?>

                    </div>
                    
            
                    <div class="col-md-6 text">
                        
                        <b><?php echo $data['Nom']; ?></b><br>

                        <b>Categorie : </b><?php echo " "; echo $data['Categorie']; ?><br>

                        <b>Prix : </b><?php echo " "; echo $data['Prix']; ?>€<br>

                        <b>Type de vente : </b><?php echo " "; echo $data['Typedevente']; ?> <br>

                        <i><?php echo $data['Description']; ?></i>


                        <br>

                        <?php
                        if(!empty($data['Video']))
                        {
                        ?>
                             <a href="article/video/<?php echo $data['Video']; ?>">Vidéo descriptive</a><br>


                        <?php
                        }
                        ?>
                        
                         
                        
                        <br>
                        
                        <div class="btn_wrapper">
                        <span class="btn_icon"></span>
                        <label class="btn_title" for="btn">delete</label>
                        <a style="color: #FF0000" href="supprimerPanier<?php
                    
                        echo "?idacht="; echo $_SESSION['id'];
                        echo "&idart="; echo $data['idArticle'];
                        echo "&idvend="; echo $data['idVendeur'];
                        echo "&nom="; echo $data['Nom'];
                        echo "&categorie="; echo $data['Categorie'];
                        echo "&prix="; echo $data['Prix']; 
                        echo "&typedevente="; echo $data['Typedevente'];
                        echo "&description="; echo $data['Description'];
                        echo "&photo="; echo $data['Photo'];
                        echo "&video="; echo $data['Video'];
                        ?>">
                               
                        <button  class="btn" id="btn"></button></a> 
                        </div>
                    
                    
                    </div>
                </div>
            </div>
             
        
        </div>
        
        
        
        <?php
        }
        ?>
        
        
     
        <div class="container text-right">
            <div class="row">



                <div class="col-md-12 box">
                
                    <?php
                    if(!empty($affichertotal['Somme']))
                    {
                    ?>

                    <h5>
                    Prix total : <b>
                    <?php echo $affichertotal['Somme']; ?> €</b></h5>
                    
                    <?php
                        
                    }
                    else
                    {
    
                    ?>
                    
                    <h5><b>Vous n'avez pas encore d'article dans votre panier</b></h5>

                    <?php
                    }
                    ?>

                </div>
            </div>
        </div>
        
        <?php
        if(!empty($affichertotal['Somme']))
        {
        ?>
        
        <center>
        
        <a href="confirmerCommande.php?id=<?php echo $_SESSION['id']?>">        <input type="submit"  name="confirmation" value="Je confirme ma commande"></a>

        </center>
        
        <?php
        }
        ?>
       
    </body>

</html>


<?php
    }
}
?>