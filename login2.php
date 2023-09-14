<?php
session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
   unset($_SESSION['tiempoInicio']);
} else {
    echo "Introduce tus credenciales...";
}

$_SESSION['tiempoInicio'] = time() + 10;
?>
<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <form action="<?php echo $_SERVER['HTTP_REFERER']; ?>" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>

</body>

</html>
