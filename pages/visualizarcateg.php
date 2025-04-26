<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Visualizar Categoria</title>
    <style>
         #visualizar .voltar{
            position: absolute;
            top: -30px;
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


    <?php
        
        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        $id_categoria = $_GET['id'] ?? '';

        if ($id_categoria) {
            
            $sql_categoria = "SELECT * FROM categoria WHERE id_categoria = '$id_categoria'";

            $resultado_categoria = mysqli_query($conn, $sql_categoria);

            if (mysqli_num_rows($resultado_categoria) > 0) {
                $categoria = mysqli_fetch_assoc($resultado_categoria);
            } else {
                die("Categoria não encontrada.");
            }

            $sql_patrimonios = "SELECT * FROM patrimonio WHERE categoria = '$id_categoria'";
            $resultado_patrimonios = mysqli_query($conn, $sql_patrimonios);

        } else {
            die("ID da categoria não fornecido.");
        }
    ?>

    <main class="main">
        <div class="content" id="visualizar" style="width: 100%; position: relative;">
            <header>
                <i class="fi fi-sr-category icone-x"></i>
                <span>Detalhes da Categoria</span>
            </header>
            <div class="categoria-info">
                <p><strong>ID da Categoria:</strong> <?php echo $categoria['id_categoria']; ?></p>
                <p><strong>Nome: </strong><?php echo $categoria['nome_categoria']; ?></p>
                <p><strong>Descrição:</strong> <?php echo $categoria['descricao']; ?></p>
            </div>

            <h3>Patrimonios nesta categoria</h3>

            <div class="tabela-container" style="max-height: 250px;">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Modelo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Descrição</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($resultado_patrimonios) > 0) {
                            while ($patrimonio = mysqli_fetch_assoc($resultado_patrimonios)) {
                                echo "<tr>
                                        <td>{$patrimonio['id_patrimonio']}</td>
                                        <td>{$patrimonio['nome']}</td>
                                        <td>{$patrimonio['marca']}</td>
                                        <td>{$patrimonio['modelo']}</td>
                                        <td>{$patrimonio['estado']}</td>
                                        <td>{$patrimonio['descricao']}</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='3'>Nenhum patrimonio encontrado para esta categoria.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <div class="voltar" style="margin-top: 30px;">
                <a href="categorias.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
