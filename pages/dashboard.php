<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";
    include_once "../includes/fonts.php";


    $nome = $_SESSION['name'];
    $sql_user = "SELECT nome, foto FROM usuarios WHERE nome = '$nome' LIMIT 1";
    $result_user = mysqli_query($conn, $sql_user);
    $usuario = mysqli_fetch_assoc($result_user);
    $foto_usuario = $usuario['foto'];


    function getCount($table) {
        global $conn;
        $result = $conn->query("SELECT COUNT(*) AS total FROM $table");
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    $sql_mov = "SELECT COUNT(*) AS total_mov FROM movimentacao";
    $result_mov = mysqli_query($conn, $sql_mov);
    $total_mov = mysqli_fetch_assoc($result_mov)['total_mov'];
        
        
    $sql_man = "SELECT COUNT(*) AS total_man FROM manutencao";
    $result_man = mysqli_query($conn, $sql_man);
    $total_man = mysqli_fetch_assoc($result_man)['total_man'];
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/dashboard.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
</head>
<body>

    <main class="main">

        <nav class="nav">
            <ul class="links">
                <li>
                    <a href="dashboard.php" title="Actualizar"><i class="fi fi-sr-home menu-icone" style="color: #e6ff50"></i></a>
                </li>

                <li>
                    <a href="patrimonios.php" title="Bens"><i class="fi fi-sr-layers menu-icone"></i></a>
                </li>
                <li>
                    <a href="localizacoes.php" title="Locais"><i class="fi fi-sr-region-pin-alt menu-icone"></i></a>
                </li>
                <li>
                    <a href="categorias.php" title="Categorias"><i class="fi fi-sr-category menu-icone"></i></a>
                </li>
                <li>
                    <a href="movimentacoes.php" title="Movimentações"><i class="fi fi-sr-person-dolly menu-icone"></i></a>
                </li>
                <li>
                    <a href="manutencoes.php" title="Manutenções"><i class="fi fi-sr-tools menu-icone"></i></a>
                </li>
                <li>
                    <a href="responsaveis.php" title="Supervisores"><i class="fi fi-sr-chart-user menu-icone"></i></a>
                </li>
                <li>
                    <a href="#" title="Gráficos"><i class="fi fi-sr-chart-pie-alt menu-icone"></i></a>
                </li>

                <li>
                    <a href="#" title="Filtragem"><i class="fi fi-sr-filter-list menu-icone"></i></a>
                </li>

                <!--<li>
                    <a href="#" title="Notificações"><i class="fi fi-sr-bell-notification-social-media menu-icone"></i></a>
                </li>-->

                <li>
                    <a href="usuarios.php" title="Credencias"><i class="fi fi-sr-user menu-icone"></i></a>
                </li>

                <li>
                    <a href="loading_sair.php" id="fechar"><i class="fi fi-sr-power menu-icone" style="color: #ff000093; margin-top: 10px;"></i></a>
                </li>
            </ul>
        </nav>


        <section class="section">

            <header class="topo">
                <div>
                    <p class="app">APW <span>Controller</span></p>
                </div>
                
                <div style="position: relative;">

                    <a href="notificacoes.php" class="notif" style="position: relative;">
                        <?php
                            $sqlNotif = "SELECT COUNT(*) AS total FROM notificacoes 
                                        WHERE visualizada = 0 AND data >= NOW() - INTERVAL 7 DAY";
                            $resNotif = mysqli_query($conn, $sqlNotif);
                            $notificacoesNovas = mysqli_fetch_assoc($resNotif)['total'];
                        ?>
                        <span>Notificações</span>
                        <i class="fi fi-sr-bell menu-icone"></i>
                        <?php if ($notificacoesNovas > 0): ?>
                            <p class="badge" style="background-color:rgba(255, 0, 0, 0.84); color: white; border-radius: 50%; padding: 2px 8px;font-size: 12px; position: absolute; top: -3px; right: 2.5px;"><?= $notificacoesNovas ?></p>
                        <?php endif; ?>
                    </a>

                    <p class="nome"><?php echo htmlspecialchars($usuario['nome']); ?></p>

                    <div onclick="toggleDropdown()" style="cursor: pointer;" class="avatar">
                        <img src="../img/<?php echo htmlspecialchars($foto_usuario); ?>" 
                            alt="Perfil" 
                            style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; transition: transform 0.3s;"
                            onmouseover="this.style.transform='scale(1.1)'" 
                            onmouseout="this.style.transform='scale(1)'">
                    </div>

                    <!-- Dropdown -->
                    <div id="dropdownMenu" class="Dropdown-usuario">
                        <div>
                            <a href="perfil.php" ><i class="fi fi-sr-settings user-icone"></i></a>
                            <a href="loading_sair.php"><i class="fi fi-sr-power user-icone" style="color: #ff000093;"></i></a>
                        </div>
                    </div>
                </div>


            </header>
            
            <div class="banner">

                <div class="cards">
    
                    <div class="itens">
                        <a href="patrimonios.php">
                            <i class="fi fi-sr-layers cards-icone"></i>
                            <p>
                                <span> <?php echo getCount('patrimonio'); ?> </span>
                                <span>Patrimónios</span>
                            </p>
                        </a>
                    </div>
    
                    <div class="itens">
                        <a href="responsaveis.php">
                            <i class="fi fi-sr-chart-user cards-icone"></i>
                            <p>
                                <span><?php echo getCount('responsaveis'); ?></span>
                                <span>Supervisores</span>
                            </p>
                        </a>
                    </div>
    
                    <div class="itens">
                        <a href="localizacoes.php">
                            <i class="fi fi-sr-region-pin-alt cards-icone"></i>
                            <p>
                                <span><?php echo getCount('localizacao'); ?></span>
                                <span>Localizações</span>
                            </p>
                        </a>
                    </div>
    
                    <div class="itens">
                        <a href="categorias.php">
                            <i class="fi fi-sr-category cards-icone"></i>
                            <p>
                                <span><?php echo getCount('categoria'); ?></span>
                                <span>Categorias</span>
                            </p>
                        </a>
                    </div> 
    
                    <div class="itens">
                        <a href="manutencoes.php">
                            <i class="fi fi-sr-tools cards-icone"></i>
                            <p>
                                <span><?php echo getCount('manutencao'); ?></span>
                                <span>Manutenções</span>
                            </p>
                        </a>
                    </div>   
    
                </div>
                
            </div>


            <div class="recente">

                <div>
                    <p><i class="fi fi-sr-stats"></i> Visão geral</p>
                    <span></span>
                </div>
                
                <div>
                    <p>Bens cadastrados recentemente <i class="fi fi-sr-list-check"></i></p>
                    <span></span>
                </div>
            </div>



            <div id="content" class="views">

                <div id="content" class="grafico">

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <canvas id="patrimonioChart"></canvas>

                    <script>
                        const ctx = document.getElementById('patrimonioChart').getContext('2d');
                        const totalPatrimonios = <?php echo getCount('patrimonio'); ?>;
                        const totalResponsaveis = <?php echo getCount('responsaveis'); ?>;
                        const totalLocalizacoes = <?php echo getCount('localizacao'); ?>;
                        const totalCategorias = <?php echo getCount('categoria'); ?>;

                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: ['Patrimónios', 'Supervisores', 'Localizações', 'Categorias'],
                                datasets: [{
                                    label: 'Total de dados',
                                    data: [totalPatrimonios, totalResponsaveis, totalLocalizacoes, totalCategorias],
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)'
                                    ],
                                    borderWidth: 1.8
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
                </div>

                <div class="grafico2">

                    <div id="" class="">
                        <section class="resumo">
                            <canvas id="graficoEquipamentos" width="260" height="160"></canvas>
                            <script>
                                const totalmov = <?php echo $total_mov; ?>;
                                const totalman = <?php echo $total_man; ?>;
            
                                const ctx1 = document.getElementById('graficoEquipamentos').getContext('2d');
                                new Chart(ctx1, {
                                    type: 'doughnut',
                                    data: {
                                        labels: ['Movimentações', 'Manutenções'],
                                        datasets: [{
                                            label: 'Total dos equipamentos',
                                            data: [totalmov, totalman],
                                            backgroundColor: [
                                                'rgba(231, 77, 60, 0.61)',
                                                'rgba(75, 122, 250, 0.38)' 
                                            ],
                                            borderColor: [
                                                'rgba(231, 77, 60, 0.61)',
                                                'rgba(75, 122, 250, 0.45)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        plugins: {
                                            legend: {
                                                position: 'bottom',
                                                labels: {
                                                    font: {
                                                        size: 11,
                                                    },
                                                    usePointStyle: true,
                                                    pointStyle: 'circle',
                                                    boxWidth: 8,
                                                },
                                            },
                                        },
                                    }
                                });
                            </script>
                        </section>
                    </div>

                </div>

                
            <div class="legenda">
                <div>
                    <p><i class="fi fi-sr-list-check"></i> Bens cadastrados recentemente</p>
                    <span></span>
                </div>
            </div>


                <div class="tabela">
                    <table class="tabela_recentes" border="1">
                        <thead>
                            <tr>
                                <th style="text-align:left; padding: 0 10px;">Nome</th>
                                <th>Quantidade</th>
                                <th style="text-align:left">Estado</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php 

                                if ($conn) {
                                    $sql = "SELECT nome, quantidade, estado FROM patrimonio ORDER BY dataaquisicao DESC LIMIT 7";
                                    $dados = mysqli_query($conn, $sql);

                                    if ($dados) {
                                        while ($linha = mysqli_fetch_assoc($dados)) {
                                            $nome = htmlspecialchars($linha['nome']);
                                            $quantidade = htmlspecialchars($linha['quantidade']);
                                            $estado = htmlspecialchars($linha['estado']);

                                            echo "
                                            <tr>
                                                <td class='nome'>$nome</td>
                                                <td style='text-align: center;'>$quantidade</td>
                                                <td>$estado</td>
                                            </tr>
                                            ";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' style='text-align: center;'>Nenhum registro de momento</td></tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' style='text-align: center;'>Erro na conexão com o banco de dados.</td></tr>";
                                }

                                echo " 
                                    <tr>
                                        <td colspan='3' style='text-align: center;'><a href='patrimonios.php'><i class='fi fi-sr-time-fast'></i> Ver todos</a>
                                        </td>
                                    </tr>
                                ";
                            
                            ?>

                        </tbody>

                    </table>
                </div>


            </div>




        </section>

    </main>


    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>


    <script>
    const dropdown = document.getElementById("dropdownMenu");
    const userInfo = document.querySelector(".user-info");

    function toggleDropdown() {
        if (dropdown.style.display === "block") {
            dropdown.style.opacity = "0";
            dropdown.style.transform = "translateY(-10px)";
            setTimeout(() => dropdown.style.display = "none", 200);
        } else {
            dropdown.style.display = "block";
            setTimeout(() => {
                dropdown.style.opacity = "1";
                dropdown.style.transform = "translateY(0)";
            }, 10);
        }
    }

    window.addEventListener("click", function(e) {
        if (!userInfo.contains(e.target)) {
            dropdown.style.opacity = "0";
            dropdown.style.transform = "translateY(-10px)";
            setTimeout(() => dropdown.style.display = "none", 200);
        }
    });
    </script>

</body>
</html>