<?php

use Controller/ProfilController;

if (isset($_POST['submit']))
{
    include_once 'dbh.inc.php';

    $lastname = htmlspecialchars($_POST['lastname']);
    $firstname = htmlspecialchars($_POST['firstname']);
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    //Error handlers
    //Empty fields
    if (empty($lastname) || empty($firstname) || empty($username) || empty($password))
    {
        header("Location: ../View/signup.php?signup=empty");
        exit();
    }
    else
    {
        //Invalid characters
        if (!preg_match("/^[a-zA-Z]*$/", $lastname) || !preg_match("/^[a-zA-Z]*$/", $firstname))
        {
            header("Location: ../View/signup.php?signup=invalid");
            exit();
        }
        else
        {
            $sql = "SELECT COUNT(*) FROM profils WHERE nom_utilisateur = '$username'";
            $result = $conn->query($sql);

            if ($result->fetchColumn() > 0)
            {
                header("Location: ../View/signup.php?signup=taken");
                exit();
            }
            else
            {
                //Password hashing
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                //Insert the user in the database
                $sql = "INSERT INTO profils (nom, prenom, nom_utilisateur, mot_de_passe) VALUES ('$lastname', '$firstname', '$username', '$hashedPassword')";

                $conn->query($sql);

                header("Location:".);
                exit();
            }
        }
    }
}
else
{
    header("Location: ../View/signup.php");
    exit();
}