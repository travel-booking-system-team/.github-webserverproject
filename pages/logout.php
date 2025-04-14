<?php
// logout.php
session_start();
session_unset(); // Limpa todas as variáveis de sessão
session_destroy(); // Destroi a sessão

// Redireciona o usuário para a página inicial
header('Location: index.php');
exit;
?>
