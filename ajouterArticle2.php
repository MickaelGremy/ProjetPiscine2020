<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $verifarticle = $bdd->prepare('SELECT * FROM article WHERE id = ?');
    $verifarticle->execute(array($getid));
    $articleinfo = $verifarticle->fetch();
 
    if(isset($_FILES['photo']) AND !empty($_FILES['photo']['name']))
    {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'png', 'gif');
        if($_FILES['photo']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['photo']['name'], '.'), 1));

            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "article/photo/".$getid.".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['photo']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updatePhoto = $bdd->prepare('UPDATE article SET Photo = :photo WHERE id = :id');
                    $updatePhoto->execute(array(
                        'photo' => $getid.".".$extensionUpload,
                        'id' => $getid
                        ));
                    header('Location: ajouterArticle2.php?id='.$getid);
                }
                else
                {
                    $erreur1 = "Echec du chargement de l'image";
                }

            }
            else
            {
                $erreur1 = "Votre photo doit être au format .jpg, .jpeg, .png ou .gif";
            }
        }

        else
        {
            $erreur1 = "Votre photo ne doit pas dépasser 2Mo";
        }

    }
    
    
    if(isset($_FILES['video']) AND !empty($_FILES['video']['name']))
    {
        
        $tailleMax = 2097152;
        $extensionsValides = array('mp4');
        if($_FILES['video']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['video']['name'], '.'), 1));

            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "article/video/".$getid.".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['video']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateVideo = $bdd->prepare('UPDATE article SET Video = :video WHERE id = :id');
                    $updateVideo->execute(array(
                        'video' => $getid.".".$extensionUpload,
                        'id' => $getid
                        ));
                    header('Location: ajouterArticle2.php?id='.$getid);
                }
                else
                {
                    $erreur2 = "Echec du chargement de la vidéo";
                }

            }
            else
            {
                $erreur2 = "Votre vidéo doit être au format .mp4";
            }
        }

        else
        {
            $erreur2 = "Votre vidéo ne doit pas dépasser 4Mo";
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

        <div class="Bloc">

            

                <center>
                <h1>Ajouter un article</h1><br>
                </center>

                <div class="row">

                    <div class="col">

                        <center>
                            
                        <br> <h4>Contenu multimédia du produit</h4> <br>

                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="input-group">
                                <input type="file" name="photo"/><br>

                            </div>
                            <input type="submit" name="okphoto" value="Ajouter photo" class="btnprofil">
                            
                        <div class="test">
                        <?php
                            if(isset($erreur1))
                            {
                                echo $erreur1;
                            }
                        ?>
                        </div>

                        </form>
                            
                            
                        <form action="" method="post" enctype="multipart/form-data">
                            
                        <div class="input-group">
                            <input type="file" name="video"/>
                            <br>
                        </div>

                        <input type="submit" name="okvideo" value="Ajouter video" class="btnprofil">
                            
                        <div class="test">
                            <?php
                                if(isset($erreur2))
                                {
                                    echo $erreur2;
                                }
                            ?>
                        </div>

                        </form>
                            
                        </center>

                    </div>

    
                </div>
                <?php
                    if(isset($_SESSION['id']) AND $articleinfo['id']==$getid)
                    {

                ?>
                <center>
                    
                    
                    <a href="vente.php?id=<?php echo $_SESSION['id']?>">
                    <input type="submit" name="ajout" value="Ajouter l'article"></a>
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
                
                
            
            

        </div>

    </body>
</html>
<?php
}

?>
