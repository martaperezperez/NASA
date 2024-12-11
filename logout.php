<?php
session_start(); //Inicia la sesion
session_unset(); // Elimina todas las variables de sesion
session_destroy(); //Destruye la sesion actual

header('Location: login.php'); //Redirige alñ usuario al login
exit;
?>