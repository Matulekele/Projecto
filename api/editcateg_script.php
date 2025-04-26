<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $id = $_POST['id'];
    $nome_categoria = $_POST['nome_categoria'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE `categoria` SET `nome_categoria` = '$nome_categoria', `descricao` = '$descricao' WHERE id_categoria = $id";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = "A categoria <strong>$nome_categoria</strong> foi actualizada com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "edicao";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/categorias.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $nome_categoria não foi alterada!
                </div>
                <p><a href='../pages/categorias.php'>Voltar</a></p>
            </div> ", 'danger')
        ;
    }

?>
