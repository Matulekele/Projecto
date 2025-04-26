<?php
    
    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $id_manutencao = $_GET['id'] ?? '';

    if ($id_manutencao) {
        $sql = "
            SELECT 
                manutencao.id_manutencao,
                patrimonio.nome AS patrimonio,
                localizacao.nome AS localizacao,
                manutencao.tipo_manutencao,
                manutencao.descricao_problema,
                manutencao.prioridade,
                responsaveis.responsavel AS responsavel,
                manutencao.data_pedido,
                manutencao.data_inicio,
                manutencao.data_conclusao,
                manutencao.status,
                manutencao.observacao,
                manutencao.imagem
            FROM manutencao
            INNER JOIN patrimonio ON manutencao.id_patrimonio = patrimonio.id_patrimonio
            LEFT JOIN localizacao ON manutencao.id_localizacao = localizacao.id_localizacao
            LEFT JOIN responsaveis ON manutencao.id_responsavel = responsaveis.id_responsavel
            WHERE manutencao.id_manutencao = '$id_manutencao'
        ";
        
        $resultado = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($resultado) > 0) {
            $manutencao = mysqli_fetch_assoc($resultado);
        } else {
            die("Manutenção não encontrada.");
        }
    } else {
        die("ID da manutenção não fornecido.");
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Visualizar Manutenção</title>
    <style>
        .visualizar-bem .voltar{
            position: absolute;
            top: -25px;
            right: 0;
        }
        .icone-op{
            color: var(--primary);
            font-size: 40px;
            transition: .3s ease-out;
            display: inline-block;
        }
        .icone-op:hover{
            transform: scale(1.1);
        }
    </style>
</head>
<body>



    <main class="container-visualizar">
        <div class="visualizar-bem" style="position: relative;">
            <header class="header">
                <i class="fi fi-sr-tools icone-x"></i>
                <span>Detalhes da Manutenção</span>
            </header>

            <div class="container-infor">
                <div class="image-container">
                    <?php if (!empty($manutencao['imagem'])): ?>
                        <img src="../uploads/<?php echo $manutencao['imagem']; ?>" alt="Imagem da Manutenção">
                    <?php else: ?>
                        <form action="../api/carregar_imagem_manutencao.php" method="POST" enctype="multipart/form-data" class="imagem-form">
                            <p style="color: #ff6384;">Imagem não disponível.</p>
                            <input type="hidden" name="id_manutencao" value="<?php echo $id_manutencao; ?>">
                            <label for="imagem">Adicionar uma Imagem:</label>
                            <input type="file" name="imagem" id="imagem" accept="image/*" required>
                            <button type="submit">Carregar Imagem</button>
                        </form>
                    <?php endif; ?>
                </div>
                
                <div class="infor">
                    <div class="text">
                        <p><span>ID:</span> <span><?php echo $manutencao['id_manutencao']; ?></span></p>
                        <p><span>Patrimonio:</span> <span><?php echo $manutencao['patrimonio']; ?></span></p>
                        <p><span>Localização:</span> <span><?php echo $manutencao['localizacao']; ?></span></p>
                        <p><span>Tipo:</span> <span><?php echo $manutencao['tipo_manutencao']; ?></span></p>
                        <p><span>Problema:</span> <span><?php echo $manutencao['descricao_problema']; ?></span></p>
                    </div>

                    <div class="text">
                        <p><span>Prioridade:</span> <span><?php echo $manutencao['prioridade']; ?></span></p>
                        <p><span>Responsável:</span> <span><?php echo $manutencao['responsavel']; ?></span></p>
                        <p><span>Data Pedido:</span> <span><?php echo $manutencao['data_pedido']; ?></span></p>
                        <p><span>Início:</span> <span><?php echo $manutencao['data_inicio']; ?></span></p>
                        <p><span>Conclusão:</span> <span><?php echo $manutencao['data_conclusao']; ?></span></p>
                        <p><span>Status:</span> <span><?php echo $manutencao['status']; ?></span></p>
                    </div>

                    <div class="text">
                        <p><span>Observação:</span> <span><?php echo $manutencao['observacao']; ?></span></p>
                    </div>
                </div>
            </div>

            <div class="voltar" style="margin-top: 30px;">
                <a href="manutencoes.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
            </div>

        </div>
    </main>
</body>
</html>