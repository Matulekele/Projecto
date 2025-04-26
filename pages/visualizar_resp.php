<?php

      include_once "../includes/conexao.php";
      include_once "../includes/auth.php";

        $id_responsavel = $_GET['id'] ?? '';

        if ($id_responsavel) {

            // Seleciona o responsável
            $sql_responsavel = "SELECT * FROM responsaveis WHERE id_responsavel = '$id_responsavel'";
            $resultado_responsavel = mysqli_query($conn, $sql_responsavel);

            if (mysqli_num_rows($resultado_responsavel) > 0) {
                $responsavel = mysqli_fetch_assoc($resultado_responsavel);
            } else {
                die("Responsável não encontrado.");
            }

            // Seleciona os patrimonios associados ao responsável
            $sql_patrimonios = "SELECT * FROM patrimonio WHERE responsavel = '$id_responsavel'";
            $resultado_patrimonios = mysqli_query($conn, $sql_patrimonios);

        } else {
            die("ID do responsável não fornecido.");
        }

    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Visualizar Responsável</title>
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

    <main class="main">
        <div class="content"  id="visualizar" style="width: 100%; position: relative;">
            <header>
                <i class="fi fi-sr-chart-user icone-x"></i>
                <span>Detalhes do Responsável</span>
            </header>
            <div class="responsavel-info">
                <p><strong>ID:</strong> <?php echo $responsavel['id_responsavel']; ?></p>
                <p><strong>Nome do responsável: </strong><?php echo $responsavel['responsavel']; ?></p>
            </div>

            <h3>Patrimónios sob a responsabilidade:</h3>

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
                            echo "<tr><td colspan='3'>Nenhum patrimonio encontrado sob este responsável.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <div class="voltar" style="margin-top: 30px;">
                <a href="responsaveis.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
            </div>
        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
