<?php require 'request/todolist.dao.php'; ?>

<?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $result = addTodoList($title);
            header('Location: index.php');
        }
    ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>MyToTool</title>
</head>
<body>
<?php 
    if (isset($_SESSION['user'])){
        $todolists = getList();
    ?>
<!--Ajout de la liste-->
    <div id="task-container">
        <div class="original-container">
        <form method="post">
            <input name="title" type="text" id="task-input" placeholder="Ajouter une liste de tâches">
            <button id="add-task-btn">Ajouter</button>
        <form>
            <ul id="task-list">
                <?php foreach($todolists as $todolist) { ?>
                    <li>
                    <a href="index.php?page=todolist&id=<?php echo $todolist['id']?>" ><?php echo $todolist["title"]?></a>
                    </li>
<!--Suppression de la liste-->
                        <form action="" method="POST">
                                <input type="hidden" name="idTodolist" value="<?= $todolist['id'] ?>" />
                                <input type="hidden" name="type" value="suppression" />
                                <input type="submit" value="Supprimer" class="btn btn-outline-danger" />
                        </form>

                    <?php } ?>
            </ul>
        </div>

    </div>
    <?php } else { ?>
        <h4>Bienvenu sur MyToTool.</h4>
        <p><a href="index.php?page=login">Connectez-vous</a> pour utiliser l'app !</p>
        <?php } ?>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = $_POST['task'];
            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit;
        }
    ?>
        
    <script src="script.js"></script>

</body>
</html>