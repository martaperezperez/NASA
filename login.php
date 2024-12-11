<?php
include 'db.php'; // Conecta con la base de datos
session_start(); // Inicia la sesion

if($_SERVER['REQUEST_METHOD'] === 'POST'){ // Verifica si el formulario fue enviado
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * EROM users WHERE username = ?");
    $stmt->execute([$username]); //Busca al usuario en la base de datos
    $user = $stmt->fetch(PDO::FETCH_ASSOC); // Obtiene los datos del usuario.

    if($user && password_verify($password,$user['password'])){ //verifica la contraseña
        $_SESSION['user']= $user['id']; // Guarda el ID del usuario en la sesion
        $_SESSION['token']= $user['token']; //Guarda el token de la API en la sesion
        header ('Location: index.php'); //Redirige a la pagina principal
    }else{
        echo "Usuario o contraseña incorrectos";
    }

}
?>

<form method="POST">
    <input type="text" name="username" placeholder="Usuario" required>
    <input type="password" name"password" placeholder="contraseña" required>
    <butoon type="submit">Iniciar sesion</button>
</form>