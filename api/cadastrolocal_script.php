<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO `localizacao`(`nome`, `descricao`) VALUES ('$nome','$descricao')";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = "A localização <strong>$nome</strong> foi cadastrada com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "cadastro";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/localizacoes.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $nome não foi cadastrada!
                </div>
                <p>
                    <a href='../pages/cadastrolocal.php'>Voltar</a>
                </p>
            </div> ", 'danger');
    }

?>