
<?php
session_start();
if(isset($_POST['id']) && isset($_POST['password']))
{

    // connexion à la base de données
    $db_username = 'root';
    $db_password = '';
    $db_name     = 'new_vibe_db';
    $db_host     = 'localhost';
    $db = mysqli_connect($db_host, $db_username, $db_password,$db_name)
           or die('could not connect to database');

    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $id = mysqli_real_escape_string($db,htmlspecialchars($_POST['id']));
    $password = mysqli_real_escape_string($db,htmlspecialchars($_POST['password']));

    if($id !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateurs where
              nom = '".$id."' and password = '".$password."' ";
        $exec_requete = mysqli_query($db,$requete);
        $reponse      = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if($count!=0) // nom d'utilisateur et mot de passe correctes
        {
           $_SESSION['id'] = $id;
           header("Location: ../pages_php/Dashboard_id=$id.php");
        }
        else
        {
           header('Location: ../pages_php/login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
       header('Location: ../pages_php/login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
   header('Location: ../pages_php/login.php');
}
mysqli_close($db); // fermer la connexion
?>
