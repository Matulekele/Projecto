<?php

        include_once "../includes/conexao.php";
        include_once "../includes/auth.php";

        $id_localizacao = $_GET['id'] ?? '';

        if ($id_localizacao) {
            // Seleciona a localização
            $sql_localizacao = "SELECT * FROM localizacao WHERE id_localizacao = '$id_localizacao'";
            $resultado_localizacao = mysqli_query($conn, $sql_localizacao);

            if (mysqli_num_rows($resultado_localizacao) > 0) {
                $localizacao = mysqli_fetch_assoc($resultado_localizacao);
            } else {
                die("Localização não encontrada.");
            }

            // Seleciona os patrimonios associados à localização
            $sql_patrimonios = "SELECT * FROM patrimonio WHERE localizacao = '$id_localizacao'";
            $resultado_patrimonios = mysqli_query($conn, $sql_patrimonios);

        } else {
            die("ID da localização não fornecido.");
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
    <title>Visualizar Localização</title>
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
        <div class="content" id="visualizar" style="width: 100%; position: relative;">
            <header>
                <i class="fi fi-sr-region-pin-alt icone-x"></i>
                <span>Detalhes da Localização</span>
            </header>
            <div class="localizacao-info">
                <p><strong>Nome: </strong><?php echo $localizacao['nome']; ?></p>
                <p><strong>Descrição:</strong> <?php echo $localizacao['descricao']; ?></p>
                <p><strong>ID da Localização:</strong> <?php echo $localizacao['id_localizacao']; ?></p>
            </div>

            <h3>Patrimonios nesta Localização</h3>

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
                            echo "<tr><td colspan='3'>Nenhum patrimonio encontrado nesta localização.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </div>

            <div class="voltar" style="margin-top: 30px;">
                <a href="localizacoes.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
            </div>

        </div>
    </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
