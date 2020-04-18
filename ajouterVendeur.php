<?php
session_start();

$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
if(isset($_GET['id']) AND $_GET['id'] > 0)
{
    $getid = intval($_GET['id']);
    $verifadmin = $bdd->prepare('SELECT * FROM administrateur WHERE id = ?');
    $verifadmin->execute(array($getid));
    $admininfo = $verifadmin->fetch();
  
    if(isset($_POST['ajout']))
    {
           
        if(!empty($_POST['pseudo']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']))
        {
            
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);



            $verifvendeur = $bdd->prepare("SELECT * FROM vendeur WHERE email = ?");
            $verifvendeur->execute(array($email));
            $emailexist = $verifvendeur->rowCount();
             
            if($emailexist == 0)
            {
                $insertvendeur = $bdd->prepare("INSERT INTO vendeur(Pseudo, Nom, Prenom, Email, Profil, Fond) VALUES(?, ?, ?, ?, ?, ?)");
                $insertvendeur->execute(array($pseudo, $nom, $prenom, $email, '', ''));
                header('Location: admin.php?id='.$_SESSION['id']);
            }

            else
            {
                $erreur="Email déjà utilisé cliquez sur connexion pour vous connecter";
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

        <title>Ajouter Vendeur</title>
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" type="text/css" href="styleajout.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>

    <body style="background-color: #0c070a"> 

        <div class="Bloc container">

            <form action="" method="post">

                <center>
                <h1>Ajouter un vendeur</h1>
                </center>

                <div class="row">

                    <div class="col">

                        <center>
                            
                            <br> <h4>Identité du vendeur</h4> <br>


                            <div class="input-group">
                                <input type="text" name="pseudo" placeholder="Pseudo du vendeur"/>
                            </div>

                            <div class="input-group">
                                <input type="text" name="nom" placeholder="Nom du vendeur"/>
                            </div>

                            <div class="input-group">
                                <input type="text" name="prenom" placeholder="Prenom du vendeur"/>   
                            </div>

                            <div class="input-group">
                            <input type="email" name="email" placeholder="Email du vendeur"/>
                            </div>
                            
                        </center>

                    </div>

    
                </div>
                <?php
                    if(isset($_SESSION['id']) AND $admininfo['id']=='99999')
                    {
                ?>
                <center>
                    <input type="submit" name="ajout" value="Ajouter le vendeur">
                </center>
  
                <?php
                    }
                    else{
                ?>
                    <div class="test">
                        Vous n'avez pas le droit d'ajouter de vendeur
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
