<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {
        $pesquisa = $_POST['busca'] ?? '';

        $id = $_POST['id'];
        $nome_categoria = $_POST['nome_categoria'];

        $sql = "DELETE FROM `categoria` WHERE id_categoria = $id";

        if (mysqli_query($conn, $sql)) {

            $mensagemNotif = "A categoria <strong>$nome_categoria</strong> foi excluída com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
            $tipoNotif = "exclusao";

            $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

            header("Location: ../pages/categorias.php");
            exit();

        } else {
            mensagem(" 
                <div class='error-message'>
                    <div class='message'>
                        $nome_categoria não foi excluída!
                    </div>
                    <p><a href='../pages/categorias.php'>Voltar</a></p>
                </div> ", 'danger');
        }

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    Você não tem acesso a essa opção, é exclusivo para Administradores
                </div>
                <p><a href='../pages/categorias.php'>Retroceder</a></p>
            </div>", 'danger')
        ;
    }

?>
