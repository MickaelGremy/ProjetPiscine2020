<?php
    
    session_start();

    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_POST['connexion']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $motdepasse = htmlspecialchars($_POST['motdepasse']);
        
        if(!empty($_POST['pseudo']) AND !empty($_POST['motdepasse']))
        {
            $verifadmin = $bdd->prepare("SELECT * FROM administrateur WHERE pseudo = ? AND motdepasse = ?");
            $verifadmin->execute(array($pseudo, $motdepasse));
            $adminexist = $verifadmin->rowCount();
            
            if($adminexist == 1)
            {
                $admininfo = $verifadmin->fetch();
                $_SESSION['id'] = $admininfo['id'];
                $_SESSION['Pseudo'] = $admininfo['Pseudo'];
                $_SESSION['Motdepasse'] = $admininfo['Motdepasse'];
                header("Location: admin.php?id=".$_SESSION['id']);
            }
            else
            {
                $erreur = "Ce pseudo ne donne pas l'accès root";
            }
        }
        else
        {
            $erreur="Tous les champs doivent être remplis";        
        }
    }  

?>


<!DOCTYPE html>
<html>
    
    <head>
        
        <title>Page Connexion Vendeur</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="connexion.css">
        
    </head>
 
    
    <body>
        
        
        

        <div class="Bloc">

            <div class="imgcontainer">
                <h1>Connexion administrateur</h1>
            <img src="cadanas.png" class="admin">
            </div>
            
            <center>




                <form action="connexionAdministrateur.php" method="post">

                    
                    <label for="Pseudo">Pseudo :</label> <br>
                    <input type="text" placeholder="Entrer votre Pseudo" name="pseudo"> <br><br>

                    <label for="Motdepasse">Mot de passe :</label> <br>
                    <input type="password" placeholder="Entrer votre mot de passe" name="motdepasse"> <br><br>

                    

                    <label>
                        <input type="checkbox" name="remember"> Se souvenir de moi <br><br>
                    </label>
                    
                    <center>

                        <input type="submit" name="connexion" value="Connexion">
        
                    </center>

                </form>




            </center>     

            
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