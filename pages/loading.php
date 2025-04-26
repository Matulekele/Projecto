<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/loading.css">
    <link rel="icon" href="./icon/loader.png">
    <title>Carregando...</title>
</head>
<body>

    <?php
        require_once "../includes/auth.php";
    ?>

    <h1>Carregando, por favor aguarde...</h1>
    <div class="loader" id="loader"></div>
    <script>
        setTimeout(function() {
            window.location.href = "dashboard.php";
        }, 1000);
    </script>

</body>
</html>