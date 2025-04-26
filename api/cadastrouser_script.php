<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    //$senha = $_POST['senha'];
    $nivel_acesso = $_POST['nivel_acesso'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO `usuarios`(`nome`, `email`, `senha`,`nivel_acesso`) VALUES ('$nome','$email','$senha', '$nivel_acesso')";

    if(mysqli_query($conn, $sql)) {

        header("Location: ../pages/usuarios.php");
        exit();

    }else 
        mensagem( " 
        <div class='error-message'>
            <div class='message'>
                $nome Não foi cadastrado!
            </div>
            <p>
                <a href='../pages/cadastrouser.php'>Voltar</a>
            </p>
        </div>  ", '');
?>