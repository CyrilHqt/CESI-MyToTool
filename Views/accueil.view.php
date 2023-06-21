<?php require 'request/todolist.dao.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST["type"] === "ajout") {
        $title = htmlspecialchars($_POST['title']);
        $result = addTodoList($title);
        header('Location: index.php');
        exit;
    } elseif ($_POST["type"] === "suppression") {
        $result = deleteList($_POST['idTodolist']);
        header('Location: index.php');
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
<?php 
if (isset($_SESSION['user'])) {
    $todolists = getList();
    ?>
    <!--Ajout de la liste-->
    <div id="task-container">
        <div class="original-container">
            <form method="post">
                <div class="col-md-4">
                    <div class="input-group">
                        <input name="title" type="text" id="task-input" placeholder="Ajouter une liste de tâches">
                        <input type="hidden" name="type" value="ajout">
                        <button class="btn btn-primary" id="add-task-btn">Ajouter</button>
                    </div>
                </div>
            </form>
            <ul id="task-list">
                <?php foreach ($todolists as $todolist) { ?>
                    <li>
                        <div class="task-item">
                            <a class="btn btn-success" href="index.php?page=todolist&id=<?php echo $todolist['id'] ?>"><?php echo $todolist["title"] ?></a>
                            <!--Suppression de la liste-->
                            <form action="" method="POST">
                                <input type="hidden" name="idTodolist" value="<?= $todolist['id'] ?>" />
                                <input type="hidden" name="type" value="suppression" />
                                <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                            </form>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
<?php } else { ?>
    <h4>Bienvenue sur MyToTool.</h4>
    <p><a class="btn btn-primary" href="index.php?page=login">Connectez-vous</a> pour utiliser l'app !</p>
<?php } ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task = $_POST['task'];
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}
?>

<style>
    .task-item {
        display: flex;
        align-items: center;
    }

    .task-item form {
        margin-left: 10px;
    }
</style>

<script src="public\assets\script.js"></script>
</body>
</html>
