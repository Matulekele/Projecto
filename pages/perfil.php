<?php
    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $nome = $_SESSION['name'];

    $sql = "SELECT * FROM usuarios WHERE nome = '$nome' LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $usuario = mysqli_fetch_assoc($result);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $novo_nome = mysqli_real_escape_string($conn, $_POST['nome']);
        $novo_email = mysqli_real_escape_string($conn, $_POST['email']);
        $foto = $usuario['foto'];

        if (isset($_FILES['nova_foto']) && $_FILES['nova_foto']['error'] === UPLOAD_ERR_OK) {
            $foto_nome = uniqid() . "-" . $_FILES['nova_foto']['name'];
            $foto_caminho = "../img/" . $foto_nome;
            move_uploaded_file($_FILES['nova_foto']['tmp_name'], $foto_caminho);
            $foto = $foto_nome;
        }

        $update_sql = "UPDATE usuarios SET nome='$novo_nome', email='$novo_email', foto='$foto' WHERE id_usuario={$usuario['id_usuario']}";
        if (mysqli_query($conn, $update_sql)) {
            $_SESSION['name'] = $novo_nome;
            header("Location: perfil.php");
            exit;
        } else {
            echo "Erro ao atualizar perfil!";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="../style/perfil.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
</head>
<body>


    <main class="main">
        <img src="../img/<?php echo htmlspecialchars($usuario['foto']); ?>" alt="Foto do Usuário">

        <div class="perfil-info" id="visualizar">
            <p><i class="fi fi-sr-user"></i> <?php echo htmlspecialchars($usuario['nome']); ?></p>
            <p><i class="fi fi-sr-envelope"></i> <?php echo htmlspecialchars($usuario['email']); ?></p>
            <p><i class="fi fi-sr-user-gear"></i> <?php echo htmlspecialchars($usuario['nivel_acesso']); ?></p>
        </div>

        <div class="perfil-container">
            
            <form method="POST" enctype="multipart/form-data" class="form-editar" id="editar">
                <label>
                    <i class="fi fi-sr-user" style="font-size: 20px;"></i>
                    <input type="text" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required style="width: 100%;">
                </label>
        
                <label>
                    <i class="fi fi-sr-envelope" style="font-size: 20px;"></i>
                    <input type="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required style="width: 100%;">
                </label>
        
                <label>
                    <i class="fi fi-sr-picture" style="font-size: 20px;"></i>
                    <input type="file" name="nova_foto" accept="image/*">
                </label>
                
        
                <button type="submit">Salvar Alterações</button>
            </form>
        
        </div>
        
        <div class="toggle-area">
            <button class="toggle-btn" onclick="alternarModo()" style="cursor: pointer;">✏️ Editar</button>
        </div>
        
        <div class="voltar">
            <a href="dashboard.php" class="back-btn"><i class="fi fi-sr-arrow-circle-left icone-op"></i></a>
        </div>

        
    </main>


<script>
    let modoEdicao = false;

    function alternarModo() {
        const visualizar = document.getElementById('visualizar');
        const editar = document.getElementById('editar');
        const btn = document.querySelector('.toggle-btn');

        modoEdicao = !modoEdicao;

        if (modoEdicao) {
            visualizar.style.display = 'none';
            editar.style.display = 'block';
            btn.textContent = '👁️ Ver';
        } else {
            visualizar.style.display = 'block';
            editar.style.display = 'none';
            btn.textContent = '✏️ Editar';
        }
    }
</script>

</body>
</html>