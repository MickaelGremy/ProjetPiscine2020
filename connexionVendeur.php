<?php
    
    session_start();

    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_POST['connexion']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        
        
        if(!empty($_POST['pseudo']) AND !empty($_POST['email']))
        {
            $verifvendeur = $bdd->prepare("SELECT * FROM vendeur WHERE pseudo = ? AND email = ?");
            $verifvendeur->execute(array($pseudo, $email));
            $vendeurexist = $verifvendeur->rowCount();
            
            if($vendeurexist == 1)
            {
                $vendeurinfo = $verifvendeur->fetch();
                $_SESSION['id'] = $vendeurinfo['id'];
                $_SESSION['Pseudo'] = $userinfo['Pseudo'];
                $_SESSION['Email'] = $userinfo['Email'];
                header("Location: vente.php?id=".$_SESSION['id']);
            }
            else
            {
                $erreur = "Email inexistant ou pseudo erroné. Contactez l'administrateur";
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
        <link rel="stylesheet" type="text/css" href="navbar.css">
        
    </head>
 
    
    <body>
        
        
        

        <div class="Bloc">

            <div class="imgcontainer">
                <h1>Connexion vendeur</h1>
            <img src="avatar.jpg" class="user">
            </div>
            
            <center>




                <form action="connexionVendeur.php" method="post">

                    
                    <label for="Pseudo">Pseudo :</label> <br>
                    <input type="text" placeholder="Entrer votre Pseudo" name="pseudo"> <br><br>

                    <label for="Email">Email :</label> <br>
                    <input type="email" placeholder="Entrer votre E-mail" name="email"> <br><br>

                    

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