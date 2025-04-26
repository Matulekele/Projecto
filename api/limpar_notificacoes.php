<?php
    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    // Deleta notificações com mais de 7 dias
    $conn->query("DELETE FROM notificacoes WHERE data < NOW() - INTERVAL 7 DAY");

    header("Location: ../pages/notificacoes.php");
exit;