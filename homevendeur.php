<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{   
    $getid = intval($_GET['id']);
    $verifvendeur = $bdd->prepare('SELECT * FROM vendeur WHERE id = ?');
    $verifvendeur->execute(array($getid));
    $vendeurinfo = $verifvendeur->fetch();
    
    
?>


<!DOCTYPE html>
<html>
    
    <head>
        <title>Home Page</title>
        
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

        <link rel="stylesheet" type="text/css" href="home.css">
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
    
    
    <body>
        
        <nav class="navbar navbar-expand-md">
            <a href="home.php?id=<?php echo $_SESSION['id']?>"><img src="EbayECE.jpg" height="65" width="auto"></a>
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
                <li class="nav-item"><a class="nav-link" href="vente.php?id=<?php echo $_SESSION['id']?>">Vendre</a></li>
            </ul>
            </div>
            
            
            
            <div class="navbar-end" id="main-navigation">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="vente.php?id=<?php echo $_SESSION['id']?>">Bonjour<?php echo ' ';echo $vendeurinfo['Prenom'];?></a></li>
            </ul>
            </div>
        </nav>
        
        
        <header class="page-header header container-fluid">
            <div class="overlay"></div>
            <div class="description">
            
                <br>
                <h1>Bienvenue sur l'Ebay de l'ECE Paris !</h1>
                <br>
                <p>
                EbayECE est né d'une collaboration extrêmement productive entre 3 élèves de l'ECE Paris. Aucune plateforme ne permettait la création du lien acheteur/vendeur dans les écoles d'ingénieurs. Notre solution est donc un site web destiné à la vente aux enchères pour la communauté de l'ECE Paris. Le site permet à l’utilisateur d’acheter, d’enchérir ou de négocier pour un produit coup de coeur et aux individus de vendre leurs biens.
                <br><br>
                <b>Mickaël Gremy, Florian Hilt &amp; Illyas Boudjemaï</b> | Créateurs de EbayECE
                </p>

            </div>
        </header>
        
        <footer class="page-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Plus d'informations</h6>
                        <p>
                        Le siège social d'EbayECE est situé au coeur de Paris, au 37 quai de Grenelle dans le 15ème arrondissement. Nos équipes travaillent chaque jour pour rendre le site plus fonctionnel qu'il ne l'était hier. Croyez-nous, ce n'est que le début d'une grande aventure.
                        </p>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <h6 class="text-uppercase font-weight-bold">Contact</h6>
                        <p>
                       	37 Quai de Grenelle | Paris <br>
                        florian.hilt@edu.ece.fr <br>
                        illyas.boudjemai@edu.ece.fr <br>
                        mickael.gremy@edu.ece.fr <br>
                        (+33) 1 44 39 06 00 <br>
                        </p>
                    </div>
                </div>
                <div class="footer-copyright text-center">&copy; 2020 Copyright | All Rights Reserved - EbayECE Inc.</div>
            </div>
        </footer>


    
    </body>
</html>
<?php
}
?>