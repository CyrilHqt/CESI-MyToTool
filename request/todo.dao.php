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

function deleteTodo($id)
{
    $dbh = getConnexion();
    $req = "DELETE FROM todo WHERE id = :id";
    $stmt= $dbh->prepare($req);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    return $stmt->execute();
}


// Fonction pour mettre à jour le titre d'une tâche
function updateTodoTitle($todoId, $newTitle) {
    // Connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mytotool";

    // Création d'une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    // Préparation de la requête de mise à jour
    $sql = "UPDATE todo SET title = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    // Vérification de la préparation de la requête
    if (!$stmt) {
        die("Erreur de préparation de la requête : " . $conn->error);
    }

    // Liaison des paramètres de la requête
    $stmt->bind_param("si", $newTitle, $todoId);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo "Le titre de la tâche a été mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour du titre de la tâche : " . $stmt->error;
    }

    // Fermeture de la connexion et de la déclaration
    $stmt->close();
    $conn->close();
}
