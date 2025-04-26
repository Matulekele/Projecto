<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    // Pega todas as notificações da última semana
    $sql = "SELECT * FROM notificacoes 
            WHERE data >= NOW() - INTERVAL 7 DAY 
            ORDER BY data DESC";
    $result = mysqli_query($conn, $sql);

    // Marca como visualizadas
    $conn->query("UPDATE notificacoes SET visualizada = 1 WHERE visualizada = 0");
    
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Notificações</title>
    <link rel="stylesheet" href="../style/notificacoes.css">
</head>
<body>

    <h2>Notificações Recentes</h2>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="notificacao">
            <p><?= $row['mensagem'] ?></p>
            <small><?= date('d/m/Y H:i', strtotime($row['data'])) ?></small>

            <!-- Botão de apagar manual -->
            <form action="../api/excluir_notificacao.php" method="post" style="display:inline;">
                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                <button type="submit" title="Apagar esta notificação" onclick="return confirm('Deseja apagar esta notificação?')">🗑️</button>
            </form>
        </div>
    <?php endwhile; ?>


    <form method="post" action="../api/limpar_notificacoes.php">
        <button type="submit" onclick="return confirm('Tem certeza que deseja limpar todas as notificações antigas?')">🗑️ Limpar notificações antigas</button>
    </form>

    <div>
        <a href="dashboard.php">Retroceder</a>
    </div>

</body>
</html>