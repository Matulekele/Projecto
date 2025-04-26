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
    <title>Registro de Movimentações</title>
</head>
<body>



    <section class="section">
        <form action="../api/movimentacao_script.php" method="POST" class="form">

            <h1>Registrar Movimentação</h1>


            <label for="">
                Patrimonio:
                <select name="id_patrimonio" class="input" required>
                    <option disabled selected>Selecione o Patrimonio</option>
                    <?php while ($patrimonio = mysqli_fetch_assoc($resultadoPatrimonio)) {
                        echo "<option value='" . $patrimonio['id_patrimonio'] . "'>" . $patrimonio['nome'] . "</option>";
                    } ?>
                </select>
            </label>
            
            <label for="">
                Estado do patrimonio:
                <select name="estado" id="" class="input"  required>
                    <option disabled selected>Estado do equipamento</option>
                    <option value="Bom">Bom</option>
                    <option value="Mal">Mal</option>
                </select>
            </label>
                
            
            <div class="separador">

                <select name="id_localantigo" class="input" required>
                    <option disabled selected>Localização Anterior</option>
                    <?php while ($localizacao = mysqli_fetch_assoc($resultadoLocalizacao)) {
                        echo "<option value='" . $localizacao['id_localizacao'] . "'>" . $localizacao['nome'] . "</option>";
                    } ?>
                </select>

                <select name="id_localnovo" class="input" required>
                    <option disabled selected>Nova Localização</option>
                    <?php mysqli_data_seek($resultadoLocalizacao, 0); while ($localizacao = mysqli_fetch_assoc($resultadoLocalizacao)) {
                        echo "<option value='" . $localizacao['id_localizacao'] . "'>" . $localizacao['nome'] . "</option>";
                    } ?>
                </select>

                <select name="id_responsavel" class="input" required>
                    <option disabled selected>Responsável</option>
                    <?php while ($responsavel = mysqli_fetch_assoc($resultadoResponsaveis)) {
                        echo "<option value='" . $responsavel['id_responsavel'] . "'>" . $responsavel['responsavel'] . "</option>";
                    } ?>
                </select>

            </div>

            <label for="datamovimentacao">
                Data da Movimentação:
                <input type="date" class="input" name="datamovimentacao" required>
            </label>

            <label for="motivo">
                Motivo da Movimentação:
                <textarea class="input" name="motivo" placeholder="Motivo da Movimentação" required></textarea>
            </label>
       
            <div class="link-icones" style="margin-top: 30px;">
                <button type="submit"><i class="fi fi-sr-floppy-disks icones"></i></button>
                <a href="movimentacoes.php"><i class="fi fi-sr-overview icones"></i></a>
            </div>

        </form>
    </section>

    <?php }
        else { 
            echo "<div class='error-message'>
                    <div class='message'>Acesso negado. Apenas administradores podem acessar esta página.</div>
                    <p><a href='home.php'>Retroceder</a></p>
                    </div>"
                ; 
        } 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
