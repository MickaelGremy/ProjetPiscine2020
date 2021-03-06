<?php

$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');

if(isset($_POST['inscription']))
{
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['motdepasse']) AND !empty($_POST['adresse']) AND !empty($_POST['codepostal']) AND !empty($_POST['ville']) AND !empty($_POST['telephone']) AND !empty($_POST['numcarte']) AND !empty($_POST['cvc']) AND !empty($_POST['moisexp']) AND !empty($_POST['anneeexp']))
    {
        if(!empty($_POST['cgu']))
        {
            $nom = htmlspecialchars($_POST['nom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $email = htmlspecialchars($_POST['email']);
            $motdepasse = sha1($_POST['motdepasse']);
            $adresse = htmlspecialchars($_POST['adresse']);
            $codepostal = htmlspecialchars($_POST['codepostal']);
            $ville = htmlspecialchars($_POST['ville']);
            $telephone = htmlspecialchars($_POST['telephone']);
            $numcarte = htmlspecialchars($_POST['numcarte']);
            $cvc = htmlspecialchars($_POST['cvc']);
            $moisexp = htmlspecialchars($_POST['moisexp']);
            $anneeexp = htmlspecialchars($_POST['anneeexp']);




            $verifcompte = $bdd->prepare("SELECT * FROM acheteur WHERE email = ?");
            $verifcompte->execute(array($email));
            $emailexist = $verifcompte->rowCount();
             
            if($emailexist == 0)
            {

                $insertacheteur = $bdd->prepare("INSERT INTO acheteur(Nom, Prenom, Email, Motdepasse, Adresse, Codepostal, Ville, Telephone, Numcarte, Cvc, Moisexp, Anneeexp) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)");
                $insertacheteur->execute(array($nom, $prenom, $email, $motdepasse, $adresse, $codepostal, $ville, $telephone, $numcarte, $cvc ,$moisexp ,$anneeexp));
                $erreur="Compte créé. Connectez-vous pour accéder à voter compte.";

            }

            else
            {
                $erreur="Email déjà utilisé cliquez sur connexion pour vous connecter";
            }

        }
        
        else
        {
            $erreur="Merci de bien vouloir accepter les CGU";
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

        <title>Register Page</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="register.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>

    <body style="background-color: #0c070a"> 

        <div class="Bloc">

            <form action="register.php" method="post">

                <center>
                <h1>Mon Compte</h1>
                </center>

                <div class="row">

                    <div class="col">

                        <center>
                        <br> <h4>Identité</h4> <br>
                        </center>

                        <div class="input-group">
                            <input type="text" name="nom" placeholder="Nom" required/>
                        </div>

                        <div class="input-group">
                            <input type="text" name="prenom" placeholder="Prénom" required/>
                        </div>

                        <div class="input-group">
                            <input type="email" name="email" placeholder="E-mail" required/>   
                        </div>


                        <div class="input-group">
                            <input type="password" name="motdepasse" placeholder="Mot de Passe" required/>
                        </div>

                    </div>



                    <div class="col">

                        <center>
                        <br> <h4>Adresse</h4> <br>
                        </center>

                        <div class="input-group">
                        <input type="text" name="adresse" placeholder="Adresse" required/>
                        </div>




                        <div class="input-group">
                        <input type="text" name="codepostal" placeholder="Code Postal" required/>
                        </div>

                        <div class="input-group">
                        <input type="text" name="ville" placeholder="Ville" required/>
                        </div>


                       <div class="input-group">
                        <input type="text" pattern="[0]{1}[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" name="telephone" placeholder="N° de Téléphone (0XXXXXXXXX)" required/>
                        </div>


                    </div>


                    <div class="col">

                        <center>
                        <br> <h4>Moyen de Paiement</h4> <br>
                        </center>

                        <div class="input-group">

                            <input id="payment-method-card" type="radio" name="payment-method" value="card" checked="true"/>

                            <label for="payment-method-card"><span><i class="visa"></i>Carte Bleue</span></label>

                            <input id="payment-method-chequecadeau" type="radio" name="payment-method" value="chequecadeau"/>

                            <label for="payment-method-chequecadeau"> <span><i class="chequecadeau"></i>Chèques ECE</span></label>

                        </div>

                        <div class="input-group">
                            <input type="text" name="numcarte" pattern="[0-9]{16}" minlength="16" maxlength="16" placeholder="N° de la Carte" required/>
                        </div>


                        <div class="input-group">
                            <input type="text" name="cvc" pattern="[0-9]{3}" minlength="3" maxlength="3" placeholder="CVC" required/>
                        </div>


                        <div class="input-group">

                            <input type="tel" pattern="[0-1]{1}[0-2]{1}" name="moisexp" placeholder="MM" required>

                            <input type="tel" pattern="[2]{1}[0]{1}[2-3]{1}[0-9]{1}" name="anneeexp" placeholder="YYYY" required>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col">

                    <h4>Conditions d'utilisation</h4>

                    <div class="input-group">

                        <input name="cgu" id="terms" type="checkbox" required/>
                        <label for="terms">Je certifie avoir lu et accepte les CGU d'Ebay ECE afin d'accéder à la plateforme.</label>
                        </div>

                    </div>

                </div>

                <center>
                    <input type="submit" name="inscription" value="S'inscrire">
                    <a href="connexionAcheteur.php"><input type="button" name="connexion" value="Se connecter"></a>
                </center>

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