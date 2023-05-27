<?php
require 'request/todolist.dao.php';
require 'request/todo.dao.php';

    $todolist = getOne($_GET['id']);
    $todos = listTodo ($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = htmlspecialchars($_POST['title']);
            $result = addTodo($title, $_GET['id']);
            header('Location: index.php?page=todolist&id='.$_GET['id']);
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
    
    <div id="task-container">
        <div class="original-container">
        <form method="post">
            <input name="title" type="text" id="task-input" placeholder="Ajouter une tâche">
            <button id="add-task-btn">Ajouter</button>
            <ul id="task-list">
                <?php foreach($todos as $todo) { ?>
                    <?php if ($todo['is_done']) { ?>
                    <li><?php echo $todo["title"]?>  <input type="checkbox" checked></li>
                    <?php } else { ?>
                    <li><?php echo $todo["title"]?>  <input type="checkbox"></li>
                    <?php } ?>                <?php } ?>
            </ul>
        </div>

    </div>
            
    <script src="script.js"></script>

</body>
</html>