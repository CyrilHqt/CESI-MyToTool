<?php
require 'request/todolist.dao.php';
require 'request/todo.dao.php';

$todolist = getOne($_GET['id']);
$todos = listTodo($_GET['id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST["type"] === "ajout") {
        $title = htmlspecialchars($_POST['title']);
        $result = addTodo($title, $_GET['id']);
        header('Location: index.php?page=todolist&id=' . $_GET['id']);
        exit;
    } elseif ($_POST["type"] === "suppression") {
        $result = deleteTodo($_POST['idTodo']);
        header('Location: index.php?page=todolist&id=' . $_GET['id']);
        exit;
    } elseif ($_POST["type"] === "modification") {
        $newTitle = htmlspecialchars($_POST['newTitle']);
        $result = updateTodoTitle($_POST['idTodo'], $newTitle);
        header('Location: index.php?page=todolist&id=' . $_GET['id']);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="public\assets\main.css">
    <title>MyToTool</title>
</head>
<body>
<!-- Modification d'une tache -->
<div id="task-container">
    <div class="original-container">
        <h2><?php echo $todolist['title']; ?></h2>
    </div>
</div>

<!-- Ajout d'une tache -->
<div class="row" id="task-container">
    <div class="original-container">
        <form method="post">
            <div class="col-md-4">
                <div class="input-group">
                    <input type="hidden" name="type" value="ajout"/>
                    <input class="form-control" name="title" type="text" id="task-input" placeholder="Ajouter une tâche">
                    <button class="btn btn-primary" id="add-task-btn">Ajouter</button>
                </div>
            </div>
        </form>
</br>
        <ul id="task-list">
            <?php foreach ($todos as $todo) { ?>
                <?php if ($todo['is_done']) { ?>
                    <li>
                        <div class="d-flex align-items-center">
                            <span class="task-title"><?php echo $todo["title"] ?></span>
                            <input type="checkbox" checked>
                            <form class="modify-task-form" action="" method="POST">
                                <input type="hidden" name="idTodo" value="<?= $todo['id'] ?>" />
                                <input type="hidden" name="type" value="modification" />
                                <input class="inputModif" type="text" name="newTitle" placeholder="Modifier la tâche" required />
                                <input type="submit" value="Modifier" class="btn btn-outline-primary mx-2" />
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" name="idTodo" value="<?= $todo['id'] ?>" />
                                <input type="hidden" name="type" value="suppression" />
                                <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                            </form>
                        </div>
                    </li>
                <?php } else { ?>
                    <li>
                        <div class="d-flex align-items-center">
                            <span class="task-title"><?php echo $todo["title"] ?></span>
                            <input type="checkbox">
                            <form class="modify-task-form" action="" method="POST">
                                <input type="hidden" name="idTodo" value="<?= $todo['id'] ?>" />
                                <input type="hidden" name="type" value="modification" />
                                <input class="inputModif" type="text" name="newTitle" placeholder="Modifier la tâche" required />
                                <input type="submit" value="Modifier" class="btn btn-outline-primary mx-2" />
                            </form>
                        <!-- Suppression d'une tache -->
                            <form action="" method="POST">
                                <input type="hidden" name="idTodo" value="<?= $todo['id'] ?>" />
                                <input type="hidden" name="type" value="suppression" />
                                <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                            </form>
                        </div>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>

<script src="public\assets\script.js"></script>

</body>
</html>
