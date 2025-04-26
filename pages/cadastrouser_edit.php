<?php

        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        $id = $_GET['id'] ?? '';
        $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";

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


    <section class="section">
        <form action="../api/edituser_script.php" method="POST" class="form" style="width: 500px">

            <h1>Alterar o nível de acesso</h1>
            
            <select name="nivel_acesso" id="" class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; width: 100%; margin-top: 30px;" required>
                    <option disabled selected>Selecione o nível de acesso</option>
                    <option value="Admin">Admin</option>
                    <option value="Normal">Normal</option>
                </select>


            <div class="link-icones" style="margin-top: 30px;">
                <button type="submit" value="Salvar Alterações"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <input type="hidden" value="<?php echo $linha['id_usuario'];?>" name="id">
                <a href="usuarios.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>

        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>