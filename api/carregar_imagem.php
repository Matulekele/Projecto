<?php
include_once "../includes/conexao.php";
include_once "../includes/auth.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_patrimonio = $_POST['id_patrimonio'];
    $imagem = $_FILES['imagem'];

    if ($imagem['error'] == UPLOAD_ERR_OK) {
        
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $imagem_nome = uniqid() . '.' . $extensao;

        $caminho_upload = "../uploads/" . $imagem_nome;

        if (move_uploaded_file($imagem['tmp_name'], $caminho_upload)) {
            
            $sql = "UPDATE patrimonio SET imagem = '$imagem_nome' WHERE id_patrimonio = '$id_patrimonio'";

            if (mysqli_query($conn, $sql)) {
                header("Location: ../pages/visualizar.php?id=$id_patrimonio");
                exit;
            } else {
                die("Erro ao atualizar a imagem no banco de dados: " . mysqli_error($conn));
            }
        } else {
            die("Erro ao fazer upload da imagem.");
        }
    } else {
        die("Erro ao carregar a imagem. Código de erro: " . $imagem['error']);
    }
} else {
    die("Método de requisição inválido.");
}
?>