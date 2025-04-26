<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

       $pesquisa = $_POST['busca'] ?? '';

        $sql = "
            SELECT 
                localizacao.id_localizacao,
                localizacao.nome AS nome,
                localizacao.descricao AS descricao,
                COUNT(patrimonio.id_patrimonio) AS nupatrimonio
            FROM localizacao
            LEFT JOIN patrimonio 
                ON localizacao.id_localizacao = patrimonio.localizacao
            WHERE localizacao.nome LIKE '%$pesquisa%'
            GROUP BY localizacao.id_localizacao, localizacao.nome, localizacao.descricao
        ";

        $dados = mysqli_query($conn, $sql);

    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link  rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Localizações</title>
</head>
<body>


    <main class="main">
        
        <div class="content" id="content">
            <form class="form" action="localizacoes.php" method="POST"        style="margin-top: 60px; margin-bottom: 20px;">
                <div class="icones-area">
                    <label for="">
                        <i class="bi bi-search"></i>
                        <input type="search" placeholder="Pesquisar" name="busca" autofocus>
                    </label>
                    <button type="button" onclick="location.href='cadastrolocal.php';" title="Cadastrar novo Local">
                    <i class="fi fi-sr-folder-plus-circle icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='dashboard.php';" title="Voltar">
                        <i class="fi fi-sr-arrow-circle-left icone-op"></i>
                    </button>
                </div>

            </form>
            
            <div class="tabela-container">

                <table class="table table-hover" id="table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome do local</th>
                                <th scope="col">Descrição do local</th>
                                <th scope="col" style="text-align: center;">Nº de patrimónios</th>
                                <th scope="col" style="text-align: center;">Funções</th>
                                </tr>
                            </thead>
                        <tbody>
    
                        <?php
    
                            while($linha = mysqli_fetch_assoc($dados)) {
                                $id_localizacao = $linha['id_localizacao'];
                                $nome = $linha['nome'];
                                $descricao = $linha['descricao'];
                                $nupatrimonio = $linha['nupatrimonio'];
    
                                echo "  <tr>
                                    <th scope='row'>$id_localizacao</th>
                                    <th scope='row'>$nome</th>
                                    <td>$descricao</td>
                                    <td style='text-align: center;'>$nupatrimonio</td>
                                    
                                    <td style='text-align: center;' class='area-icone-funcoes'>
    
                                        <a href ='visualizarlocal.php?id=$id_localizacao' class=''><i class='fi fi-sr-overview icone-funcoes'></i></a>
    
                                        <a href ='cadastrolocal_edit.php?id=$id_localizacao' class=''><i class='fi fi-sr-edit icone-funcoes' style='color:green;'></i></a>

                                        <a href ='#' class='' data-bs-toggle='modal' data-bs-target='#confirma' onclick=" .'"' ."pegar_dados($id_localizacao, '$nome')" .'"' ." ><i class='fi fi-sr-trash-empty icone-funcoes' style='color:#ad0909;'></i></a>
                                    </td> </tr> 
                                    
                                    "
                                ;
                            }
                        ?>
                                
                    </tbody>
                </table>

            </div>

            <?php
            
                $dados = mysqli_query($conn, $sql);

                    
                if (mysqli_num_rows($dados) == 0) {
                    echo "<div class='vazio'>Nenhum resultado encontrado para a pesquisa: <strong>$pesquisa</strong></div>";
                }
       
            ?>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header-modal modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="../api/excluirlocal_script.php" method="POST">
                        <div class="content-modal modal-body">
                            <p>Deseja realmente excluir local
                                <b id="nome_localizacao"> Nome do patrimonio</b> do aplicativo?
                                <p>
                                    <b>OBS.:</b> Todos os dados serão eliminados.
                                </p>
                            </p>
                        </div>
                        <div class="footer-modal modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <input type="hidden" name="nome" id="nome_localizacao_1" value="">
                            <input type="hidden" name="id" id="id_localizacao" value="">
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                    </form>
            </div>
        </div>

    </main>


    <script type="text/javascript">
        function pegar_dados(id, nome) {
            document.getElementById('nome_localizacao').innerHTML = nome;
            document.getElementById('nome_localizacao_1').value = nome;
            document.getElementById('id_localizacao').value = id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>