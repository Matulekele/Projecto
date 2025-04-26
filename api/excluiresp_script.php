<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {
        $pesquisa = $_POST['busca'] ?? '';

        $id = $_POST['id'];
        $responsavel = $_POST['responsavel'];

        $sql = "DELETE FROM `responsaveis` WHERE id_responsavel = $id";

        if (mysqli_query($conn, $sql)) {

            // Notificação de exclusão
            $mensagemNotif = "O responsável <strong>$responsavel</strong> foi excluído com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
            $tipoNotif = "exclusao";

            $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

            header("Location: ../pages/responsaveis.php");
            exit();

        } else {
            mensagem(" 
                <div class='error-message'>
                    <div class='message'>
                        $responsavel não foi excluído!
                    </div>
                    <p>
                        <a href='../pages/responsaveis.php'>Voltar</a>
                    </p>
                </div> ", 'danger');
        }
    } else {
        header("Location: ../pages/responsaveis.php");
        exit();
    }

?>