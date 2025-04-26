<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <link  rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Usuarios</title>
</head>
<body>


<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {
        $pesquisa = $_POST['busca'] ?? '';

    $sql = "SELECT * FROM usuarios WHERE nome LIKE '%$pesquisa%' ";

    $dados = mysqli_query($conn, $sql);
    
    echo '<main class="main">
        <div class="content" id="content">


            <form class="form" action="usuarios.php" method="POST" enctype="multipart/form-data" style="margin-top: 60px; margin-bottom: 20px;">
                <div class="icones-area">
                    <label for="">
                        <i class="bi bi-search"></i>
                        <input type="search" placeholder="Pesquisar" name="busca" autofocus>
                    </label>
                   <button type="button" onclick="location.href=\'cadastrouser.php\'" title="Cadastrar usuário">
                    <i class="fi fi-sr-folder-plus-circle icone-op"></i>
                    </button>
                    <button type="button" onclick="location.href=\'dashboard.php\'" title="Voltar">
                    <i class="fi fi-sr-arrow-circle-left icone-op"></i>
                    </button>
                </div>
            </form>


            <div class="tabela-container">

            <table class="table table-hover" id="table-hover">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">Nome Completo</th>
                        <th scope="col">Email ou nome de Usuario</th>
                        <th scope="col" style="text-align: center">Nível de acesso</th>
                        <th scope="col" style="text-align: center">Funções</th>
                    </tr>
                </thead>
                <tbody>';
                
                while ($linha = mysqli_fetch_assoc($dados)) {
                    $foto = $linha['foto'];
                    $id_usuario = $linha['id_usuario'];
                    $nome = $linha['nome'];
                    $email = $linha['email'];
                    //$senha = $linha['senha'];
                    $nivel_acesso = $linha['nivel_acesso'];
                    $mostra_foto = $foto ? "<img src='../img/$foto' class='lista_foto'>" : "";

                    echo "<tr>
                            <th>$mostra_foto</th>
                            <th scope=\'row\'>$nome</th>
                            <td>$email</td>
                            <td style='text-align: center'>$nivel_acesso</td>
                            <td style='text-align: center'>
                                <a href=\"cadastrouser_edit.php?id=$id_usuario\" class=\"\"><i class=\"fi fi-sr-admin-alt icone-funcoes\" style='color:green;'></i></a>
                                <a href=\"#\" class=\"\" data-bs-toggle=\"modal\" data-bs-target=\"#confirma\" onclick=\"pegar_dados($id_usuario, '$nome')\"><i class=\"fi fi-sr-trash-empty icone-funcoes\" style='color:#ad0909;'></i></a>
                            </td>
                        </tr>";
                }

echo '      </tbody>
            </table>
            </div>
        </div>
        <div class="modal fade" id="confirma" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="header-modal modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmação de exclusão</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="../api/excluiruser_script.php" method="POST">
                        <div class="content-modal modal-body">
                            <p>Deseja realmente excluir Usuario
                                <b id="nome_usuario"> Nome do patrimonio</b> do aplicativo?</p>
                            <p><b>OBS.:</b> Todos os dados serão eliminados.</p>
                        </div>
                        <div class="footer-modal modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <input type="hidden" name="nome" id="nome_usuario_1" value="">
                            <input type="hidden" name="id" id="id_usuario" value="">
                            <input type="submit" class="btn btn-danger" value="Excluir">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>';


} else {

    echo " <div class='error-message'>
                <div class='message'>
                    Você não tem acesso a essa área, é exclusivo para Administradores
                </div>
                <p><a href='dashboard.php'>Retroceder</a></p>
            </div>";
}
?> 

    <script type="text/javascript">
        function pegar_dados(id, nome) {
            document.getElementById('nome_usuario').innerHTML = nome;
            document.getElementById('nome_usuario_1').value = nome;
            document.getElementById('id_usuario').value = id;
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>
</html>