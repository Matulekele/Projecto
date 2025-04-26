<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $nome_categoria = $_POST['nome_categoria'];
    $descricao = $_POST['descricao'];

    $sql = "INSERT INTO `categoria`(`nome_categoria`, `descricao`) VALUES ('$nome_categoria','$descricao')";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = "A categoria <strong>$nome_categoria</strong> foi cadastrada com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "cadastro";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/categorias.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $nome_categoria não foi cadastrada!
                </div>
                <p>
                    <a href='../pages/cadastrocateg.php'>Voltar</a>
                </p>
            </div>  ", 'danger');
    }

?>