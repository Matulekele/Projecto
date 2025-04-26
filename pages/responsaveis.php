<?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    $pesquisa = $_POST['busca'] ?? '';

        //$sql = "SELECT * FROM responsaveis WHERE responsavel LIKE '%$pesquisa%' ";

    $sql = "
    SELECT 
        responsaveis.id_responsavel,
        responsaveis.celular,
        responsaveis.cargo,
        responsaveis.endereco,
        responsaveis.responsavel AS responsavel,
            COUNT(patrimonio.id_patrimonio) AS nupatrimonio
        FROM responsaveis
        LEFT JOIN patrimonio 
            ON responsaveis.id_responsavel = patrimonio.responsavel
        WHERE responsaveis.responsavel LIKE '%$pesquisa%'
        GROUP BY responsaveis.id_responsavel, responsaveis.responsavel

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
    <title>Responsaveis</title>
</head>
<body>


    <main class="main">
        
        <div class="area">

            <form class="form" action="responsaveis.php" method="POST" style="margin-top: 60px; margin-bottom: 20px;">
                <div class="icones-area">
                    <label for="">
                        <i class="bi bi-search"></i>
                        <input type="search" placeholder="Pesquisar" name="busca" autofocus>
                    </label>
                    <button type="button" onclick="location.href='cadresponsavel.php';" title="Cadastrar nova categoria">
                    <i class="fi fi-sr-folder-plus-circle icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='dashboard.php';" title="Voltar">
                    <i class="fi fi-sr-arrow-circle-left icone-op"></i>
                    </button>
                </div>

            </form>  

                    <div class="tabela-container">

                        <table class="table table-hover" id="table-hover" style="width:100%;">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Nome Completo</th>
                                        <th scope="col">Cargo/Função</th>
                                        <th scope="col">Numero de telefone</th>
                                        <th scope="col">Endereço</th>
                                        <th scope="col">Nº de patrimónios</th>
                                        <th scope="col" style="text-align: center;">Funções</th>
                                        </tr>
                                    </thead>
                                <tbody>
        
                                <?php
        
                                    while($linha = mysqli_fetch_assoc($dados)) {
                                        $id_responsavel = $linha['id_responsavel'];
                                        $responsavel = $linha['responsavel'];
                                        $cargo = $linha['cargo'];
                                        $celular = $linha['celular'];
                                        $endereco = $linha['endereco'];
                                        $nupatrimonio = $linha['nupatrimonio'];
                                        echo "  <tr>
                                            <th scope='row'>$id_responsavel</th>
                                            <th scope='row'>$responsavel</th>
                                            <th >$cargo</th>
                                            <td>$celular</td>
                                             <td>$endereco</td>
                                            <td style='text-align: center;'>$nupatrimonio</td>

                                            <td class='area-icone-funcoes' style='text-align: center;'>

                                                <a href ='../pages/visualizar_resp.php?id=$id_responsavel' class=''><i class='fi fi-sr-overview icone-funcoes'></i></a>

                                                <a href ='../pages/cadresponsavel_edit.php?id=$id_responsavel' class=''><i class='fi fi-sr-edit icone-funcoes' style='color:green;''></i></a>
        
                                                <a href ='#' class='' data-bs-toggle='modal' data-bs-target='#confirma' onclick=" .'"' ."pegar_dados($id_responsavel, '$responsavel')" .'"' ." ><i class='fi fi-sr-trash-empty icone-funcoes' style='color:#ad0909;'></i></a>
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
        </div>



        <!-- Modal -->
        <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header-modal modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form action="../api/excluiresp_script.php" method="POST">
                        <div class="content-modal modal-body">
                            <p>Deseja realmente excluir
                                <b id="nome_responsavel"> Nome do patrimonio</b> como um dos responsavel?
                                <p>
                                    <b>OBS.:</b> Todos os dados serão eliminados.
                                </p>
                            </p>
                        </div>
                        <div class="footer-modal modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <input type="hidden" name="responsavel" id="nome_responsavel_1" value="">
                            <input type="hidden" name="id" id="id_responsavel" value="">
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                    </form>
            </div>
        </div>

    </main>


    <script type="text/javascript">
        function pegar_dados(id, responsavel) {
            document.getElementById('nome_responsavel').innerHTML = responsavel;
            document.getElementById('nome_responsavel_1').value = responsavel;
            document.getElementById('id_responsavel').value = id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>