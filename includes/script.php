<ul class="links">
    <li><a href="home.php"><i class="fi fi-sr-home menu-icone"></i></a></li>

    <?php if ($_SESSION['nivel_acesso'] === 'admin') : ?>
        <li><a href="usuarios.php" title="Gerenciar Usuários"><i class="fi fi-sr-settings menu-icone"></i></a></li>
    <?php endif; ?>

    <li><a href="perfil.php"><i class="fi fi-sr-user menu-icone"></i></a></li>
    <li><a href="logout.php"><i class="fi fi-sr-power menu-icone"></i></a></li>
</ul>


<?php if ($_SESSION['nivel_acesso'] === 'admin') : ?>
<?php endif; ?>



<?php
session_start();

if (!isset($_SESSION['nivel_acesso']) || $_SESSION['nivel_acesso'] !== 'admin') {
    // Redireciona para uma página de erro ou para a home
    header("Location: ../pages/acesso_negado.php");
    exit;
}
?>






<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Acesso Negado</title>
    <style>
        body {
            background: #f2f2f2;
            font-family: Arial, sans-serif;
            text-align: center;
            padding-top: 100px;
        }
        h1 {
            color: red;
        }
        a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>🚫 Acesso negado!</h1>
    <p>Você não tem permissão para acessar esta página.</p>
    <p><a href="home.php">Voltar para o início</a></p>
</body>
</html>
