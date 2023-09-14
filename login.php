<?php
session_start();
print_r($_SESSION);
if (isset($_POST['username']) && isset($_POST['password'])) {
    header('Location: index.php');
    $_SESSION['usuario'] = $_POST['username'];
} else {
            echo " Introduce user  ";
        }
    


?>
<!DOCTYPE html>
<html>

<head>

</head>

<body>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>



</body>

</html>