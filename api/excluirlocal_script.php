<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {
        $pesquisa = $_POST['busca'] ?? '';

        $id = $_POST['id'];
        $nome = $_POST['nome'];

        $sql = "DELETE FROM `localizacao` WHERE id_localizacao = $id";

        if (mysqli_query($conn, $sql)) {

            $mensagemNotif = "A localização <strong>$nome</strong> foi excluída com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
            $tipoNotif = "exclusao";

            $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

            header("Location: ../pages/localizacoes.php");
            exit();

        } else {
            mensagem(" 
                <div class='error-message'>
                    <div class='message'>
                        $nome não foi excluída!
                    </div>
                    <p>
                        <a href='../pages/localizacoes.php'>Voltar</a>
                    </p>
                </div> ", 'danger');
        }

    } else {
        mensagem( " 
            <div class='error-message'>
                <div class='message'>
                    Você não tem acesso a essa opção, é exclusivo para Administradores.
                </div>
                <p><a href='../pages/localizacoes.php'>Retroceder</a></p>
            </div>", '');
    }

?>
