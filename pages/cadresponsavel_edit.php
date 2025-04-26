<?php
    include_once "../includes/conexao.php";
    include_once "../includes/auth.php";

    $id = $_GET['id'] ?? '';
    $sql = "SELECT * FROM responsaveis WHERE id_responsavel = $id";
    $dados = mysqli_query($conn, $sql);
    $linha = mysqli_fetch_assoc($dados);
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Alteração de dados</title>
</head>
<body>


    <?php
    if ($_SESSION['nivel_acesso'] === 'Admin') {
        echo '<section class="section">
        <form action="../api/editresp_script.php" method="POST" class="form" style="width: 800px">

            <h1>Alterar os dados</h1>

            <label for="">
                Nome:
                <input type="text" class="input" name="responsavel" placeholder="Nome completo" required value="'.$linha["responsavel"].'"  style="width: 100%">
            </label>

            <label for="">
                Cargo/Função:
                <input type="text" class="input" name="cargo" placeholder="Cargo/Função" required value="'.$linha["cargo"].'" style="width: 100%">
            </label>

            <label for="">
                Número de telefone:
                <input type="number" class="input" name="celular" placeholder="Número de telefone" required value="'.$linha["celular"].'">
            </label>

            <label for="">
                Endereço:
                <input type="text" class="input" name="endereco" placeholder="Endereço Residencial" required value="'.$linha["endereco"].'">
            </label>
  
            <div class="link-icones" style="margin-top:30px">
                <button type="submit" class="btn-cadastrar"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <input type="hidden" name="id" value="'.$linha["id_responsavel"].'">
                <a href="responsaveis.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>

        </form>
        
    </section>';
    } else {
        echo "<div class='error-message'>
                <div class='message'>
                    Você não tem acesso a essa opção, é exclusivo para Administradores
                </div>
                <p><a href='responsaveis.php'>Retroceder</a></p>
            </div>";
    }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>