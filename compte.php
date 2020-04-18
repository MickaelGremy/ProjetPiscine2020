<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $verifuser = $bdd->prepare('SELECT * FROM acheteur WHERE id = ?');
    $verifuser->execute(array($getid));
    $userinfo = $verifuser->fetch();

?>

<html>
    
    <head>
        <title>Mon Compte</title>
        
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="compte.css">
        <link rel="stylesheet" type="text/css" href="navbar.css">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function()
            {
                $('.header').height($(window).height());
            });
        </script>
        
        
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    
    
    <body style="background-color: #0c070a">
        
        <nav class="navbar navbar-expand-md">
            <a href="homeacheteur.php?id=<?php echo $_SESSION['id']?>"><img src="EbayECE.jpg" height="65" width="auto"></a>
            <div class="navbar-collapse" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item deroulant"><a class="nav-link" href="#">Catégories</a>
                    <ul class="sous">
                        <li><a href="#">Ferraille ou trésor</a></li>
                        <li><a href="#">Bon pour le musée</a></li>
                        <li><a href="#">Accessoires VIP</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="achat.php?id=<?php echo $_SESSION['id']?>">
                    Acheter</a></li>
                <li class="nav-item"><a class="nav-link" href="connexionVendeur.php">Vendre</a></li>
            </ul>
            </div>
            
            
            
            <div class="navbar-end" id="main-navigation">
            <ul class="navbar-nav">
               <li class="nav-item"><a class="nav-link" href="panier.html">Panier</a></li>
               <li><a class="nav-link" href="deconnexionAcheteur.php">Se deconnecter</a></li>
            </ul>
            </div>
        </nav>
        
        

        <div class="container titre">
        

            <img src="avatar.jpg" width="10%">
            <h1>Bonjour <?php echo " "; echo $userinfo['Prenom']; ?></h1>
           
        </div>   
                <?php
                if(isset($_SESSION['id']) AND $userinfo['id']==$_SESSION['id'])
                {
                ?>
                    <div style="margin-bottom:40px">

                        <center>
                    
                        
                        <a href=editionprofil.php><input type="submit" name="editerprofil" value="Editer mon Profil"></a>
                        

                            
                        </center>
                        
                    </div>
                <?php
                }
                ?>
      
                
           

        
        
  
        
        <div class="container">
            <div class="row">
                
                <div class="col-md-6 col-lg-3 offset-lg-2 column">
                    <center><h5><b>Information de Livraison</b></h5><br></center>
                    <b>Nom :</b><?php echo " "; echo $userinfo['Nom']; ?> <br>
                    <b>Prénom :</b><?php echo " "; echo $userinfo['Prenom']; ?> <br>
                    <b>Email :</b><?php echo " "; echo $userinfo['Email']; ?> <br>
                    <hr>
                    <b>Adresse :</b><?php echo " "; echo $userinfo['Adresse']; ?> <br>
                    <b>Code Postal :</b><?php echo " "; echo $userinfo['Codepostal']; ?> <br>
                    <b>Ville :</b><?php echo " "; echo $userinfo['Ville']; ?> <br>
                    <hr>
                    <b>Téléphone :</b><?php echo " "; echo $userinfo['Telephone']; ?>
                    
                   
                
                
                </div>
                <div class="col-md-6 col-lg-3 offset-lg-2 column">
                 <center><h5><b>Moyen de paiement</b></h5><br></center>
                    <b>Nom du titulaire :</b>
                    <?php echo " "; echo $userinfo['Nom']; ?><br>
                    
                    <b>Prénom du titulaire :</b>
                    <?php echo " "; echo $userinfo['Prenom']; ?><br><br>
                    <hr><br>
                    
                    <b>N° de CB :</b>
                    <?php echo " "; echo $userinfo['Numcarte']; ?><br>
                    
                    <b>Date d'expiration :</b>
                    <?php 
    
                        echo " "; echo $userinfo['Moisexp'];
                        echo "/";
                        echo $userinfo['Anneeexp']; 
    
                    ?><br>
                    
                    <b>CVC :</b><?php echo " "; echo $userinfo['Cvc']; ?><br><br>
                    
    

                </div>
            </div>
            
            
            
        </div>
        
        
    </body>
</html>

<?php
    
}

?>