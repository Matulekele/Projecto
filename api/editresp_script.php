<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    $id = $_POST['id'];
    $responsavel = $_POST['responsavel'];
    $celular = $_POST['celular'];
    $cargo = $_POST['cargo'];
    $endereco = $_POST['endereco'];

    $sql = "UPDATE `responsaveis` 
            SET `responsavel` = '$responsavel', 
                `celular` = '$celular', 
                `cargo` = '$cargo', 
                `endereco` = '$endereco' 
            WHERE id_responsavel = $id";

    if (mysqli_query($conn, $sql)) {

        // Notificação
        $mensagemNotif = "Os dados do responsável <strong>$responsavel</strong> foram editado com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "edicao";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/responsaveis.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $responsavel não foi alterado!
                </div>
                <p>
                    <a href='../pages/responsaveis.php'>Voltar</a>
                </p>
            </div> ", 'danger');
    }

?>