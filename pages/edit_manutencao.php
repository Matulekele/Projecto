    <?php
    
        require_once "../includes/conexao.php";
        require_once "../includes/auth.php";

        if ($_SESSION['nivel_acesso'] === 'Admin') {

            $id = $_GET['id'] ?? '';

            $sql = "SELECT * FROM manutencao WHERE id_manutencao = $id";
            $dados = mysqli_query($conn, $sql);
            $linha = mysqli_fetch_assoc($dados);

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
    <title>Editar Manutenção</title>
</head>
<body>
    
 
    <section class="section">
        <form action="../api/edit_manutencao_script.php" method="POST" enctype="multipart/form-data" class="form" style="margin-top: 40px;">

            <input type="hidden" name="id_manutencao" value="<?php echo $linha['id_manutencao']; ?>">

            <h1 style="margin-bottom: 20px;">Editar o registro</h1>

            <select name="id_patrimonio" class="input" required>
                <option disabled>Selecione o Patrimonio</option>
                <?php while ($patrimonio = mysqli_fetch_assoc($resultadoPatrimonio)) {
                    $selected = ($patrimonio['id_patrimonio'] == $linha['id_patrimonio']) ? "selected" : "";
                    echo "<option value='{$patrimonio['id_patrimonio']}' $selected>{$patrimonio['nome']}</option>";
                } ?>
            </select>

            <select name="id_localizacao" class="input" required>
                <option disabled>Localização</option>
                <?php while ($localizacao = mysqli_fetch_assoc($resultadoLocalizacao)) {
                    $selected = ($localizacao['id_localizacao'] == $linha['id_localizacao']) ? "selected" : "";
                    echo "<option value='{$localizacao['id_localizacao']}' $selected>{$localizacao['nome']}</option>";
                } ?>
            </select>
            
            <select name="tipo_manutencao" class="input" required>
                <option disabled>Tipo de Manutenção</option>
                <option value="Preventiva" <?php echo ($linha['tipo_manutencao'] == 'Preventiva') ? 'selected' : ''; ?>>Preventiva</option>
                <option value="Corretiva" <?php echo ($linha['tipo_manutencao'] == 'Corretiva') ? 'selected' : ''; ?>>Corretiva</option>
                <option value="Preditiva" <?php echo ($linha['tipo_manutencao'] == 'Preditiva') ? 'selected' : ''; ?>>Preditiva</option>
            </select>

            <select name="prioridade" class="input" required>
                <option disabled>Prioridade</option>
                <option value="Baixa" <?php echo ($linha['prioridade'] == 'Baixa') ? 'selected' : ''; ?>>Baixa</option>
                <option value="Media" <?php echo ($linha['prioridade'] == 'Media') ? 'selected' : ''; ?>>Média</option>
                <option value="Alta" <?php echo ($linha['prioridade'] == 'Alta') ? 'selected' : ''; ?>>Alta</option>
                <option value="Critica" <?php echo ($linha['prioridade'] == 'Critica') ? 'selected' : ''; ?>>Crítica</option>
            </select>

            <select name="id_responsavel" class="input" required>
                <option disabled>Responsável</option>
                <?php while ($responsavel = mysqli_fetch_assoc($resultadoResponsaveis)) {
                    $selected = ($responsavel['id_responsavel'] == $linha['id_responsavel']) ? "selected" : "";
                    echo "<option value='{$responsavel['id_responsavel']}' $selected>{$responsavel['responsavel']}</option>";
                } ?>
            </select>

            <div class="separador">
                <label for="" style="width: 50%;">
                    Descrição do Problema
                    <textarea class="input" name="descricao_problema" placeholder="Descrição do Problema" required><?php echo $linha['descricao_problema']; ?></textarea>
                </label>
                
                <label for="" style="width: 50%;">
                    Observação:
                    <textarea class="input" name="observacao" placeholder="Observação"> <?php echo $linha['observacao']; ?></textarea>
                </label>
            </div>

            <div class="separador">

                <label for="">
                    Data do pedido
                    <input type="date" class="input" name="data_pedido" required value="<?php echo $linha['data_pedido'];?>">
                </label>

                <label for="">
                    Data do inicio (Opcional)
                    <input type="date" class="input" name="data_inicio" value="<?php echo $linha['data_inicio'];?>">
                </label>

                <label for="">
                    Data da conclusão (Opcional)
                    <input type="date" class="input" name="data_conclusao" value="<?php echo $linha['data_conclusao'];?>">
                </label>

            </div>

            <label for="">
                Status:
                <select name="status" class="input" required>
                    <option disabled>Status</option>
                    <option value="Pendente" <?php echo ($linha['status'] == 'Pendente') ? 'selected' : ''; ?>>Pendente</option>
                    <option value="Em andamento" <?php echo ($linha['status'] == 'Em andamento') ? 'selected' : ''; ?>>Em andamento</option>
                    <option value="Concluído" <?php echo ($linha['status'] == 'Concluído') ? 'selected' : ''; ?>>Concluído</option>
                    <option value="Cancelado" <?php echo ($linha['status'] == 'Cancelado') ? 'selected' : ''; ?>>Cancelado</option>
                </select>
            </label>

            <div class="link-icones" style="margin-top: 30px;">
                <button type="submit"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <a href="manutencoes.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>
        </form>

    </section>

    <?php } ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>