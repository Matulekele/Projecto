<?php

        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        if ($_SESSION['nivel_acesso'] === 'Admin') {

            $queryPatrimonio = "SELECT id_patrimonio, nome FROM patrimonio";
            $resultadoPatrimonio = mysqli_query($conn, $queryPatrimonio);

            $queryLocalizacao = "SELECT id_localizacao, nome FROM localizacao";
            $resultadoLocalizacao = mysqli_query($conn, $queryLocalizacao);

            $queryResponsaveis = "SELECT id_responsavel, responsavel FROM responsaveis";
            $resultadoResponsaveis = mysqli_query($conn, $queryResponsaveis);
    ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/cadastro.css">
    <link rel="stylesheet" href="../flaticon/css/uicons-solid-rounded.css">
    <link rel="icon" href="icon/icone.png">
    <title>Registro de Manutenção</title>
</head>
<body>


    <section class="section">
        <form action="../api/manutencao_script.php" method="POST" enctype="multipart/form-data" class="form">

            <h1 style="margin-bottom: 20px;">Registrar Manutenção</h1>

            <select name="id_patrimonio" class="input" required>
                <option disabled selected>Selecione o Patrimonio</option>
                <?php while ($patrimonio = mysqli_fetch_assoc($resultadoPatrimonio)) {
                    echo "<option value='" . $patrimonio['id_patrimonio'] . "'>" . $patrimonio['nome'] . "</option>";
                } ?>
            </select>

            <select name="id_localizacao" class="input" required>
                <option disabled selected>Localização</option>
                <?php while ($localizacao = mysqli_fetch_assoc($resultadoLocalizacao)) {
                    echo "<option value='" . $localizacao['id_localizacao'] . "'>" . $localizacao['nome'] . "</option>";
                } ?>
            </select>
            
            <select name="tipo_manutencao" class="input" required>
                <option disabled selected>Tipo de Manutenção</option>
                <option value="Preventiva">Preventiva</option>
                <option value="Corretiva">Corretiva</option>
                <option value="Preditiva">Preditiva</option>
            </select>

            <select name="prioridade" class="input" required>
                <option disabled selected>Prioridade</option>
                <option value="Baixa">Baixa</option>
                <option value="Media">Media</option>
                <option value="Alta">Alta</option>
                <option value="Critica">Critica</option>
            </select>

            <select name="id_responsavel" class="input" required>
                <option disabled selected>Responsável</option>
                <?php while ($responsavel = mysqli_fetch_assoc($resultadoResponsaveis)) {
                    echo "<option value='" . $responsavel['id_responsavel'] . "'>" . $responsavel['responsavel'] . "</option>";
                } ?>
            </select>

        <div class="separador">

            <label for="" style="width: 50%;">
                Descrição do Problema
                <textarea class="input" name="descricao_problema" placeholder="Descrição do Problema" required></textarea>
            </label>

            <label for="" style="width: 50%;">
                Observação:
                <textarea class="input" name="observacao" placeholder="Observação"></textarea>
            </label>

        </div>

        <div class="separador">

            <label for="">
                Data do pedido
                <input type="date" class="input" name="data_pedido" required>
            </label>

            <label for="">
                Data do inicio (Opcional)
                <input type="date" class="input" name="data_inicio">
            </label>

            <label for="">
                Data de conclusão (Opcional)
                <input type="date" class="input" name="data_conclusao">
            </label>

        </div>
            
        <label for="">
            Satatus:
            <select name="status" class="input" required>
                <option disabled selected>Status</option>
                <option value="Pendente">Pendente</option>
                <option value="Em andamento">Em andamento</option>
                <option value="Concluído">Concluído</option>
                <option value="Cancelado">Cancelado</option>
            </select>
        </label>

        <label for="imagem">
            Foto:
            <input type="file" class="input" name="imagem" accept="image/*">
        </label>
        
        <div class="link-icones" style="margin-top: 30px;">
            <button type="submit"><i class="fi fi-sr-floppy-disks icones"></i></button>
            <a href="manutencoes.php"><i class="fi fi-sr-overview icones"></i></a>
        </div>

        </form>
    </section>


    <?php }
        else {
            echo "<div class='error-message'>
                    <div class='message'>Acesso negado. Apenas administradores podem acessar esta página.</div>
                    <p><a href='home.php'>Retroceder</a></p>
                  </div>";
        }
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>