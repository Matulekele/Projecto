<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Cadastro de responsáveis</title>
</head>
<body>

    <?php

    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

        if ($_SESSION['nivel_acesso'] === 'Admin') {
            $pesquisa = $_POST['busca'] ?? '';

            
        echo '<section class="section">
        <form action="../api/responsavel_script.php" method="POST" class="form" enctype="multipart/form-data" style="width: 800px">

            <h1>Cadastrar responsável</h1>

            <label for="responsavel">
                Nome compeleto:
                <input type="text" class="input" name="responsavel" placeholder="Nome completo" required style="width: 100%">
            </label>
            
            <select name="genero" id="" class="input" required style="width:100%;">
                <option disabled selected>Genero</option>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select>
            
            <label for="celular">
                Número de telefone:
                <input type="number" class="input" name="celular" placeholder="Número de telefone" required>
            </label>

            <label for="endereco">
                Endereço:
                <input type="text" class="input" name="endereco" placeholder="Endereço Residencial" required style="width: 100%">
            </label>

            <label for="cargo">
                Cargo/Função:
                <input type="text" class="input" name="cargo" placeholder="Cargo/Função" required style="width: 100%">
            </label>

            <div class="link-icones" style="margin-top:30px">
                <button type="submit" ><i class="fi fi-sr-floppy-disks icones"></i></button>
                <a href="responsaveis.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>

        </form>
    </section>';
                        


        } else {

            echo " <div class='error-message'>
                        <div class='message' style='';>
                            Você não tem acesso a essa área, é exclusivo para Administradores
                        </div>
                        <p><a href='responsaveis.php'>Retroceder</a></p>
                    </div>";
        }

    ?> 

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>