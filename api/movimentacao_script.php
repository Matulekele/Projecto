<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if (!isset($_SESSION['name']) || $_SESSION['nivel_acesso'] !== 'Admin') {
        die("Acesso negado.");
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_patrimonio = $_POST['id_patrimonio'];
        $id_localantigo = $_POST['id_localantigo'];
        $id_localnovo = $_POST['id_localnovo'];
        $id_responsavel = $_POST['id_responsavel'];
        $estado = $_POST['estado'];
        $motivo = $_POST['motivo'];
        $datamovimentacao = $_POST['datamovimentacao'];

        $query = "INSERT INTO movimentacao (id_patrimonio, id_localantigo, id_localnovo, id_responsavel, estado, motivo, datamovimentacao) 
                VALUES ('$id_patrimonio', '$id_localantigo', '$id_localnovo', '$id_responsavel', '$estado', '$motivo', '$datamovimentacao')";

        if (mysqli_query($conn, $query)) {

            $update_query = "UPDATE patrimonio SET localizacao = '$id_localnovo' WHERE id_patrimonio = '$id_patrimonio'";
            mysqli_query($conn, $update_query);

            // Notificação
            $mensagemNotif = "O património de ID <strong>$id_patrimonio</strong> foi movido de <strong>$id_localantigo</strong> para <strong>$id_localnovo</strong> por <strong>" . $_SESSION['name'] . "</strong>.";
            $tipoNotif = "movimentacao";

            $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

            header("Location: ../pages/cadastromov.php");
            exit();

        } else {
            mensagem(" 
                <div class='error-message'>
                    <div class='message'>
                        Erro ao registrar a movimentação!
                    </div>
                    <p><a href='../pages/cadastromov.php'>Voltar</a></p>
                </div> ", 'danger')
            ;
        }
    }

    mysqli_close($conn);
?>
