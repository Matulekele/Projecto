<?php
    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $id = $_GET['id'] ?? '';

    $sql = "SELECT * FROM patrimonio WHERE id_patrimonio = $id";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);

    $query_categorias = "SELECT id_categoria, nome_categoria FROM categoria";
    $resultado_categorias = mysqli_query($conn, $query_categorias);

    $query_localizacoes = "SELECT id_localizacao, nome FROM localizacao";
    $resultado_localizacoes = mysqli_query($conn, $query_localizacoes);

    $query_responsaveis = "SELECT id_responsavel, responsavel FROM responsaveis";
    $resultado_responsaveis = mysqli_query($conn, $query_responsaveis)
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Alteração de cadastros</title>
</head>
<body>


    <?php

        if ($_SESSION['nivel_acesso'] === 'Admin') {
            echo '<section class="section">
            <form action="../api/edit_script.php" method="POST" class="form">

                <h1>Alterar o registro</h1>

                <div class="separador">
                    <div>
                        <label for="nome">
                            Nome:
                            <input type="text" class="input" name="nome" placeholder="Nome" required value="'.$linha["nome"].'">
                        </label>
                        <label for="marca">
                            Marca:
                            <input type="text" class="input" name="marca" placeholder="Marca" value="'.$linha["marca"].'">
                        </label>
                    </div>

                    <div>
                        <label for="modelo">
                            Modelo:
                            <input type="text" class="input" name="modelo" placeholder="Modelo" value="'.$linha["modelo"].'">
                        </label>
                        <label for="quantidade">
                            Quantidade:
                            <input type="number" class="input" name="quantidade" placeholder="Quantidade" required value="'.$linha["quantidade"].'">
                        </label>
                    </div>
                </div>


                <select name="categoria" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                    <option disabled>Selecione a Categoria</option>';
                    while ($categoria = mysqli_fetch_assoc($resultado_categorias)) {
                        $selected = ($linha["categoria"] == $categoria["id_categoria"]) ? "selected" : "";
                        echo '<option value="' . $categoria['id_categoria'] . '" ' . $selected . '>' . $categoria['nome_categoria'] . '</option>';
                        }
                echo '</select>

                <select name="localizacao" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                    <option disabled>Selecione a Localização</option>';
                        while ($localizacao = mysqli_fetch_assoc($resultado_localizacoes)) {
                            $selected = ($linha["localizacao"] == $localizacao["id_localizacao"]) ? "selected" : "";
                            echo '<option value="' . $localizacao['id_localizacao'] . '" ' . $selected . '>' . $localizacao['nome'] . '</option>';
                        }
                echo '</select>

                <select name="responsavel" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none;" required>
                    <option disabled>Selecione o Responsável</option>';
                        while ($responsavel = mysqli_fetch_assoc($resultado_responsaveis)) {
                            $selected = ($linha["responsavel"] == $responsavel["id_responsavel"]) ? "selected" : "";
                            echo '<option value="' . $responsavel['id_responsavel'] . '" ' . $selected . '>' . $responsavel['responsavel'] . '</option>';
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
                            Valor de aquisicao:
                            <input type="number" class="input" name="valoraquisicao" placeholder="Valor de aquisição" required value="'. $linha["valoraquisicao"].'">
                        </label>
                    </div>
                    <div>
                        <label for="dataaquisicao">
                            Data de aquisicao:
                            <input type="date" class="input" name="dataaquisicao" placeholder="Data de aquisição" value="'.$linha["dataaquisicao"].'">
                        </label>
                    </div>
                </div>


                <label class="descricao">
                    Descrição:
                    <textarea id="description" class="input" name="descricao" placeholder="Descrição">'.$linha["descricao"].'</textarea>
                </label>

                <div class="link-icones" style="margin-top:30px">

                    <button type="submit"" value="Salvar Alterações"><i class="fi fi-sr-floppy-disks icones"></i></button>

                    <input type="hidden" value="'.$linha["id_patrimonio"].'" name="id">
                    
                    <a href="../pages/patrimonios.php"><i class="fi fi-sr-overview icones"></i></a>

                </div>

            </form>
        </section>';


        } else {
            echo " <div class='error-message'>
                        <div class='message'>
                            Você não tem acesso a essa opção, é exclusivo para Administradores
                        </div>
                        <p><a href='../pages/patrimonios.php'>Retroceder</a></p>
                    </div>";
        }
    
    ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>