<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{    
    $idacheteur = $_GET['id'];
    $idcategorie = $_GET['categorie'];

    $afficherarticle = $bdd->prepare("SELECT * FROM article WHERE Categorie = ?");
    $afficherarticle->execute(array($idcategorie));
    $articleexist = $afficherarticle->rowCount();
?>



<!DOCTYPE html>
<html>
    
    <head>
        <title>Page Achat / Ferraile ou Trésor</title>
        
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="styleA.css">
        <link rel="stylesheet" type="text/css" href="slider.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">
        <link rel="stylesheet" type="text/css" href="animtitre.css">
        
        
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
            <a href="homeacheteur.php?id=<?php echo $_SESSION['id']?>"><img src="EbayECE.jpg" height="65" width="auto"></a>
            <div class="navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item deroulant"><a class="nav-link" href="#">Catégories</a>
                    <ul class="sous">
                        <li><a href="achat-categorie.php?id=<?php echo $_SESSION['id']; echo"&"; echo"categorie=Ferraille ou Tresor";?>">Ferraille ou trésor</a></li>
                        <li><a href="achat-categorie.php?id=<?php echo $_SESSION['id']; echo"&"; echo"categorie=Bon pour Musee";?>">Bon pour le musée</a></li>
                        <li><a href="achat-categorie.php?id=<?php echo $_SESSION['id']; echo"&"; echo"categorie=Accessoire VIP";?>">Accessoires VIP</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link"  href="achat.php?id=<?php echo $_SESSION['id']?>">Acheter</a></li>
                <li class="nav-item"><a class="nav-link"  href="connexionVendeur.php?id=<?php echo $_SESSION['id']?>">Vendre</a></li>
            </ul>
            </div>
            
            
            
            <div class="navbar-end" id="main-navigation">
            <ul class="navbar-nav">
               <li class="nav-item"><a class="nav-link" href="panier.php?id=<?php echo $_SESSION['id']?>">Panier</a></li>
               <li><a class="nav-link" href="compte.php?id=<?php echo $_SESSION['id']?>">Mon Compte</a></li>
            </ul>
            </div>
        </nav>
        
        <header class="container">
        
        <ul class="slides">
            <input type="radio" name="radio-btn" id="img-1" checked />
            <li class="slide-container">
                <div class="slide">
                    <img src="https://cdn.stocksnap.io/img-thumbs/960w/AKWVXIXFA8.jpg">
                </div>
                <div class="nav">
                    <label for="img-6" class="prev">&#x2039;</label>
                    <label for="img-2" class="next">&#x203a;</label>
                </div>
            </li>

            <input type="radio" name="radio-btn" id="img-2" />
            <li class="slide-container">
                <div class="slide">
                    <img src="https://cdn.stocksnap.io/img-thumbs/960w/AKWVXIXFA8.jpg">
                </div>
                
                <div class="nav">
                    <label for="img-1" class="prev">&#x2039;</label>
                    <label for="img-3" class="next">&#x203a;</label>
                </div>
            </li>

            <input type="radio" name="radio-btn" id="img-3" />
            
            <li class="slide-container">
                <div class="slide">
                    <img src="https://cdn.stocksnap.io/img-thumbs/960w/VVHE6VHMAW.jpg" />
                </div>

                <div class="nav">
                    <label for="img-2" class="prev">&#x2039;</label>
                    <label for="img-4" class="next">&#x203a;</label>
                </div>
            </li>

            <input type="radio" name="radio-btn" id="img-4" />
            
            <li class="slide-container">
                <div class="slide">
                    <img src="https://cdn.stocksnap.io/img-thumbs/960w/TPLJK7JPRR.jpg">
                </div>
                
                <div class="nav">
                    <label for="img-3" class="prev">&#x2039;</label>
                    <label for="img-5" class="next">&#x203a;</label>
                </div>
            </li>

            <input type="radio" name="radio-btn" id="img-5" />
            
            <li class="slide-container">
            <div class="slide">
            <img src="https://cdn.stocksnap.io/img-thumbs/960w/XJ2BKV9ASS.jpg">
            </div>
            <div class="nav">
            <label for="img-4" class="prev">&#x2039;</label>
            <label for="img-6" class="next">&#x203a;</label>
            </div>
            </li>

            <input type="radio" name="radio-btn" id="img-6" />
            
            <li class="slide-container">
                <div class="slide">
                    <img src="https://cdn.stocksnap.io/img-thumbs/960w/XJ2BKV9ASS.jpg">
                </div>
                <div class="nav">
                    <label for="img-5" class="prev">&#x2039;</label>
                    <label for="img-1" class="next">&#x203a;</label>
                </div>
            </li>

            <li class="nav-dots">
                <label for="img-1" class="nav-dot" id="img-dot-1"></label>
                <label for="img-2" class="nav-dot" id="img-dot-2"></label>
                <label for="img-3" class="nav-dot" id="img-dot-3"></label>
                <label for="img-4" class="nav-dot" id="img-dot-4"></label>
                <label for="img-5" class="nav-dot" id="img-dot-5"></label>
                <label for="img-6" class="nav-dot" id="img-dot-6"></label>
            </li>
        </ul>
        
        
        </header>
        
        <div>
            <h2><?php echo $idcategorie?></h2>
        </div>
        
        <div class="container">    
            <div class="row content">
                
                <div class="col-sm-12">
                    <div class="row">
                        
                        
                        <?php
                        if($articleexist > 0)
                        {

                            while($data = $afficherarticle->fetch())
                            {
                            ?>
                            <div class="col-sm-3 article">

                                <h4><b><?php echo " "; echo $data['Nom']; ?><br></b> </h4>

                                <?php 

                                    if(!empty($data['Photo']))
                                    {
                                ?>
                                        <img src="article/photo/<?php echo $data['Photo'];?>" style="width:100%">

                                <?php

                                    }
                                    else
                                    {
                                ?>

                                    <img src="https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_960_720.png" width="103%" >

                                <?php
                                }
                                ?>

                                <b>Prix : </b><?php echo " "; echo $data['Prix']; ?>€<br>

                                <b>Type de vente : </b><?php echo " "; echo $data['Typedevente']; ?> <br>

                                <i><?php echo $data['Description']; ?></i>

                                <br>


                                <?php
                                if(!empty($data['Video']))
                                {
                                ?>
                                     <a href="article/video/<?php echo $data['Video']; ?>">Vidéo descriptive</a>


                                <?php
                                }


                                if(isset($_SESSION['id']) AND $idacheteur==$_SESSION['id'])
                                {
                                ?>

                                    <a href="ajouterPanier(achat).php?idart=<?php 

                                    echo $data['id']; 
                                    echo "&idacht="; echo $_SESSION['id'];
                                    echo "&idvend="; echo $data['idVendeur'];
                                    echo "&nom="; echo $data['Nom'];
                                    echo "&categorie="; echo $data['Categorie'];
                                    echo "&prix="; echo $data['Prix']; 
                                    echo "&typedevente="; echo $data['Typedevente'];
                                    echo "&description="; echo $data['Description'];
                                    echo "&photo="; echo $data['Photo'];
                                    echo "&video="; echo $data['Video'];



                                     ?>">Ajouter au panier</a>

                            <?php
                                }
                            ?>
                            
                        </div>
                        <?php
                            }
                            $afficherarticle->closeCursor();
                        }
                        else
                        {
                        ?>
                        
                        
                    </div>
                    
                </div>          
            </div>
            
            <br><br>
            <center><h3>Aucun article n'est disponible pour le moment</h3></center>
                        
            <?php
            }
            ?>
            
        </div>
        
       
        
    </body>
    
    
</html>

<?php
    
}

?>