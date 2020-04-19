<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $verifvendeur = $bdd->prepare('SELECT * FROM vendeur WHERE id = ?');
    $verifvendeur->execute(array($getid));
    $vendeurinfo = $verifvendeur->fetch();
    $idvendeur = $_GET['id'];
    
    $verifadmin = $bdd->prepare('SELECT * FROM administrateur WHERE id = ?');
    $verifadmin->execute(array($getid));
    $admininfo = $verifadmin->fetch();
    $idadmin = $_GET['id'];
  
    if(isset($_POST['ajout']))
    {
            

        if(!empty($_POST['nom']) AND ($_POST['categorie']!='default') AND !empty($_POST['prix']) AND ($_POST['typedevente']!='default') AND !empty($_POST['description']))
        {
            
            $nom = htmlspecialchars($_POST['nom']);
            $categorie = htmlspecialchars($_POST['categorie']);
            $prix = htmlspecialchars($_POST['prix']);
            $typedevente = htmlspecialchars($_POST['typedevente']);
            $description = htmlspecialchars($_POST['description']);



            $insertarticle = $bdd->prepare("INSERT INTO article(Nom, Categorie, Prix, Typedevente, Description, idVendeur, Photo, Video, idAcheteur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insertarticle->execute(array($nom, $categorie, $prix, $typedevente, $description, $idvendeur, '', '', ''));
            $lastId = $bdd->lastInsertId();

            
            $verifarticle = $bdd->prepare("SELECT * FROM article WHERE nom = ? AND idVendeur = ?");
            $verifarticle->execute(array($nom, $idvendeur));
            
            
            
            $articleexist = $verifarticle->rowCount();

            if($articleexist >= 2)
            {
                $deletearticle = $bdd->prepare("DELETE FROM article WHERE Nom = ? AND idVendeur = ?" . 'LIMIT 1');
                $deletearticle->execute(array($nom, $idvendeur));
                
                $erreur = "Article déjà présent dans votre catalogue de vente";//Article existe deja
                
            }
            else
            {
                
                header('Location: ajouterArticle2.php?id='.$lastId);
            }

            



        }
        else
        {
            $erreur = "Tous les champs doivent être remplis";
        }
    }
    
    
    if(isset($_POST['ajout(admin)']))
    {
            

        if(!empty($_POST['nom']) AND ($_POST['categorie']!='default') AND !empty($_POST['prix']) AND ($_POST['typedevente']!='default') AND !empty($_POST['description']))
        {
            
            $nom = htmlspecialchars($_POST['nom']);
            $categorie = htmlspecialchars($_POST['categorie']);
            $prix = htmlspecialchars($_POST['prix']);
            $typedevente = htmlspecialchars($_POST['typedevente']);
            $description = htmlspecialchars($_POST['description']);



            $insertarticle = $bdd->prepare("INSERT INTO article(Nom, Categorie, Prix, Typedevente, Description, idVendeur, Photo, Video, idAcheteur) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insertarticle->execute(array($nom, $categorie, $prix, $typedevente, $description, $idvendeur, '', '', ''));
            $lastId = $bdd->lastInsertId();

            
            $verifarticle = $bdd->prepare("SELECT * FROM article WHERE nom = ? AND idVendeur = ?");
            $verifarticle->execute(array($nom, $idvendeur));
            
            
            
            $articleexist = $verifarticle->rowCount();

            if($articleexist >= 2)
            {
                $deletearticle = $bdd->prepare("DELETE FROM article WHERE Nom = ? AND idVendeur = ?" . 'LIMIT 1');
                $deletearticle->execute(array($nom, $idvendeur));
                
                $erreur = "Article déjà présent dans votre catalogue de vente";//Article existe deja
                
            }
            else
            {
                
                header('Location: ajouterArticle2(admin).php?id='.$lastId);
            }

            



        }
        else
        {
            $erreur = "Tous les champs doivent être remplis";
        }
    }
?>




<!DOCTYPE html>
<html>
    
    <head>

        <title>Ajouter Article</title>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="styleajout.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>

    <body style="background-color: #0c070a"> 

        <div class="Bloc container">

            <form action="" method="post">

                <center>
                <h1>Ajouter un article</h1>
                </center>

                <div class="row">

                    <div class="col">

                        <center>
                            
                            <br> <h4>Propriétés du produit</h4> <br>


                            <div class="input-group">
                                <input type="text" name="nom" placeholder="Nom du produit"/>
                            </div>

                            <div class="input-group">
                                <select name="categorie">
                                    <option value="Ferraille ou Tresor">Ferraille ou Trésor</option>
                                    <option value="Bon pour Musee">Bon pour le musée</option>
                                    <option value="Accessoire VIP">Accessoire VIP</option>
                                </select>  
                            </div>
                            
                            <div class="input-group">
                            <input type="tel" name="prix" placeholder="Prix du produit"/>
                            </div>
                            
                            <div class="input-group">
                                <select name="typedevente">
                                    <option value="Achat immediat">Achat immédiat</option>
                                    <option disabled value="Enchère">Enchère - Bientôt disponible !</option>
                                    <option disabled value="Negociation">Négociation - Bientôt disponible !</option>
                                </select>
                            </div>

                            <div class="input-group">
                            <input type="text" name="description" placeholder="Description du produit"/>
                            </div>
                            
                        </center>

                    </div>

    
                </div>
                <?php
                    if(isset($_SESSION['id']) AND $vendeurinfo['id']==$_SESSION['id'])
                    {
                ?>
                <center>
                    <input type="submit" name="ajout" value="Passer au contenu multimédia">
                </center>
  
                <?php
                    }
                    elseif($_SESSION['id'] AND $admininfo['id']=='99999')
                    {
                ?>
                
                    <center>
                        <input type="submit" name="ajout(admin)" value="Passer au contenu multimédia">
                    </center>
                <?php
                    }
                    else{
                ?>
                    <div class="test">
                        Vous n'avez pas le droit d'ajouter un article pour un autre vendeur
                    </div>
                <?php
                    }
                ?>
                
                
                
                
                
            </form>
            
            <div class="test">
            <?php
                if(isset($erreur))
                {
                    echo $erreur;
                }
            ?>
            </div>

        </div>

    </body>
</html>
<?php
}
?>
