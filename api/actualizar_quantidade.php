<?php
include_once "../includes/conexao.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $acao = $_POST['acao'];

    $sql = "SELECT quantidade FROM patrimonio WHERE id_patrimonio = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $quantidade_atual = $row['quantidade'];

    if ($acao == 'aumentar') {
        $nova_quantidade = $quantidade_atual + 1;
    } elseif ($acao == 'diminuir' && $quantidade_atual > 0) {
        $nova_quantidade = $quantidade_atual - 1;
    } else {
        $nova_quantidade = $quantidade_atual;
    }

    $sql_update = "UPDATE patrimonio SET quantidade = $nova_quantidade WHERE id_patrimonio = $id";
    mysqli_query($conn, $sql_update);

    header("Location: ../pages/patrimonios.php");
    exit;
}
?>
