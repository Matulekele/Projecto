<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $nome = $_POST['nome'];
    $modelo = $_POST['modelo'];
    $marca = $_POST['marca'];
    $localizacao = $_POST['localizacao'];
    $quantidade = $_POST['quantidade'];
    $categoria = $_POST['categoria'];
    $estado = $_POST['estado'];
    $responsavel = $_POST['responsavel'];
    $valoraquisicao = $_POST['valoraquisicao'];
    $dataaquisicao = $_POST['dataaquisicao'];
    $descricao = $_POST['descricao'];

    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $imagem = $_FILES['imagem'];
    $imageName = null;

    if (!empty($imagem['name'])) { 
        $imageName = basename($imagem['name']);
        $uploadPath = $uploadDir . $imageName;

        if (!move_uploaded_file($imagem['tmp_name'], $uploadPath)) {
            mensagem("
                <div class='error-message'>
                    <div class='message'>
                        Falha no upload da imagem para $nome.
                    </div>
                    <p><a href='../pages/cadastro.php'>Voltar</a></p>
                </div>", 'danger');
            exit;
        }
    }

    $sql = "INSERT INTO `patrimonio` 
            (`nome`, `localizacao`, `quantidade`, `categoria`, `estado`, `responsavel`, `valoraquisicao`, `dataaquisicao`, `descricao`, `modelo`, `marca`, `imagem`) 
            VALUES 
            ('$nome', '$localizacao', '$quantidade', '$categoria', '$estado', '$responsavel', '$valoraquisicao', '$dataaquisicao', '$descricao', '$modelo', '$marca', " . 
            ($imageName ? "'$imageName'" : "NULL") . ")";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = "O património <strong>$nome</strong> foi cadastrado com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "cadastro";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/patrimonios.php");
        exit();

    } else {
        mensagem("
            <div class='error-message'>
                <div class='message'>
                    Erro ao cadastrar $nome: " . mysqli_error($conn) . "
                </div>
                <p><a href='../pages/cadastro.php'>Voltar</a></p>
            </div>", 'danger');
    }

?>