<?php
        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        $pesquisa = $_POST['busca'] ?? '';
        $sql = "
            SELECT 
                manutencao.id_manutencao,
                patrimonio.nome AS patrimonio,
                localizacao.nome AS localizacao,
                manutencao.tipo_manutencao,
                manutencao.descricao_problema,
                manutencao.prioridade,
                responsaveis.responsavel AS responsavel,
                manutencao.data_pedido,
                manutencao.data_inicio,
                manutencao.data_conclusao,
                manutencao.status,
                manutencao.observacao
            FROM manutencao
            INNER JOIN patrimonio 
                ON manutencao.id_patrimonio = patrimonio.id_patrimonio
            LEFT JOIN localizacao 
                ON manutencao.id_localizacao = localizacao.id_localizacao
            LEFT JOIN responsaveis 
                ON manutencao.id_responsavel = responsaveis.id_responsavel
            WHERE 
                patrimonio.nome LIKE '%$pesquisa%' OR 
                manutencao.tipo_manutencao LIKE '%$pesquisa%' OR 
                manutencao.descricao_problema LIKE '%$pesquisa%' OR 
                manutencao.prioridade LIKE '%$pesquisa%' OR 
                responsaveis.responsavel LIKE '%$pesquisa%' OR 
                manutencao.data_pedido LIKE '%$pesquisa%' OR 
                manutencao.data_inicio LIKE '%$pesquisa%' OR 
                manutencao.data_conclusao LIKE '%$pesquisa%' OR 
                manutencao.status LIKE '%$pesquisa%' OR 
                manutencao.observacao LIKE '%$pesquisa%'
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
    <title>Manutenção</title>
</head>
<body>


    <main class="main">
        <div class="content">
            <form class="form" action="manutencoes.php" method="POST" style="margin-top: 40px; margin-bottom: 20px;">
                <div class="icones-area">
                    <label>
                        <i class="bi bi-search"></i>
                        <input type="search" placeholder="Pesquisar" name="busca" autofocus>
                    </label>
                    <button type="button" onclick="location.href='cadastroman.php';" title="Nova Manutenção">
                        <i class="fi fi-sr-folder-plus-circle icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='';" title="Imprimir">
                        <i class="fi fi-sr-print icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href='grafico_man.php';" title="Ver grafico">
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
                            <th>ID</th>
                            <th>ID Patrimonio</th>
                            <th>Localização</th>
                            <th>Tipo</th>
                            <th>Problema</th>
                            <th>Prioridade</th>
                            <th>Responsável</th>
                            <th>Data Pedido</th>
                            <th>Início</th>
                            <th>Conclusão</th>
                            <th>Status</th>
                            <th style="text-align: center;">Funções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($linha = mysqli_fetch_assoc($dados)) { ?>
                            <tr>
                                <td><?= $linha['id_manutencao'] ?></td>
                                <td><?= $linha['patrimonio'] ?></td>
                                <td><?= $linha['localizacao'] ?></td>

                                <td class="
                                    <?php 
                                        switch ($linha['tipo_manutencao']) {
                                            case 'Preventiva': echo 'tipo-preventiva'; break;
                                            case 'Corretiva': echo 'tipo-corretiva'; break;
                                            case 'Preditiva': echo 'tipo-preditiva'; break;
                                            default: echo 'tipo-default';
                                        }
                                    ?>
                                ">
                                    <?= $linha['tipo_manutencao'] ?>
                                </td>

                                <td><?= $linha['descricao_problema'] ?></td>
                                <td style="font-weight: 
                                bold;"><?= $linha['prioridade'] ?></td>
                                <td><?= $linha['responsavel'] ?></td>
                                <td><?= $linha['data_pedido'] ?></td>
                                <td><?= $linha['data_inicio'] ?></td>
                                <td><?= $linha['data_conclusao'] ?></td>

                                <td class="
                                    <?php 
                                        switch ($linha['status']) {
                                            case 'Pendente': echo 'status-pendente'; break;
                                            case 'Em andamento': echo 'status-andamento'; break;
                                            case 'Concluído': echo 'status-concluido'; break;
                                            case 'Cancelado': echo 'status-cancelado'; break;
                                            default: echo 'status-default';
                                        }
                                    ?>
                                    ">
                                    <?= $linha['status'] ?>
                                </td>

                                <td>

                                    <a href='visualizar_man.php?id=<?= $linha['id_manutencao'] ?>'><i class='fi fi-sr-overview icone-funcoes'></i></a>

                                    <a href='edit_manutencao.php?id=<?= $linha['id_manutencao'] ?>'><i class='fi fi-sr-edit icone-funcoes' style='color:green;'></i></a>

                                    <a href='#' data-bs-toggle='modal' data-bs-target='#confirma' onclick="pegar_dados(<?= $linha['id_manutencao'] ?>)">
                                        <i class='fi fi-sr-trash-empty icone-funcoes' style='color:#ad0909;'></i>
                                    </a>

                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            </div>

            <div class="modal fade" id="confirma" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header header-modal">
                            <h5 class="modal-title">Confirmação de exclusão</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="../api/excluirman_script.php" method="POST">
                            <div class="content-modal modal-body">
                                <p>Deseja realmente excluir este registro?</p>
                                <input type="hidden" name="id" id="id_manutencao">
                            </div>
                            <div class="footer-modal modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                                <input type="submit" class="btn btn-danger" value="Excluir">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function pegar_dados(id) {
            document.getElementById('id_manutencao').value = id;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>