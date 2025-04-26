<?php

    require_once "../includes/conexao.php";
    require_once "../includes/auth.php";

    if ($_SESSION['nivel_acesso'] === 'Admin') {

        $id = $_POST['id'];

        $queryInfo = $conn->prepare("SELECT id_patrimonio FROM manutencao WHERE id_manutencao = ?");
        $queryInfo->bind_param("i", $id);
        $queryInfo->execute();
        $result = $queryInfo->get_result();

        if ($result->num_rows > 0) {
            $dados = $result->fetch_assoc();
            $idPatrimonio = $dados['id_patrimonio'];

            // Exclusão segura
            $stmt = $conn->prepare("DELETE FROM manutencao WHERE id_manutencao = ?");
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {

                $usuario = $_SESSION['name'];
                $mensagemNotif = "A manutenção do patrimônio <strong>ID $idPatrimonio</strong> foi excluída por <strong>$usuario</strong>.";
                $tipoNotif = "cadastro";

                $notifStmt = $conn->prepare("INSERT INTO notificacoes (mensagem, tipo) VALUES (?, ?)");
                $notifStmt->bind_param("ss", $mensagemNotif, $tipoNotif);
                $notifStmt->execute();
                $notifStmt->close();

                header("Location: ../pages/manutencoes.php");
                exit();

            } else {
                mensagem(" 
                    <div class='error-message'>
                        <div class='message'>
                            Não foi possível excluir a manutenção!
                        </div>
                        <p><a href='../pages/manutencoes.php'>Voltar</a></p>
                    </div>", 'danger');
            }

            $stmt->close();

        } else {
            mensagem("
                <div class='error-message'>
                    <div class='message'>
                        Manutenção não encontrada!
                    </div>
                    <p><a href='../pages/manutencoes.php'>Voltar</a></p>
                </div>", 'danger');
        }

        $queryInfo->close();

    } else {
        echo "<div class='error-message'>
                <div class='message'>
                    Você não tem acesso a essa opção, é exclusivo para Administradores
                </div>
                <p><a href='../pages/manutencoes.php'>Retroceder</a></p>
            </div>"
        ;
    }

?>
