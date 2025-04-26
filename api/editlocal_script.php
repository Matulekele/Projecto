<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "UPDATE `localizacao` SET `nome` = '$nome', `descricao` = '$descricao' WHERE id_localizacao = $id";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = "A localização <strong>$nome</strong> foi atualizada com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "edicao";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/localizacoes.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $nome não foi alterada!
                </div>
                <p>
                    <a href='../pages/localizacoes.php'>Voltar</a>
                </p>
            </div> ", 'danger');
    }

?>
