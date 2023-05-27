<?php

require 'config/db.php';

function getList()
{
    $dbh = getConnexion();
    $req = "SELECT * FROM todo_list WHERE `user_id` = :user_id";
    $stmt = $dbh->prepare($req);
    // Bind de la valeur en paramètre pour sécuriser la requête
    $stmt->bindValue(":user_id", $_SESSION['user']['id'], PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function addTodoList($title)
{
    $dbh=getConnexion();
    $req='INSERT INTO todo_list (title,user_id) VALUES(:title, :user_id)';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":user_id", $_SESSION['user']['id'], PDO::PARAM_INT);
    return $stmt->execute();
} 

function getOne($id)
{
    $dbh = getConnexion();
    $req = "SELECT * FROM todo_list WHERE `user_id` = :user_id and `id` = :id";
    $stmt = $dbh->prepare($req);
    // Bind de la valeur en paramètre pour sécuriser la requête
    $stmt->bindValue(":user_id", $_SESSION['user']['id'], PDO::PARAM_INT);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch();
}
