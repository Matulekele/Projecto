<?php
require_once "../includes/conexao.php";
require_once "../includes/auth.php";

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $conn->query("DELETE FROM notificacoes WHERE id = $id");
}

header("Location: ../pages/notificacoes.php");
exit;