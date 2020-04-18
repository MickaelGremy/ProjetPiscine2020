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
  
    if(isset($_POST['ajout']))
    {
            

        if(!empty($_POST['nom']) AND !empty($_POST['categorie']) AND !empty($_POST['prix']) AND !empty($_POST['description']))
        {
            
            $nom = htmlspecialchars($_POST['nom']);
            $categorie = htmlspecialchars($_POST['categorie']);
            $prix = htmlspecialchars($_POST['prix']);
            $description = htmlspecialchars($_POST['description']);



            $insertarticle = $bdd->prepare("INSERT INTO article(Nom, Categorie, Prix, Description, idVendeur, Photo, Video) VALUES(?, ?, ?, ?, ?, ?, ?)");
            $insertarticle->execute(array($nom, $categorie, $prix, $description, $idvendeur, '', ''));
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
                                <input type="text" name="categorie" placeholder="Catégorie du produit"/>
                            </div>

                            <div class="input-group">
                                <input type="tel" name="prix" placeholder="Prix du produit"/>   
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
                    else
                    {
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
