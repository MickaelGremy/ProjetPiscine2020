<?php

session_start();
$bdd = new PDO('mysql:host=127.0.0.1;dbname=piscine2020', 'root', '');

if(isset($_SESSION['id']))
{
    $verifuser = $bdd->prepare("SELECT * FROM acheteur WHERE id = ?");
    $verifuser->execute(array($_SESSION['id']));
    $user = $verifuser->fetch();
    

    
    if(isset($_POST['newemail']) AND !empty($_POST['newemail']))
    {
        
        $newemail = htmlspecialchars($_POST['newemail']);
        $verifcompte = $bdd->prepare("SELECT * FROM acheteur WHERE email = ?");
        $verifcompte->execute(array($newemail));
        $emailexist = $verifcompte->rowCount();
        if($emailexist == 0 OR $_POST['newemail'] == $user['Email'])
        {
            $insertemail = $bdd->prepare("UPDATE acheteur SET email = ? WHERE id = ?");   
            $insertemail->execute(array($newemail, $_SESSION['id']));
            header("Location: compte.php?id=".$_SESSION['id']);
        
            if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
            {
                $newnom = htmlspecialchars($_POST['newnom']);
                $insertnom = $bdd->prepare("UPDATE acheteur SET nom = ? WHERE id = ?");   
                $insertnom->execute(array($newnom, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
            {
                $newprenom = htmlspecialchars($_POST['newprenom']);
                $insertprenom = $bdd->prepare("UPDATE acheteur SET prenom = ? WHERE id = ?");   
                $insertprenom->execute(array($newprenom, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }



            if(isset($_POST['newmotdepasse']) AND !empty($_POST['newmotdepasse']) AND $_POST['newmotdepasse'] != $user['motdepasse'])
            {
                $newmotdepasse = sha1($_POST['newmotdepasse']);
                $insertmotdepasse = $bdd->prepare("UPDATE acheteur SET motdepasse = ? WHERE id = ?");   
                $insertmotdepasse->execute(array($newmotdepasse, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse'])
            {
                $newadresse = htmlspecialchars($_POST['newadresse']);
                $insertadresse = $bdd->prepare("UPDATE acheteur SET adresse = ? WHERE id = ?");   
                $insertadresse->execute(array($newadresse, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newcodepostal']) AND !empty($_POST['newcodepostal']) AND $_POST['newcodepostal'] != $user['codepostal'])
            {
                $newcodepostal = htmlspecialchars($_POST['newcodepostal']);
                $insertcodepostal = $bdd->prepare("UPDATE acheteur SET codepostal = ? WHERE id = ?");   
                $insertcodepostal->execute(array($newcodepostal, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newville']) AND !empty($_POST['newville']) AND $_POST['newville'] != $user['ville'])
            {
                $newville = htmlspecialchars($_POST['newville']);
                $insertville = $bdd->prepare("UPDATE acheteur SET ville = ? WHERE id = ?");   
                $insertville->execute(array($newville, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newtelephone']) AND !empty($_POST['newtelephone']) AND $_POST['newtelephone'] != $user['telephone'])
            {
                $newtelephone = htmlspecialchars($_POST['newtelephone']);
                $inserttelephone = $bdd->prepare("UPDATE acheteur SET telephone = ? WHERE id = ?");   
                $inserttelephone->execute(array($newtelephone, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newnumcarte']) AND !empty($_POST['newnumcarte']) AND $_POST['newnumcarte'] != $user['numcarte'])
            {
                $newnumcarte = htmlspecialchars($_POST['newnumcarte']);
                $insertnumcarte = $bdd->prepare("UPDATE acheteur SET numcarte = ? WHERE id = ?");   
                $insertnumcarte->execute(array($newnumcarte, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newcvc']) AND !empty($_POST['newcvc']) AND $_POST['newcvc'] != $user['cvc'])
            {
                $newcvc = htmlspecialchars($_POST['newcvc']);
                $insertcvc = $bdd->prepare("UPDATE acheteur SET cvc = ? WHERE id = ?");   
                $insertcvc->execute(array($newcvc, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newmoisexp']) AND !empty($_POST['newmoisexp']) AND $_POST['newmoisexp'] != $user['moisexp'])
            {
                $newmoisexp = htmlspecialchars($_POST['newmoisexp']);
                $insertmoisexp = $bdd->prepare("UPDATE acheteur SET moisexp = ? WHERE id = ?");   
                $insertmoisexp->execute(array($newmoisexp, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }

            if(isset($_POST['newanneeexp']) AND !empty($_POST['newanneeexp']) AND $_POST['newanneeexp'] != $user['anneeexp'])
            {
                $newanneeexp = htmlspecialchars($_POST['newanneeexp']);
                $insertanneeexp = $bdd->prepare("UPDATE acheteur SET anneeexp = ? WHERE id = ?");   
                $insertanneeexp->execute(array($newanneeexp, $_SESSION['id']));
                header("Location: compte.php?id=".$_SESSION['id']);
            }
            
            
        }
    
        else
        {
           $erreur = "L'adresse mail que vous avez rentrée est déjà utilisée"; 
        }
    }
    
    
    
?>




<html>
    
    <head>

        <title>Edition Profil</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="register.css">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    </head>

    <body style="background-color: #0c070a"> 

        <div class="Bloc">

            <form action="editionprofil.php" method="post">

                <center>
                <h1>Editer mon compte</h1>
                </center>

                <div class="row">

                    <div class="col">

                        <center>
                        <br> <h4>Identité</h4> <br>
                        </center>

                        <div class="input-group">
                            <input type="text" name="newnom" placeholder="Nom" 
                            value = "<?php echo $user['Nom'];?>"/>
                        </div>  

                        <div class="input-group">
                            <input type="text" name="newprenom" placeholder="Prénom" value = "<?php echo $user['Prenom'];?>"/>
                        </div>

                        <div class="input-group">
                            <input type="email" name="newemail" placeholder="E-mail" value = "<?php echo $user['Email'];?>"/>
                        </div>


                        <div class="input-group">
                            <input type="password" name="newmotdepasse" placeholder="Mot de Passe"/>
                        </div>

                    </div>



                    <div class="col">

                        <center>
                        <br> <h4>Adresse</h4> <br>
                        </center>

                        <div class="input-group">
                        <input type="text" name="newadresse" placeholder="Adresse" 
                        value = "<?php echo $user['Adresse'];?>"/>
                        </div>




                        <div class="input-group">
                        <input type="text" name="newcodepostal" placeholder="Code Postal" value = "<?php echo $user['Codepostal'];?>"/>
                        </div>

                        <div class="input-group">
                        <input type="text" name="newville" placeholder="Ville" 
                        value = "<?php echo $user['Ville'];?>"/>
                        </div>


                       <div class="input-group">
                        <input type="text" pattern="[0-9]{1}[0-9]{2}[0-9]{2}[0-9]{2}[0-9]{2}" name="newtelephone" placeholder="Numéro de Téléphone" value = "<?php echo $user['Telephone'];?>"/>
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
                            <input type="text" name="newnumcarte" pattern="[0-9]{16}" minlength="16" maxlength="16" placeholder="N° de la Carte" value = "<?php echo $user['Numcarte'];?>"/>
                        </div>


                        <div class="input-group">
                            <input type="text" name="newcvc" pattern="[0-9]{3}"  minlength="3" maxlength="3" placeholder="CVC" 
                            value = "<?php echo $user['Cvc'];?>"/>
                        </div>


                        <div class="input-group">

                            <input type="tel" pattern="[0-1]{1}[0-2]{1}" name="newmoisexp" placeholder="MM" 
                            value = "<?php echo $user['Moisexp'];?>">

                            <input type="tel" pattern="[2]{1}[0]{1}[2-3]{1}[0-9]{1}" name="newanneeexp" placeholder="YYYY" 
                            value = "<?php echo $user['Anneeexp'];?>">

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col">

                    <h4>Conditions d'utilisation</h4>

                    <div class="input-group">

                        <input name="cgu" id="terms" type="checkbox" required/>
                        <label for="terms">Je certifie que les données saisies sont exactes et confirme vouloir changer mes données en supprimant définitivement les anciennes</label>
                        </div>

                    </div>

                </div>

                <center>
                    <input type="submit" name="confirmer" value="Je confirme les changements">
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

<?php
    
}
else
{
    header("Location: connexionAcheteur.php");
}

?>