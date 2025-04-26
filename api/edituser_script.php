<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";
    
    $id = $_POST['id'];

    $nivel_acesso = $_POST['nivel_acesso'];

    $sql = "UPDATE `usuarios` SET `nivel_acesso` = '$nivel_acesso' WHERE id_usuario = $id";


    if(mysqli_query($conn, $sql)) {
        header("Location: ../pages/usuarios.php");
        exit();
    }else 
        mensagem( " 
            <div class='error-message'>
            <div class='message'>
                $nome Não foi alterado!
            </div>
            <p>
                <a href='../pages/usuarios.php'>Voltar</a>
            </p>
        </div> ", 'danger');

?>