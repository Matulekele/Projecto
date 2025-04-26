<?php

    session_start();

    if ( $_SESSION['nivel_acesso'] === 'Admin') {

    // Redireciona para uma página de erro ou para a home
    echo "<div class='error-message'>
            <div class='message'>
                Você não tem acesso a essa opção, é exclusivo para Administradores
            </div>
            <p><a href=''>Retroceder</a></p>
        </div>";
    }
    
?>