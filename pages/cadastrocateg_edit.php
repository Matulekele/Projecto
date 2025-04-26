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

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $id = $_GET['id'] ?? '';
    $sql = "SELECT * FROM categoria WHERE id_categoria = $id";

    $dados = mysqli_query($conn, $sql);

    $linha = mysqli_fetch_assoc($dados);

    
    if ($_SESSION['nivel_acesso'] === 'Admin') {
        $pesquisa = $_POST['busca'] ?? '';

        echo '<section class="section">
            <form action="../api/editcateg_script.php" method="POST" class="form" style="margin-top: 10%; width: 500px">

                <h1>Editar dados</h1>

                <label for="nome">
                    Nome da categoria:
                    <input type="text" class="input" name="nome_categoria" placeholder="Nome da categoria" required value="'.$linha["nome_categoria"].'" style="width:100%">
                </label>

                  <label for="descricao">
                    Descrição da categoria:
                    <textarea id="description" class="input" name="descricao" placeholder="Descrição">'.$linha["descricao"].'</textarea>
                </label>

                <div class="link-icones" style="margin-top: 30px">
                    <button type="submit" value="Salvar Alterações"><i class="fi fi-sr-floppy-disks icones"></i></button>
                    <input type="hidden" value="'.$linha["id_categoria"].'" name="id">
                    <a href="categorias.php"><i class="fi fi-sr-overview icones"></i></a>
                </div>

            </form>
        </section>';

    } else {

        echo " <div class='error-message'>
                    <div class='message'>
                        Você não tem acesso a essa opção, é exclusivo para Administradores
                    </div>
                    <p><a href='categorias.php'>Retroceder</a></p>
                </div>";
    }
?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>