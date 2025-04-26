
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link rel="icon" href="icon/icone.png">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <title>Gráficos de Património</title>
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

    <?php
    
      include_once "../includes/conexao.php";
      include_once "../includes/auth.php";

        $sql_total = "SELECT COUNT(*) AS total FROM patrimonio";
        $resultado_total = mysqli_query($conn, $sql_total);
        $total_patrimonio = mysqli_fetch_assoc($resultado_total)['total'];

        $sql_estado = "SELECT estado, COUNT(*) AS total FROM patrimonio GROUP BY estado";
        $dados_estado = mysqli_query($conn, $sql_estado);
        $estado_labels = [];
        $estado_values = [];
        while ($linha = mysqli_fetch_assoc($dados_estado)) {
            $estado_labels[] = $linha['estado'];
            $estado_values[] = $linha['total'];
        }

        $sql_categoria = "SELECT categoria.nome_categoria AS categoria, COUNT(patrimonio.categoria) AS total 
                        FROM patrimonio 
                        JOIN categoria ON patrimonio.categoria = categoria.id_categoria 
                        GROUP BY categoria.nome_categoria";
        $dados_categoria = mysqli_query($conn, $sql_categoria);
        $categoria_labels = [];
        $categoria_values = [];
        while ($linha = mysqli_fetch_assoc($dados_categoria)) {
            $categoria_labels[] = $linha['categoria'];
            $categoria_values[] = $linha['total'];
        }
    ?>
    
    <main class="main-grafico">
        <div class="total-manutencoes">
            <div>
                <i class="fi fi-sr-chart-pie-alt icone-x"></i>
                <span>Visão Geral do Património</span>
            </div>
            <div>
            </div>
        </div>

        <div class="grafico-container">
            <div>
                <p>Patrimonios por Estado</p>
                <canvas id="graficoEstado"></canvas>
            </div>
            <div>
                <p>Patrimonios por Categoria</p>
                <canvas id="graficoCategoria"></canvas>
            </div>
        </div>


        <div class="voltar" style="margin-top: 30px;">
            <a href="patrimonios.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const estadoLabels = <?php echo json_encode($estado_labels); ?>;
        const estadoValues = <?php echo json_encode($estado_values); ?>;
        const ctxEstado = document.getElementById('graficoEstado').getContext('2d');
        new Chart(ctxEstado, {
            type: 'doughnut',
            data: {
                labels: estadoLabels,
                datasets: [{
                    label: 'Total',
                    data: estadoValues,
                    backgroundColor: ['#4bc0c0', '#ff6384'],
                    borderWidth: 1
                }]

            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            font: { size: 14 },
                            usePointStyle: true,
                            pointStyle: 'circle',
                            boxWidth: 8,
                        }
                    }
                }
            }
        });

        
        const categoriaLabels = <?php echo json_encode($categoria_labels); ?>;
        const categoriaValues = <?php echo json_encode($categoria_values); ?>;
        const ctxCategoria = document.getElementById('graficoCategoria').getContext('2d');
        new Chart(ctxCategoria, {
            type: 'doughnut',
            data: {
                labels: categoriaLabels,
                datasets: [{
                    label: 'Total',
                    data: categoriaValues,
                    backgroundColor: ['#3498db', '#f1c40f', '#9b59b6', '#e67e22', '#1abc9c', '#34495e'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                        position: 'right'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
