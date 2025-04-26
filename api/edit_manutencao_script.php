<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id_manutencao = $_POST['id_manutencao'];
        $id_patrimonio = $_POST['id_patrimonio'];
        $id_localizacao = $_POST['id_localizacao'];
        $tipo_manutencao = $_POST['tipo_manutencao'];
        $prioridade = $_POST['prioridade'];
        $descricao_problema = $_POST['descricao_problema'];
        $id_responsavel = $_POST['id_responsavel'];
        $data_pedido = $_POST['data_pedido'];
        $data_inicio = $_POST['data_inicio'];
        $data_conclusao = $_POST['data_conclusao'];
        $status = $_POST['status'];
        $observacao = $_POST['observacao'];

        $sql = "UPDATE manutencao SET 
                id_patrimonio = ?, 
                id_localizacao = ?, 
                tipo_manutencao = ?, 
                prioridade = ?, 
                descricao_problema = ?, 
                id_responsavel = ?, 
                data_pedido = ?, 
                data_inicio = ?, 
                data_conclusao = ?, 
                status = ?, 
                observacao = ? 
                WHERE id_manutencao = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iisssisssssi", $id_patrimonio, $id_localizacao, $tipo_manutencao, $prioridade, $descricao_problema, $id_responsavel, $data_pedido, $data_inicio, $data_conclusao, $status, $observacao, $id_manutencao);

        if ($stmt->execute()) {

            // REGISTRA NOTIFICAÇÃO
            $usuario = $_SESSION['name'];
            $mensagemNotif = "A manutenção <strong>ID $id_manutencao</strong> foi actualizada com sucesso por <strong>$usuario</strong>.";
            $tipoNotif = "cadastro";

            $stmt_notif = $conn->prepare("INSERT INTO notificacoes (mensagem, tipo) VALUES (?, ?)");
            $stmt_notif->bind_param("ss", $mensagemNotif, $tipoNotif);
            $stmt_notif->execute();
            $stmt_notif->close();

            header("Location: ../pages/manutencoes.php");
            exit();

        } else {
            mensagem("
                <div class='error-message'>
                    <div class='message'>
                        Erro ao modificar o registro: " . $stmt->error . "
                    </div>
                    <p><a href='../pages/manutencoes.php'>Voltar</a></p>
                </div>", 'danger');
        }

        $stmt->close();
        $conn->close();
    }

?>
