<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{    
    $getid = intval($_GET['id']);
    $verifvendeur = $bdd->prepare('SELECT * FROM vendeur WHERE id = ?');
    $verifvendeur->execute(array($getid));
    $vendeurinfo = $verifvendeur->fetch();
    
    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    {
        $tailleMax = 2097152;
        $extensionsValides = array('png', 'gif');
        if($_FILES['avatar']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "vendeur/avatar/".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateProfil = $bdd->prepare('UPDATE vendeur SET Profil = :avatar WHERE id = :id');
                    $updateProfil->execute(array(
                        'avatar' => $_SESSION['id'].".".$extensionUpload,
                        'id' => $_SESSION['id']
                        ));
                    header('Location: vente.php?id='.$_SESSION['id']);
                }
                else
                {
                    $erreur1 = "Echec du chargement de l'image";
                }

            }
            else
            {
                $erreur1 = "Votre photo de profil doit être au format .png ou .gif";
            }
        }

        else
        {
            $erreur1 = "Votre photo de profil ne doit pas dépasser 2Mo";
        }

    }

    if(isset($_FILES['fond']) AND !empty($_FILES['fond']['name']))
    {
        $tailleMax = 2097152;
        $extensionsValides = array('gif', 'png');
        if($_FILES['fond']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['fond']['name'], '.'), 1));

            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "vendeur/fond/".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['fond']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateFond = $bdd->prepare('UPDATE vendeur SET Fond = :fond WHERE id = :id');
                    $updateFond->execute(array(
                        'fond' => $_SESSION['id'].".".$extensionUpload,
                        'id' => $_SESSION['id']
                        ));
                    header('Location: vente.php?id='.$_SESSION['id']);
                }
                else
                {
                    $erreur2 = "Echec du chargement de l'image";
                }

            }
            else
            {
                $erreur2 = "Votre photo de fond doit être au format .gif ou .png";
            }
        }

        else
        {
            $erreur2 = "Votre photo de fond ne doit pas dépasser 2Mo";
        }

    }
    
    
    $verifarticle = $bdd->prepare('SELECT * FROM article WHERE idVendeur = ?');
    $verifarticle->execute(array($getid));
    

?>

<!DOCTYPE html>
<html>
    
    <head>
        <title>Page Vendeur</title>
        
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        
        <link rel="stylesheet" type="text/css" href="navbar.css">
        
        <link rel="stylesheet" type="text/css" href="styleV.css">
        <link rel="stylesheet" type="text/css" href="scrollV.css">
        
        
        



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('.header').height($(window).height());
            });
        </script>
        
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        
    </head>
    
    
    <body style="background-image: url('vendeur/fond/<?php echo $vendeurinfo['Fond']; ?>')">
            
               
    
        
        <nav class="navbar navbar-expand-md">
            <a href="homevendeur.php?id=<?php echo $_SESSION['id']?>"><img src="EbayECE.jpg" height="65" width="auto"></a>
            <div class="navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item deroulant"><a class="nav-link" href="#">Catégories</a>
                    <ul class="sous">
                        <li><a href="connexionAcheteur.php">Ferraille ou trésor</a></li>
                        <li><a href="connexionAcheteur.php">Bon pour le musée</a></li>
                        <li><a href="connexionAcheteur.php">Accessoires VIP</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a class="nav-link" href="connexionAcheteur.php">Acheter</a></li>
                
                <li class="nav-item"><a class="nav-link" type="submit" name="ventepage" href="vente.php?id=<?php echo $_SESSION['id']?>">Vendre</a></li>
            </ul>
            </div>
            
            
            
            <div class="navbar-end" id="main-navigation">
            <ul class="navbar-nav">
               <li><a class="nav-link" href="deconnexionVendeur.php">Se deconnecter</a></li>
            </ul>
            </div>
        </nav>
        
        
        <div class="titre">
            
            
            <h1>Page Vendeur</h1>
            
            <?php
                if(isset($_SESSION['id']) AND $vendeurinfo['id']==$_SESSION['id'])
                {
            ?>

            <a href="ajouterArticle.php?id=<?php echo $_SESSION['id']?>">
                <input type="submit" class="ajouter" value="+ Ajouter un article"></a>

            <?php
                }
            ?>
            
        </div>
        
        
        <div class="container">  
        
            <div class="infoV">
                <?php 

                    if(!empty($vendeurinfo['Profil']))
                    {
                    ?>
                        <img class="imgprofil" src="vendeur/avatar/<?php echo $vendeurinfo['Profil'];?>" width="100"/>

                    <?php

                        }

                ?>
                <br>
                <b>Nom :</b><?php echo " "; echo $vendeurinfo['Nom']; ?><br>
                <b>Prénom :</b><?php echo " "; echo $vendeurinfo['Prenom']; ?><br><br>
                <b>Pseudo de vente :</b><?php echo " "; echo $vendeurinfo['Pseudo']; ?><br>
                <b>Email de vente : </b><?php echo " "; echo $vendeurinfo['Email']; ?>
            </div>
                
                
            <br><br>
            <hr>
            <br>

                
                
                
            <?php
            if(isset($_SESSION['id']) AND $vendeurinfo['id']==$_SESSION['id'])
            {
            ?>
                
            <div class="col-sm-12">
                <div class="row">
                    
                    
                    <div class="col-sm-6">
                        
                        <form method="post" action="" enctype="multipart/form-data">
            
                            <label><b>Choisir une image de profil : </b></label><br>
                            <input type="file" name="avatar"><br>

                            <div class="test">

                                <?php

                                    if(isset($erreur1))
                                    {
                                        echo $erreur1;
                                    }

                                ?>

                            </div>

                            <input type="submit" name="okprofil" value="OK" class="btnprofil"><br>

                        </form>
                
                    </div>
                    
                    <div class="col-sm-6">                        
                        
                        <form method="post" action="" enctype="multipart/form-data">

                        <label><b>Choisir une image de fond : </b></label><br>
                        <input type="file" name="fond"><br>

                        <div class="test">

                            <?php

                                if(isset($erreur2))
                                {
                                    echo $erreur2;
                                }

                            ?>

                        </div>

                        <input type="submit" name="okfond" value="OK" class="btnprofil"><br>

                        </form>

                    
                     
                    </div>
                </div>
                
            </div>
            <?php
            }
            ?>
            
            <div class="infoA">
            
                <br><br><center><h3><u>Articles actuellement en vente</u></h3></center><br><br>

                <div class="row content">
                    <div class="scroll-bar-wrap">
                        <div class="scroll-box">
                            <div class="col-sm-12">
                                <div class="row">


                                    <?php
                                    while($data = $verifarticle->fetch())
                                    {
                                    ?>
                                    <div class="col-sm-3 article">

                                        <h5> <?php echo " "; echo $data['Nom']; ?><br></h5>

                                        <?php 

                                            if(!empty($data['Photo']))
                                            {
                                        ?>
                                                <img src="article/photo/<?php echo $data['Photo'];"" ?>" style="width:100%">

                                        <?php

                                            }
                                            else
                                            {
                                        ?>

                                            <img src="https://cdn.pixabay.com/photo/2017/02/12/21/29/false-2061132_960_720.png" width="103%" >

                                        <?php
                                        }
                                        ?>

                                        <b>Categorie : </b><?php echo " "; echo $data['Categorie']; ?><br>

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
                                        ?>

                                         <?php

                                        if(isset($_SESSION['id']) AND $vendeurinfo['id']==$_SESSION['id'])
                                        {
                                        ?>

                                            <a href="supprimerArticle.php?idart=<?php echo $data['id']; echo "&idvend="; echo $data['idVendeur']?>">Supprimer</a>

                                        <?php
                                        }
                                        ?>

                                        <br><br><br>

                                    </div>

                                    <?php
                                    }
                                    $verifarticle->closeCursor();
                                    ?>

                                </div>
                            </div>

                        </div>

                    </div>

                </div> 
            </div>
        </div>
        
        
    </body>
    
    
</html>


<?php
    
}

?>