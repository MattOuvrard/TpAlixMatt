<?php
namespace Includes;
use Controller/ProfilController;
session_start();

class Login {
	//$controller = new ProfilController();
	
if (isset($_POST['submit']))
{
    include 'dbh.inc.php';

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    if (empty($username) || empty($password))
    {
        //$controller->Login();
        exit();
    }
    else
    {
        $sql = "SELECT COUNT(*) FROM profils WHERE nom_utilisateur = '$username'";
        $result = $conn->query($sql);

        if ($result->fetchColumn() < 1)
        {
           // header("Location: ../View/login.php?login=error");
		   //$controller->Login();
            exit();
        }
        else
        {
            $sql = "SELECT * FROM profils WHERE nom_utilisateur = '$username'";
            $result = $conn->query($sql);
            $infoUser = $result->fetch(PDO::FETCH_ASSOC);

            if ($infoUser)
            {
                $passwordCheck = password_verify($password, $infoUser['mot_de_passe']);

                if ($passwordCheck == false)
                {
                    //header("Location: ../View/login.php?login=falsePassword");
					$controller->Login();
                    exit();
                }
                elseif ($passwordCheck == true)
                {
                    $_SESSION['uId'] = $infoUser['id'];
                    $_SESSION['uLastName'] = $infoUser['nom'];
                    $_SESSION['uFirstName'] = $infoUser['prenom'];
                    $_SESSION['uUsername'] = $infoUser['nom_utilisateur'];

					//var_dump($infoUser['id']);
					//$controller->ProfilHandler($infoUser['id']);
                    header("Location: /tpalixmatt/profil/" . $infoUser['id'] . "" );
                    exit();
                }
            }
        }
    }
}
else
{
    //header("Location: ../login.php?login=error");
	$controller->Login();
}

}