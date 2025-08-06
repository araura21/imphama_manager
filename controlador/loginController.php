<?php
session_start();
require_once '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    $stmt = $pdo->prepare("SELECT * FROM Usuario WHERE usu_email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($contrasena, $usuario['usu_contrasena'])) {
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['usuario_nombre'] = $usuario['usu_nombre'];
        $_SESSION['rol_id'] = $usuario['rol_id'];

        header("Location: ../views/dashboard.php");
        exit;
    } else {
        $error = "Correo o contraseña incorrectos.";
        header("Location: ../login.php?error=1");
    }
}
?>
