<?php
    // Iniciar o reanudar la sesión
    session_start();

    // Verificar el estado de la sesión
    $status = session_status();

    switch ($status) {
        case PHP_SESSION_DISABLED:
            echo 'Las cookies de sesión están deshabilitadas en la configuración del servidor.';
            break;
        case PHP_SESSION_NONE:
            echo 'Las cookies de sesión están habilitadas, pero no se ha iniciado ninguna sesión.';
            break;
        case PHP_SESSION_ACTIVE:
            echo 'Las cookies de sesión están habilitadas y hay una sesión activa.';
            break;
    }
?>