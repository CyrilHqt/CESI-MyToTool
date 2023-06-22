<?php

require 'config/db.php';

function login($email, $password)
{
    $dbh = getConnexion();
    $req = "SELECT * FROM user WHERE `email` = :email";
    $stmt = $dbh->prepare($req);
    // Bind de la valeur en paramètre pour sécuriser la requête
    $stmt->bindValue(":email", $email, PDO::PARAM_STR);
    $stmt->execute();
    $get_result = $stmt->fetch();

    if(empty($get_result))
    {
        header('Location: index.php?page=login');
        $_SESSION['Error'] = "Utilisateur ou Mot de passe incorrectnon";
    }   
    else
    {
        if(password_verify($password, $get_result["password"])){
            $_SESSION['user'] = $get_result;
            header('Location: index.php');
        }
    }
    return $get_result;
}
