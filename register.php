<?php
     //recuperer les données venant de la page HTML
    $nom = isset($_POST["nom"])? $_POST["nom"] : "";
    $prenom = isset($_POST["prenom"])? $_POST["prenom"] : "";
    $email = isset($_POST["email"])? $_POST["email"] : "";
    $motdepasse = isset($_POST["motdepasse"])? $_POST["motdepasse"] : "";
    $adresse = isset($_POST["adresse"])? $_POST["adresse"] : "";
    $codepostal = isset($_POST["codepostal"])? $_POST["codepostal"] : "";
    $ville = isset($_POST["ville"])? $_POST["ville"] : "";
    $telephone = isset($_POST["telephone"])? $_POST["telephone"] : "";
    $numcarte = isset($_POST["numcarte"])? $_POST["numcarte"] : "";
    $cvc = isset($_POST["cvc"])? $_POST["cvc"] : "";
    $moisexp = isset($_POST['moisexp'])? $_POST["moisexp"] : "";
    $anneeexp = isset($_POST['anneeexp'])? $_POST['anneeexp'] : "";

    //identifier votre BDD
    $database = "piscine2020";

    //connectez-vous dans votre BDD
    //Rappel: votre serveur = localhost | votre login = root |votre password = <rien>

    $db_handle = mysqli_connect('localhost', 'root', '');
    $db_found = mysqli_select_db($db_handle, $database);

    if ($_POST["inscription"]) 
    {
        
        if ($db_found) 
        {
            $sql = "SELECT * FROM acheteur";
            if ($nom != "") 
            {
                //on cherche le livre avec les paramètres titre et auteur
                $sql .= " WHERE Nom LIKE '%$nom%'";
                
                if ($prenom != "") 
                {
                    $sql .= " AND Prenom LIKE '%$prenom%'";
                }
            }
            
            $result = mysqli_query($db_handle, $sql);
            //regarder s'il y a de résultat
            if (mysqli_num_rows($result) != 0) 
            {
                //l'ahcteur est déjà enregistrer'
                echo "Vous êtes déjà enregistré";
            } 
            else 
            {
                $requete = "INSERT INTO acheteur(Nom, Prenom, Email, Motdepasse, Adresse, Codepostal, Ville, Telephone, Numcarte, Cvc, Moisexp, Anneeexp) VALUES('$nom', '$prenom', '$email', '$motdepasse', '$adresse', '$codepostal', '$ville', '$telephone', '$numcarte', '$cvc', '$moisexp', '$anneeexp')";
                    
                 $result = mysqli_query($db_handle, $requete);
            
                //regarder s'il y a de résultat
                if (mysqli_num_rows($result) != 0) 
                {
                    header("Location: http://localhost/ProjetPiscine2020/register.html");
                } 
                else
                {
                    header("Location: http://localhost/ProjetPiscine2020/compte.html");
                }
            }
           
            
        } 
        else 
        {
            echo "Database not found";
        }
    }
    //fermer la connexion
    mysqli_close($db_handle);
?>