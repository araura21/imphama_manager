<?php
session_start();
require_once __DIR__ . '/../vista/includes/database.php';

// Si ya está logueado, redirigir al index
if (isset($_SESSION['usuario_id'])) {
    header('Location: ../vista/index.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($usuario) && !empty($password)) {
        try {
            $db = getDB();
            $sql = "SELECT id, usuario, nombre, email, rol, activo FROM usuarios 
                    WHERE usuario = :usuario AND password = MD5(:password) AND activo = 1";
            $result = $db->fetch($sql, [
                'usuario' => $usuario,
                'password' => $password
            ]);
            if ($result) {
                $_SESSION['usuario_id'] = $result['id'];
                $_SESSION['usuario_nombre'] = $result['nombre'];
                $_SESSION['usuario_rol'] = $result['rol'];
                $_SESSION['usuario_email'] = $result['email'];
                header('Location: ../vista/index.php');
                exit();
            } else {
                $_SESSION['login_error'] = 'Usuario o contraseña incorrectos';
                header('Location: ../vista/login.php');
                exit();
            }
        } catch (Exception $e) {
            $_SESSION['login_error'] = 'Error de conexión. Intente nuevamente.';
            header('Location: ../vista/login.php');
            exit();
        }
    } else {
        $_SESSION['login_error'] = 'Complete todos los campos';
        header('Location: ../vista/login.php');
        exit();
    }
}
?>
