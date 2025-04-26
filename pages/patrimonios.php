<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $pesquisa = $_POST['busca'] ?? '';
     $sql = "
         SELECT 
             patrimonio.id_patrimonio,
             patrimonio.nome,
             patrimonio.marca,
             patrimonio.modelo,
             localizacao.nome AS localizacao,
             patrimonio.quantidade,
             categoria.nome_categoria AS categoria, 
             patrimonio.estado,
             responsaveis.responsavel AS responsavel,
             patrimonio.dataaquisicao,
             patrimonio.descricao
         FROM patrimonio
         INNER JOIN categoria 
             ON patrimonio.categoria = categoria.id_categoria
         LEFT JOIN localizacao 
             ON patrimonio.localizacao = localizacao.id_localizacao
         LEFT JOIN responsaveis 
             ON patrimonio.responsavel = responsaveis.id_responsavel
         WHERE 
             patrimonio.nome LIKE '%$pesquisa%' OR 
             patrimonio.estado LIKE '%$pesquisa%' OR 
             responsaveis.responsavel LIKE '%$pesquisa%' OR 
             categoria.nome_categoria LIKE '%$pesquisa%' OR 
             patrimonio.dataaquisicao LIKE '%$pesquisa%'
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Bens</title>
</head>
<body>

    <main class="main">
        
        <div class="content">
            <form class="form" action="patrimonios.php" method="POST" style="margin-top: 40px; margin-bottom: 20px;">
                <div class="icones-area">
                    <label for="">
                        <i class="bi bi-search"></i>
                        <input type="search" placeholder="Pesquisar" name="busca" autofocus>
                    </label>
                    <button type="button" onclick="location.href='cadastro.php';" title="Cadastrar novo bem">
                        <i class="fi fi-sr-folder-plus-circle icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='../reports/relatorio.php';" title="Imprimir">
                        <i class="fi fi-sr-print icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='grafico_patrimonio.php';" title="Ver grafico">
                        <i class="fi fi-sr-chart-pie-alt icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='dashboard.php';" title="Voltar">
                        <i class="fi fi-sr-arrow-circle-left icone-op"></i>
                    </button>
                </div>
            </form>
                
                <div class="tabela-container">
                    
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Marca</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Localização</th>
                                <th scope="col" style="text-align: center;">Quantidade</th>
                                <th scope="col">Categoria</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Responsável</th>
                                <th scope="col">Data de aquisição</th>
                                <th scope="col" style="text-align: center;">Funções</th>
                                </tr>
                            </thead>
                    <tbody>
    
                        <?php

                            while($linha = mysqli_fetch_assoc($dados)) {
                                $id_patrimonio = $linha['id_patrimonio'];
                                $nome = $linha['nome'];
                                $marca = $linha['marca'];
                                $modelo = $linha['modelo'];
                                $localizacao = $linha['localizacao'];
                                $quantidade = $linha['quantidade'];
                                $categoria = $linha['categoria'];
                                $estado = $linha['estado'];
                                $responsavel = $linha['responsavel'];
                                $dataaquisicao = $linha['dataaquisicao'];
                                $dataaquisicao = mostra_data($dataaquisicao);
                                //$descricao = $linha['descricao'];

                                $estado_cor = ($estado === 'Bom') ? 'estado-bom' : (($estado === 'Mal') ? 'estado-mal' : '');
    
    
                                echo "  <tr>
                                    <th scope='row' class='nome'>$id_patrimonio</th>
                                    <th scope='row' class='nome'>$nome</th>
                                    <td>$marca</td>
                                    <td>$modelo</td>
                                    <td>$localizacao</td>
                                    
                                    <td style='text-align: center;'>

                                    
                                    <form action='../api/actualizar_quantidade.php' method='POST' class='form_quantidade'>
                                        <input type='hidden' name='id' value='$id_patrimonio'>
                                    
                                            <span>$quantidade</span>

                                            <select name='acao' onchange='this.form.submit()' style='appearance: none; -webkit-appearance: none;     -moz-appearance: none;'>

                                                <option value='' selected disabled></option>

                                                <option value='aumentar'>🔼 Aumentar</option>

                                                <option value='diminuir'>🔽 Reduzir</option>

                                            </select>
                                        </form>
                                        
                                    </td>

                                    <td>$categoria</td>
                                    <td class='$estado_cor'>$estado</td>
                                    <td>$responsavel</td>
                                    <td style='text-align: center;'>$dataaquisicao</td>
    
                                    <td class='area-icone-funcoes'>
                                        <a href ='visualizar.php?id=$id_patrimonio' class=''><i class='fi fi-sr-overview icone-funcoes'></i></a>
                                    
                                        <a href ='cadastro_edit.php?id=$id_patrimonio' class=''><i class='fi fi-sr-edit icone-funcoes' style='color:green;'></i></a>
                                        
                                        <a href ='#' class='' data-bs-toggle='modal' data-bs-target='#confirma' onclick=" .'"' ."pegar_dados($id_patrimonio, '$nome')" .'"' ." ><i class='fi fi-sr-trash-empty icone-funcoes' style='color:#ad0909;'></i></a>
                                    </tr>"
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

        
        <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header-modal modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="../api/excluir_script.php" method="POST">
                        <div class="content-modal modal-body">
                            <p>Deseja realmente excluir
                                <b id="nome_patrimonio"> Nome do patrimonio</b> da lista dos bens patrimonial?
                                <p>
                                    <b>OBS.:</b> Todos os dados serão eliminados.
                                </p>
                            </p>
                        </div>
                        <div class="footer-modal modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <input type="hidden" name="nome" id="nome_patrimonio_1" value="">
                            <input type="hidden" name="id" id="id_patrimonio" value="">
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                    </form>
            </div>

        </div>

    </main>


    <script type="text/javascript">
        function pegar_dados(id, nome) {
            document.getElementById('nome_patrimonio').innerHTML = nome;
            document.getElementById('nome_patrimonio_1').value = nome;
            document.getElementById('id_patrimonio').value = id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>