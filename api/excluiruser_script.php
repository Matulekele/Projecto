<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";
    
    $id = $_POST['id'];
    $nome = $_POST['nome'];

    $sql = "DELETE FROM `usuarios` WHERE id_usuario = $id";

    if(mysqli_query($conn, $sql)) {
        header("Location: ../pages/usuarios.php");
        exit();

    }else 
        mensagem( " 
            <div class='error-message'>
            <div class='message'>
                $nome Não foi excluido!
            </div>
            <p>
                <a href='../pages/usuarios.php'>Voltar</a>
            </p>
        </div> ", 'danger');

?>