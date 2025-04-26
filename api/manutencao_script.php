<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $id_patrimonio = $_POST['id_patrimonio'];
    $id_localizacao = $_POST['id_localizacao'];
    $tipo_manutencao = $_POST['tipo_manutencao'];
    $descricao_problema = $_POST['descricao_problema'];
    $prioridade = $_POST['prioridade'];
    $id_responsavel = $_POST['id_responsavel'];
    $data_pedido = $_POST['data_pedido'];
    $data_inicio = $_POST['data_inicio'];
    $data_conclusao = $_POST['data_conclusao'];
    $status = $_POST['status'];
    $observacao = $_POST['observacao'];

    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imagem = $_FILES['imagem'];
    $imageName = null;

    if (!empty($imagem['name'])) {
        $extensao = pathinfo($imagem['name'], PATHINFO_EXTENSION);
        $imageName = time() . '_' . uniqid() . '.' . $extensao;
        $uploadPath = $uploadDir . $imageName;

        if (!move_uploaded_file($imagem['tmp_name'], $uploadPath)) {
            mensagem("
                <div class='error-message'>
                    <div class='message'>
                        Falha no upload da imagem.
                    </div>
                    <p><a href='../pages/cadastro.php'>Voltar</a></p>
                </div>", 'danger');
            exit;
        }
    }

    $sql = "INSERT INTO manutencao 
            (id_patrimonio, id_localizacao, tipo_manutencao, descricao_problema, prioridade, id_responsavel, data_pedido, data_inicio, data_conclusao, status, observacao, imagem) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssissssss", $id_patrimonio, $id_localizacao, $tipo_manutencao, $descricao_problema, $prioridade, $id_responsavel, $data_pedido, $data_inicio, $data_conclusao, $status, $observacao, $imageName);

    if ($stmt->execute()) {

        $usuario = $_SESSION['name'];
        $mensagemNotif = "Uma nova manutenção foi cadastrada para o património <strong>ID $id_patrimonio</strong> por <strong>$usuario</strong>.";
        $tipoNotif = "cadastro";

        $stmt_notif = $conn->prepare("INSERT INTO notificacoes (mensagem, tipo) VALUES (?, ?)");
        $stmt_notif->bind_param("ss", $mensagemNotif, $tipoNotif);
        $stmt_notif->execute();
        $stmt_notif->close();

        header("Location: ../pages/cadastroman.php");
        exit();

    } else {
        mensagem("
            <div class='error-message'>
                <div class='message'>
                    Erro ao cadastrar: " . $stmt->error . "
                </div>
                <p><a href='../pages/cadastroman.php'>Voltar</a></p>
            </div>", 'danger');
    }

    $stmt->close();
    $conn->close();

?>