<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {

        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $id = $_POST['id'];

            $sql = "DELETE FROM `movimentacao` WHERE id_movimentacao = $id";

            if (mysqli_query($conn, $sql)) {

                // Notificação
                $mensagemNotif = "A movimentação com ID <strong>$id</strong> foi excluída por <strong>" . $_SESSION['name'] . "</strong>.";
                $tipoNotif = "movimentacao";

                $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

                header("Location: ../pages/movimentacoes.php");
                exit();

            } else {
                mensagem("
                    <div class='error-message'>
                        <div class='message'>Erro ao excluir a movimentação.</div>
                        <p><a href='../pages/movimentacoes.php'>Voltar</a></p>
                    </div>", 'danger');
            }

        } else {
            mensagem("
                <div class='error-message'>
                    <div class='message'>ID da movimentação não especificado.</div>
                    <p><a href='../pages/movimentacoes.php'>Voltar</a></p>
                </div>", 'danger');
        }

    } else {
        mensagem("
            <div class='error-message'>
                <div class='message'>Você não tem acesso a essa opção, apenas administradores.</div>
                <p><a href='../pages/movimentacoes.php'>Retroceder</a></p>
            </div>", 'danger');
    }

?>
