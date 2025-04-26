<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {
        $pesquisa = $_POST['busca'] ?? '';
                
        $id = $_POST['id'];
        $nome = $_POST['nome'];

        $sql = "DELETE FROM `patrimonio` WHERE id_patrimonio = $id";

        if (mysqli_query($conn, $sql)) {

            $mensagemNotif = "O património <strong>$nome</strong> foi excluído com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
            $tipoNotif = "exclusao";

            $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

            header("Location: ../pages/patrimonios.php");
            exit();

        } else {
            mensagem(" 
                <div class='error-message'>
                    <div class='message'>
                        $nome Não foi excluído!
                    </div>
                    <p><a href='../pages/patrimonios.php'>Voltar</a></p>
                </div> ", 'danger');
        }

    } else {

        header("Location: ../pages/patrimonios.php");
        exit();
    }

?>