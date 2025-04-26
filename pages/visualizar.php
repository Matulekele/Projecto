<?php
    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    $id_patrimonio = $_GET['id'] ?? '';

    if ($id_patrimonio) {
        
        $sql_patrimonio = "
            SELECT 
                patrimonio.id_patrimonio, 
                patrimonio.nome,
                patrimonio.marca,
                patrimonio.modelo,
                patrimonio.quantidade,
                patrimonio.estado,
                patrimonio.dataaquisicao,
                patrimonio.descricao,
                patrimonio.valoraquisicao,
                patrimonio.imagem,
                categoria.nome_categoria AS categoria,
                responsaveis.responsavel AS responsavel,
                localizacao.nome AS localizacao
            FROM patrimonio
            LEFT JOIN categoria ON patrimonio.categoria = categoria.id_categoria
            LEFT JOIN responsaveis ON patrimonio.responsavel = responsaveis.id_responsavel
            LEFT JOIN localizacao ON patrimonio.localizacao = localizacao.id_localizacao
            WHERE patrimonio.id_patrimonio = '$id_patrimonio'
        ";
        
        $resultado_patrimonio = mysqli_query($conn, $sql_patrimonio);

        if (mysqli_num_rows($resultado_patrimonio) > 0) {
            $patrimonio = mysqli_fetch_assoc($resultado_patrimonio);
        } else {
            die("Patrimonio não encontrado.");
        }
    } else {
        die("ID do patrimonio não fornecido.");
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
    <title>Visualizar Patrimonio</title>
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
                <i class="fi fi-sr-layers icone-x"></i>
                <span>Detalhes do patrimonio</span>
            </header>


            <div class="container-infor">

                <div class="image-container">
                    <?php if (!empty($patrimonio['imagem'])): ?>
                    <img src="../uploads/<?php echo $patrimonio['imagem']; ?>" alt="Imagem do Patrimonio">
                    <?php else: ?>
          
                    <form action="../api/carregar_imagem.php" method="POST" enctype="multipart/form-data" class="imagem-form">
                        <p style="color: #ff6384;">Imagem não disponível.</p>
                        <input type="hidden" name="id_patrimonio" value="<?php echo $id_patrimonio; ?>">
                        <label for="imagem">Adicionar uma Imagem:</label>
                        <input type="file" name="imagem" id="imagem" accept="image/*" required>
                    <button type="submit">Carregar Imagem</button>
                    </form>
                    <?php endif; ?>
                </div>

                <div class="infor">

                    <div class="text">
                        <p>
                            <span>ID:</span>
                            <span><?php echo $patrimonio['id_patrimonio']; ?></span>
                        </p>
                        <p>
                            <span>Nome:</span>
                            <span><?php echo $patrimonio['nome']; ?></span>
                        </p>
                        <p>
                            <span>Marca:</span> 
                            <span><?php echo $patrimonio['marca']; ?></span>
                        </p>
                        <p>
                            <span>Modelo:</span> 
                            <span><?php echo $patrimonio['modelo']; ?></span>
                        </p>
                        <p>
                            <span>Quantidade:</span> 
                            <span><?php echo $patrimonio['quantidade']; ?></span>
                        </p>
                        <p>
                            <span>Estado:</span> 
                            <span><?php echo $patrimonio['estado']; ?></span>
                        </p>
                    </div>

                    <div class="text">
                        <p>
                            <span>Categoria:</span> 
                            <span><?php echo $patrimonio['categoria']; ?></span>
                        </p>
                        <p>
                            <span>Responsável:</span> 
                            <span><?php echo $patrimonio['responsavel']; ?></span>
                        </p>
                        <p>
                            <span>Localização:</span> 
                            <span><?php echo $patrimonio['localizacao']; ?></span>
                        </p>
                        <p>
                            <span>Valor de Aquisição:</span> 
                            <span><?php echo $patrimonio['valoraquisicao']; ?> Kz</span>
                        </p>
                        <p>
                            <span>Data de Aquisição:</span> 
                            <span><?php echo $patrimonio['dataaquisicao']; ?></span>
                        </p>
                    </div>

                    <div class="text">
                        <p>
                            <span>Descrição:</span> 
                            <span><?php echo $patrimonio['descricao']; ?></span>
                        </p>
                    </div>

                </div>
                
                
            </div>


            
            <div class="voltar" style="margin-top: 30px;">
                <a href="patrimonios.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
            </div>

        </div>

    </main>

</body>
</html>