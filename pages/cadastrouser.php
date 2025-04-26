<?php
       require_once "../includes/auth.php";
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Cadastro de usuarios</title>
</head>
<body>


    <section class="section">
        <form action="../api/cadastrouser_script.php" method="POST" class="form" enctype="multipart/form-data" style="width: 500px">

            <h1>Cadastrar Usuários</h1>

            <label for="">
                Nome:
                <input type="text" class="input" name="nome" placeholder="Nome completo" required>
            </label>

            <label for="">
                Email:
                <input type="text" class="input" name="email" placeholder="Email" required>
            </label>

            <label for="">
                Senha:
                <input type="text" class="input" name="senha" placeholder="Senha" required>
            </label>

            <label for="">
                <select name="nivel_acesso" id="" class="input" required>
                    <option disabled selected>Selecione o nível de acesso</option>
                    <option value="Admin">Admin</option>
                    <option value="Normal">Normal</option>
                </select>
            </label>
            
            <div class="link-icones" style="margin-top: 30px;">
                <button type="submit"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <a href="usuarios.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>

        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>