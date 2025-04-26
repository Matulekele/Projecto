<?php
        
        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        $sql = "
            SELECT 
                movimentacao.id_movimentacao,
                patrimonio.nome AS patrimonio,
                loc_antigo.nome AS local_antigo,
                loc_novo.nome AS local_novo,
                responsaveis.responsavel,
                movimentacao.estado,
                movimentacao.motivo,
                movimentacao.datamovimentacao
            FROM movimentacao
            INNER JOIN patrimonio 
                ON movimentacao.id_patrimonio = patrimonio.id_patrimonio
            LEFT JOIN localizacao AS loc_antigo 
                ON movimentacao.id_localantigo = loc_antigo.id_localizacao
            LEFT JOIN localizacao AS loc_novo 
                ON movimentacao.id_localnovo = loc_novo.id_localizacao
            LEFT JOIN responsaveis 
                ON movimentacao.id_responsavel = responsaveis.id_responsavel
            ORDER BY movimentacao.datamovimentacao DESC
        ";
        
        $dados = mysqli_query($conn, $sql);
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
    <title>Movimentações</title>
</head>
<body>
    <main class="main">
        <div class="content">
            <form class="form" action="movimentacoes.php" method="POST" style="margin-top: 60px; margin-bottom: 20px;">
                <div class="icones-area">
                <label for="">
                    <i class="bi bi-search"></i>
                    <input type="search" placeholder="Pesquisar" name="busca" autofocus>
                </label>
                <button type="button" onclick="location.href='cadastromov.php';" title="Cadastrar Movimentacao">
                    <i class="fi fi-sr-folder-plus-circle icone-op"></i>
                </button>
                <button type="button" onclick="location.href='';" title="Imprimir">
                    <i class="fi fi-sr-print icone-op"></i>
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
                            <th>ID</th>
                            <th>Patrimonio</th>
                            <th>Localização Antiga</th>
                            <th>Localização Nova</th>
                            <th>Responsável</th>
                            <th style="text-align: center;">Estado</th>
                            <th>Motivo</th>
                            <th style="text-align: center;">Data da Movimentação</th>
                            <th>Funções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($linha = mysqli_fetch_assoc($dados)) { ?>
                        <tr>
                            <td><?php echo $linha['id_movimentacao']; ?></td>
                            <td><?php echo $linha['patrimonio']; ?></td>
                            <td><?php echo $linha['local_antigo']; ?></td>
                            <td><?php echo $linha['local_novo']; ?></td>
                            <td><?php echo $linha['responsavel']; ?></td>
                            <td style="text-align: center;"><?php echo $linha['estado']; ?></td>
                            <td><?php echo $linha['motivo']; ?></td>
                            <td style="text-align: center;"><?php echo $linha['datamovimentacao']; ?></td>
                            <td>
                                <a href="#" class="" data-bs-toggle="modal" data-bs-target="#confirma" onclick="pegar_dados(<?php echo $linha['id_movimentacao']; ?>, '<?php echo $linha['patrimonio']; ?>')">
                                    <i class='fi fi-sr-trash-empty icone-funcoes' style='color:#ad0909;'></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header-modal modal-header">
                        <h5 class="modal-title">Confirmação de exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../api/excluir_mov.php" method="POST">
                        <div class="content-modal modal-body">
                            <p>Deseja realmente excluir a movimentação do patrimonio <b id="nome_movimentacao">Nome</b>?</p>
                        </div>
                        <div class="footer-modal modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <input type="hidden" name="id" id="id_movimentacao" value="">
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script type="text/javascript">
        function pegar_dados(id, nome) {
            document.getElementById('nome_movimentacao').innerHTML = nome;
            document.getElementById('id_movimentacao').value = id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
