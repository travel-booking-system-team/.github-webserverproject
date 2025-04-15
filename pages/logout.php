<?php
// logout.php
session_start();
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão
?>

<link rel="stylesheet" href="../css/main.css">
<?php include '../includes/header-member.php'; ?>
<div class="login-container_logout">
    <h2>Bye!</h2>
</div>
<?php include '../includes/footer.php'; ?>
