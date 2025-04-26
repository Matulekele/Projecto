<?php

    require_once "../includes/conexao.php";
    
    $messagem ="";

        if(isset($_POST['email']) || isset($_POST['senha'])) {
            if(strlen($_POST['email']) == 0) {
                $messagem = "Preenche o seu Nome ou Email";
            } else if(strlen($_POST['senha']) == 0) {
                $messagem =  "Preencha a sua senha";
            } else {

                $email = $mysqli->real_escape_string($_POST['email']);
                $senha = $_POST['senha']; 

                $sql_code = "SELECT * FROM usuarios WHERE email = '$email'";
                $sql_query = $mysqli->query($sql_code);

                $hasrows = $sql_query->num_rows;

                if($hasrows > 0) {
                    $usuario = $sql_query->fetch_assoc();
                    
                    if (password_verify($senha, $usuario['senha'])){
                        if(!isset($_SESSION)) {
                            session_start();
                        }

                        $_SESSION['id'] = $usuario['id'];
                        $_SESSION['name'] = $usuario['nome'];
                        $_SESSION['nivel_acesso'] = $usuario['nivel_acesso'];

                        header("Location: loading.php");
                        exit();

                    } else {
                        $messagem =  "Senha incorreto!";
                    }
                } else {
                    $messagem =  "E-mail incorreto!";
                } 

            }
        }

    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/login.css">
    <link rel="icon" href="icon/login.png">
    <title>Login</title>
</head>
<body>


    <div class="container">

        <div class="buttonsform">
            <div class="btncolor"></div>
            <button id="btnsign">Entrar</button>
            <button id="btnsignup">Criar conta</button>
        </div>

        <form action="" id="signin" class="form" method="POST">
            <div class="box-input">
                <div class="logo">
                    <h1>APW controller</h1>
                    <p>Entra com os seus dados pessoais</p>
                </div>

                <?php if (!empty($messagem)): ?>
                <div class="messagem"><?php echo $messagem; ?></div>
                <?php endif; ?>
                
                <input type="text" name="email" placeholder="Email ou nome do usuario" required>
                <input type="password" name="senha" placeholder="Senha">

                <div class="divcheck">
                    <input type="checkbox" placeholder=".">
                    <span>Lembrar a palavra passe</span>
                </div>
                <button type="submit" class="submit">Entrar</button>

            </div>        
        </form>

        <form action="../api/criar_conta.php" id="signup" class="form" method="POST"  enctype="multipart/form-data">
            <div class="box-input">
                <div class="logo">
                    <h1>APW controller</h1>
                    <p>Crie a sua conta de usuário</p>
                </div>
                <input type="text" placeholder="Nome completo" name="nome" required>
                <input type="text" placeholder="Email ou nome de Usuario" name="email">
                <input type="password" placeholder="Senha" name="senha">
                <div class="box-input-container">
                    <select name="nivel_acesso" id="nivel_acesso" style="width: 97%;">
                        <option disabled selected>Nível de acesso</option>
                        <option value="normal">Normal</option>
                    </select>
                </div>
                <button type="submit" class="submit">Criar a conta</button>
            </div>
        </form>

    </div>

    <script src="../script/script.js"></script>

    <script>
        // Impede o envio do formulário ao pressionar Enter
        document.getElementById("formCadastro").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
            }
        });
    </script>

</body>
</html>