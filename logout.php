<?php
// Eliminar todas las cookies relacionadas con la sesión
$cookies = session_get_cookie_params();
foreach ($_COOKIE as $key => $value) {
    setcookie($key, '', time() - 3600, $cookies['path'], $cookies['domain'], $cookies['secure'], $cookies['httponly']);
}
session_start();
session_destroy();
header("Location: login.php");
exit();
?>