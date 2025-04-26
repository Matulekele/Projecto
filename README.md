<?php

require_once "../includes/conexao.php";

$nome = 'Administrador';
$email = 'admin@email.com';
$senha = password_hash('1234', PASSWORD_DEFAULT);
$foto = '';
$nivel_acesso = 'Admin';

$sql = "INSERT INTO usuarios (nome, email, senha, foto, nivel_acesso)
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$nome, $email, $senha, $foto, $nivel_acesso]);

?>



<div onclick="toggleDropdown()" style="cursor: pointer;" class="avatar">
    <img src="../img/<?php echo htmlspecialchars($foto_usuario ?? 'default-avatar.png'); ?>" 
        alt="Perfil" 
        style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; transition: transform 0.3s;"
        onmouseover="this.style.transform='scale(1.1)'" 
        onmouseout="this.style.transform='scale(1)'">
</div>
