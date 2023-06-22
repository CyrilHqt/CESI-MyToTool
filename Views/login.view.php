<?php require 'request/auth.dao.php';

if (isset($_SESSION['user'])) {
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
    <link rel="stylesheet" href="public\assets\main.css">
    <title><?php $page_title ?></title>
</head>
<body class="mh-100">
<main class="main">
    <div class="form-group">
        <?php if (isset($_SESSION['Error'])){
            echo $_SESSION["Error"];
        } ?>
        <form method="post">
            <label for="email"><b>Email</b></label>
            <input class="form-control" type="text" placeholder="Entrer email" name="email" required>

            <label for="password"><b>Mot de passe</b></label>
            <input class="form-control" type="password" placeholder="Entrer mot de passe" name="password" required>

            <button class="btn btn-primary" type="submit">Se connecter</button>
        </form>
    </div> 

    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            login($email, $password);
            exit;
        }
    ?>
</main>       
    <script src="public\assets\script.js"></script>

</body>
</html>
