<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $query_categorias = "SELECT id_categoria, nome_categoria FROM categoria";
    $resultado_categorias = mysqli_query($conn, $query_categorias);

    $query_localizacoes = "SELECT id_localizacao, nome FROM localizacao";
    $resultado_localizacoes = mysqli_query($conn, $query_localizacoes);

    $query_responsaveis = "SELECT id_responsavel, responsavel FROM responsaveis";
    $resultado_responsaveis = mysqli_query($conn, $query_responsaveis);

    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Cadastro de Bens</title>
</head>
<body>


    <?php
        if ($_SESSION['nivel_acesso'] === 'Admin'){
            echo '<section class="section">
            <form action="../api/cadastro_script.php" method="POST" class="form" enctype="multipart/form-data">

            <h1>Cadastrar Património</h1>

            <div class="separador">
                <div>
                    <label for="nome">
                        Nome:
                        <input type="text" class="input" name="nome" placeholder="Nome" required>
                    </label>
                    <label for="marca">
                        Marca:
                        <input type="text" class="input" name="marca" placeholder="Marca">
                    </label>
                </div>

                <div>
                    <label for="modelo">
                        Modelo:
                        <input type="text" class="input" name="modelo" placeholder="Modelo">
                    </label>
                    <label for="quantidade">
                        Quantidade:
                        <input type="number" class="input" name="quantidade" placeholder="Quantidade" required>
                    </label>
                </div>
            </div>

            <select name="categoria" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                <option disabled selected>Selecione a Categoria</option>';
                while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                    echo '<option value="' . $categoria['id_categoria'] . '">' . $categoria['nome_categoria'] . '</option>';
                }
            echo '</select>


            <select name="localizacao" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                <option disabled selected>Selecione a Localização</option>';
                while ($localizacao = mysqli_fetch_assoc($resultado_localizacoes)) {
                    echo '<option value="' . $localizacao['id_localizacao'] . '">' . $localizacao['nome'] . '</option>';
                }
            echo '</select>
            
            
            <select name="responsavel" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                <option disabled selected>Selecione o Responsável</option>';
                while ($responsavel = mysqli_fetch_assoc($resultado_responsaveis)) {
                    echo '<option value="' . $responsavel['id_responsavel'] . '">' . $responsavel['responsavel'] . '</option>';
                }
            echo '</select>
                    

            <select name="estado" id="" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                <option disabled selected>Estado do equipamento</option>
                <option value="Bom">Bom</option>
                <option value="Mal">Mal</option>
            </select>


             <div class="separador">
                <div>
                    <label for="valoraquisicao">
                        Valor de aquisicao
                        <input type="number" class="input" name="valoraquisicao" placeholder="Valor de aquisição" required>
                    </label>
                </div>
                <div>
                    <label for="dataaquisicao">
                        Data de aquisicao:
                        <input type="date" class="input" name="dataaquisicao" placeholder="Data de aquisição">
                    </label>
                </div>
            </div>


            <label for="descricao">
                Descricao:
                <textarea id="description" class="input" name="descricao" placeholder="Descrição"></textarea>
            </label>

            <label for="imagem">
                Selecione uma imagem (Opcional)
                <input type="file" class="input" name="imagem">
            </label>

            <div class="link-icones" style="margin-top: 30px">

                <button type="submit"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <a href="patrimonios.php"><i class="fi fi-sr-overview icones"></i></a>

            </div>

            </form>
        </section>';

        } else {
            echo " <div class='error-message'>
                        <div class='message'>
                            Você não tem acesso a essa opção, é exclusivo para Administradores
                        </div>
                        <p><a href='patrimonios.php'>Retroceder</a></p>
                    </div>";
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>
