<?php

// Función para cerrar la sesión
function cerrarSesion() {
    // Borrar la cookie de inicio de sesión al cerrar sesión
    setcookie('UserName_init', '', time() - 3600, '/');
    
    // Iniciar sesión (si aún no está iniciada)
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Destruir la sesión
    session_destroy();
    
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: login.php");
    exit;
}

cerrarSesion();
?>