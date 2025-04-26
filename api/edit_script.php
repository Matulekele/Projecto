<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";
                
    $id = $_POST['id'];

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

    $sql = "UPDATE `patrimonio` 
            SET `nome` = '$nome',
                `marca` = '$marca',
                `modelo` = '$modelo',
                `localizacao` = '$localizacao',
                `quantidade` = '$quantidade',
                `categoria` = '$categoria',
                `estado` = '$estado',
                `responsavel` = '$responsavel',
                `valoraquisicao` = '$valoraquisicao',
                `dataaquisicao` = '$dataaquisicao',
                `descricao` = '$descricao' 
            WHERE id_patrimonio = $id";

    if (mysqli_query($conn, $sql)) {

        $mensagemNotif = "O património <strong>$nome</strong> foi atualizado com sucesso por <strong>" . $_SESSION['name'] . "</strong>.";
        $tipoNotif = "edicao";

        $conn->query("INSERT INTO notificacoes (mensagem, tipo) VALUES ('$mensagemNotif', '$tipoNotif')");

        header("Location: ../pages/patrimonios.php");
        exit();

    } else {
        mensagem(" 
            <div class='error-message'>
                <div class='message'>
                    $nome Não foi alterado!
                </div>
                <p><a href='../pages/patrimonios.php'>Voltar</a></p>
            </div> ", 'danger');
    }

?>