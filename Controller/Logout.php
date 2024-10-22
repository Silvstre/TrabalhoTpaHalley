<?php
session_start(); // Iniciar sessão
session_destroy(); // Destruir a sessão atual
header("Location: login.html"); // Redirecionar para a página de login
exit();
?>
