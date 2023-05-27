<?php


function listTodo($todolistId)
{
    $dbh = getConnexion();
    $req = "SELECT * FROM todo WHERE `todo_list_id` = :todo_list_id";
    $stmt = $dbh->prepare($req);
    // Bind de la valeur en paramètre pour sécuriser la requête
    $stmt->bindValue(":todo_list_id", $todolistId, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

function addTodo($title, $todolistId)
{
    $dbh=getConnexion();
    $req='INSERT INTO todo (title,todo_list_id) VALUES(:title, :todo_list_id)';
    $stmt = $dbh->prepare($req);
    $stmt->bindValue(":title", $title, PDO::PARAM_STR);
    $stmt->bindValue(":todo_list_id", $todolistId, PDO::PARAM_INT);
    return $stmt->execute();
} 
