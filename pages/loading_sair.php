<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/loading.css">
    <link rel="icon" href="./icon/loader.png">
    <title>Terminando...</title>
</head>
<body>

    <?php
       require_once "../includes/auth.php";
    ?>

    <h1>Terminando, por favor aguarde...</h1>
    <script>
        setTimeout(function() {
            window.location.href = "logout.php";
        }, 1000);
    </script>
</body>
</html>