<?php
     //recuperer les données venant de la page HTML
    $email = isset($_POST["email"])? $_POST["email"] : "";
    $motdepasse = isset($_POST["motdepasse"])? $_POST["motdepasse"] : "";

    //identifier votre BDD
    $database = "piscine2020";

    //connectez-vous dans votre BDD
    //Rappel: votre serveur = localhost | votre login = root |votre password = <rien>

    $db_handle = mysqli_connect('localhost', 'root', 'root');
    $db_found = mysqli_select_db($db_handle, $database);

    if ($_POST["connexion"]) 
    {
        
        if ($db_found) 
        {
            $sql = "SELECT * FROM acheteur";
            if ($email != "") 
            {
                //on cherche le livre avec les paramètres titre et auteur
                $sql .= " WHERE Email LIKE '%$email%'";
                
                if ($motdepasse != "") 
                {
                    $sql .= " AND Motdepasse LIKE '$motdepasse'";
                }
            }
            
            $result = mysqli_query($db_handle, $sql);
            
            //regarder s'il y a de résultat
            if (mysqli_num_rows($result) != 0) 
            {
                header("Location: http://localhost:8888/home.html");
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