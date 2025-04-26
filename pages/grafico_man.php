<?php
        
        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        $sql_total = "SELECT COUNT(*) AS total FROM manutencao";
        $resultado_total = mysqli_query($conn, $sql_total);
        $total_manutencoes = mysqli_fetch_assoc($resultado_total)['total'];

        $sql_status = "SELECT status, COUNT(*) AS total FROM manutencao GROUP BY status";
        $dados_status = mysqli_query($conn, $sql_status);
        $status_labels = [];
        $status_values = [];
        while ($row = mysqli_fetch_assoc($dados_status)) {
            $status_labels[] = $row['status'];
            $status_values[] = $row['total'];
        }

        $sql_prioridade = "SELECT prioridade, COUNT(*) AS total FROM manutencao GROUP BY prioridade";
        $dados_prioridade = mysqli_query($conn, $sql_prioridade);
        $prioridade_labels = [];
        $prioridade_values = [];
        while ($row = mysqli_fetch_assoc($dados_prioridade)) {
            $prioridade_labels[] = $row['prioridade'];
            $prioridade_values[] = $row['total'];
        }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="icon/icone.png">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <title>Gráficos de Manutenção</title>
    <style>
        .main-grafico .voltar{
            position: absolute;
            top: 25px;
            right: 30px;
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
    
    <main class="main-grafico">
        <div class="total-manutencoes">
            <div>
                <i class="fi fi-sr-chart-pie-alt icone-x"></i>
                <span>Visão geral de Manutenções</span>
            </div>
            <div>
            </div>
        </div>


        <div class="grafico-container">
            <div>
                <p>Quantidade de Manutenções por Status</p>
                <canvas id="graficoStatus" width="500" height="300"></canvas>
            </div>
            <div>
                <p>Quantidade de Manutenções por Prioridade</p>
                <canvas id="graficoPrioridade"></canvas>
            </div>
        </div>


        <div class="voltar" style="margin-top: 30px;">
            <a href="manutencoes.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const statusLabels = <?php echo json_encode($status_labels); ?>;
        const statusValues = <?php echo json_encode($status_values); ?>;
        const ctxStatus = document.getElementById('graficoStatus').getContext('2d');
        new Chart(ctxStatus, {
            type: 'bar',
            data: { 
                labels: statusLabels, 
                datasets: [{ 
                    label: 'Total', 
                    data: statusValues, 
                    backgroundColor: ['#e74c3c', '#f1c40f', '#3498db', '#1abc9c'], 
                    borderWidth: 1 
                }] 
            },
            options: { responsive: true, plugins: { legend: { display: false } } }
        });

        const prioridadeLabels = <?php echo json_encode($prioridade_labels); ?>;
        const prioridadeValues = <?php echo json_encode($prioridade_values); ?>;
        const ctxPrioridade = document.getElementById('graficoPrioridade').getContext('2d');
        new Chart(ctxPrioridade, {
            type: 'doughnut',
            data: { 
                labels: prioridadeLabels, 
                datasets: [{ 
                    label: 'Total', 
                    data: prioridadeValues, 
                    backgroundColor: ['#e74c3c', '#f1c40f', '#2ecc71', '#3498db'], 
                    borderWidth: 1 
                }] 
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: {
                                size: 15,
                                    },
                                usePointStyle: true,
                                pointStyle: 'circle',
                            boxWidth: 8,
                        },
                    }
                }
            }
        });
    </script>
</body>
</html>