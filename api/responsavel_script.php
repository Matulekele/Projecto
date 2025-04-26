<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $responsavel = $_POST['responsavel'];
    $genero = $_POST['genero'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $cargo = $_POST['cargo'];

    $sql = "INSERT INTO `responsaveis`(`responsavel`,`genero`, `celular`,`endereco`,`cargo`) 
            VALUES ('$responsavel','$genero','$celular','$endereco','$cargo')";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = " Foi cadastrado, responsável <strong>$responsavel</strong> com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "cadastro";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/responsaveis.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $responsavel não foi cadastrado!
                </div>
                <p>
                    <a href='../pages/cadresponsavel.php'>Voltar</a>
                </p>
            </div>  ", 'danger');
    }

?>