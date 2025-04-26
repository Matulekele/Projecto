<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Área de Relatórios</title>
    <link rel="stylesheet" href="pesquisar.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="icon/icone.png">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: var(--backx);
            color: #333;
        }
        :root{
            --backx: #ebebeb;
            --backy: #ffffff7e;
            --primary: #232537;
            --shadow: #1a1922;
            --shadowx: #e8ebee;
            --texto: #eeeeedd3;
        }
        .container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 1rem;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
        }

        .card {
            height: 320px;
            border-radius: 8px;
            box-shadow: 0 0px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: transform 0.3s;
        }

        .picture {
            width: 100%;
            height: 50%;
            overflow: hidden;
            margin-bottom: 10px;
        }

        .picture img {
            width: 100%;
            height: 100%;
            border-radius: 8px;
            object-fit: contain;
        }

        .card:hover {
            transform: scale(1.02);
        }

        .card h2 {
            margin: 0 0 0.5rem;
            font-size: 1.25rem;
            color: var(--shadow);
        }

        .card p {
            margin: 0 0 1rem;
            color: #555;
        }

        .card button {
            padding: 0.5rem 1rem;
            background: var(--primary);
            border-radius: 8px;
            border: 2px solid #ccc;
            color: var(--texto);
            font-weight: bold;
            cursor: pointer;
            outline: none;
            transition: background-color 0.3s ease;
        }

        .card button a {
            text-decoration: none;
            color: inherit;
            font-family: "Poppins";
        }

        .card button:hover {
            background: var(--backx);
            color: var(--primary);
        }

        .btn {
            text-align: center;
            margin-top: 1rem;
            color: #777;
        }

        .btn a {
            margin: 20px 0;
            display: inline-block;
            background-color: var(--primary);
            padding: 8px 16px;
            border-radius: 8px;
            border: 2px solid #ccc;
            outline: none;
            box-shadow: 0 0 5px 0 var(--shadowx);
            transition: .3s ease-out;
            color: var(--texto);
            font-family: "Poppins";
        }

        .btn a:hover {
            background: transparent;
            box-shadow: 0 0 10px 0 var(--shadowx);
            transform: scale(1.01);
            color: var(--primary);
        }
    </style>
</head>
<body>
    <main class="main-relatorios">
        <div class="container">
            <div class="grid">
                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Todos os Bens</h2>
                    <p>Resumo completo de todos os patrimonios cadastrados no aplicativo.</p>
                    <button> <a href="relatorio.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Equipamentos em Bom Estado</h2>
                    <p>Relatório de todos os equipamentos em bom estado atualmente.</p>
                    <button> <a href="relatorio_bons.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Equipamentos em Mau Estado</h2>
                    <p>Relatório de todos os equipamentos que se encontram em mau estado.</p>
                    <button> <a href="relatorio_mal.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Manutenções</h2>
                    <p>Relatório de todos equipamentos em manutenção.</p>
                    <button> <a href="relatorio_man.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Localizações</h2>
                    <p>Relatório de todas as localizações cadastrados no sistema.</p>
                    <button> <a href="relatorio_local.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Categorias</h2>
                    <p>Relatório de todas as categorias existentes no aplicativo.</p>
                    <button> <a href="relatorio_categoria.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Responsáveis</h2>
                    <p>Relatório de todos os responsaveis cadastradas no sistema.</p>
                    <button> <a href="relatorio_resp.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/relatorio.png" alt="">
                    </div>
                    <h2>Movimentações</h2>
                    <p>Relatório de todas as Movimentações dos bens feito no aplicativo.</p>
                    <button> <a href="relatorio_mov.php">Visualizar</a></button>
                </div>

                <div class="card">
                    <div class="picture">
                        <img src="./img/back.png" alt="">
                    </div>
                    <h2>Voltar</h2>
                    <p>Voltar no dashboard.</p>
                    <button> <a href="dashboard.php">Voltar na pagina Inicial</a></button>
                </div>

            </div>

        </div>
    </main>
</body>
</html>
