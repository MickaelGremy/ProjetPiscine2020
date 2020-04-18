<?php
    
    session_start();

    $bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');
    if(isset($_POST['connexion']))
    {
        $email = htmlspecialchars($_POST['email']);
        $motdepasse = sha1($_POST['motdepasse']);
        
        if(!empty($_POST['email']) AND !empty($_POST['motdepasse']))
        {
            $verifuser = $bdd->prepare("SELECT * FROM acheteur WHERE email = ? AND motdepasse = ?");
            $verifuser->execute(array($email, $motdepasse));
            $userexist = $verifuser->rowCount();
            
            if($userexist == 1)
            {
                $userinfo = $verifuser->fetch();
                $_SESSION['id'] = $userinfo['id'];
                $_SESSION['Email'] = $userinfo['Email'];
                $_SESSION['Motdepasse'] = $userinfo['Motdepasse'];
                header("Location: compte.php?id=".$_SESSION['id']);
            }
            else
            {
                $erreur = "Email inexistant cliquez sur inscription pour vous connecter";
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
        
        <title>Page Connexion</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="connexion.css">
        
    </head>
    
    <body>

        <div class="Bloc">

            <div class="imgcontainer">
                 <h1>Connexion acheteur</h1>
            <img src="avatar.jpg" class="user">
            </div>
            
            <center>




                <form action="connexionAcheteur.php" method="post">


                    <label for="Email">Email :</label> <br>
                    <input type="email" placeholder="Entrer votre E-mail" name="email"> <br><br>

                    <label for="Password">Mot de Passe :</label> <br>
                    <input type="password" placeholder="Entrer votre Mot de Passe" name="motdepasse"> <br><br>

                    <label>
                        <input type="checkbox" name="remember"> Se souvenir de moi <br><br>
                    </label>
                    
                    <center>

                    <input type="submit" name="connexion" value="Connexion">
                    <a href="register.php"><input type="button" name="inscription" value="Inscription"></a>
                        
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