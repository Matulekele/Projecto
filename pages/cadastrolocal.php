<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Cadastro de localizações</title>
</head>
<body>

    <?php

        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        if ($_SESSION['nivel_acesso'] === 'Admin') {
            $pesquisa = $_POST['busca'] ?? '';

            
        echo '<section class="section">
        <form action="../api/cadastrolocal_script.php" method="POST" class="form" style="width: 500px">

            <h1>Cadastrar localização</h1>

            <label for="nome">
                Nome:
                <input type="text" class="input" name="nome" placeholder="Nome da localização" required style = "width: 100%">
            </label>

            <label for="descricao">
                Descrição do local:
                <textarea id="description" class="input" name="descricao" placeholder="Descrição sobre o local" required></textarea>
            </label>

            <div class="link-icones" style="margin-top:30px">
                <button type="submit"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <a href="localizacoes.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>

        </form>
    </section>';

        } else {
            
            echo " <div class='error-message'>
                        <div class='message' style='';>
                            Você não tem acesso a essa opção, é exclusivo para Administradores
                        </div>
                        <p><a href='localizacoes.php'>Retroceder</a></p>
                    </div>";
        }
    ?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>