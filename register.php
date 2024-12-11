<?php
include 'db.php'; // Conecta con la base de datos

if($_SERVE['REQUEST_METHOD']=== 'POST'){ //Verifica si el formulario fue enviado
    $username = $_POST['username']; //Recibe el nombre del usuario
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Encripta la contraseña

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?,?)"); //Se usa una consulta preparada para evitar ataques SQL Injection

    try{
        $stmt->execute([$username, $password]); // Inserta el usuario en la base de datos
        echo "Usuario registrado con exito. <a href='login.php'>Inciar sesión</a>";
    }catch(PDOException $e){
        echo "Eror al registrar: " . $e->getMessage(); // Muestra errores si el nombre de usuario ya no existe
    }
}

?>
<!-- El formulario permite al usuario introducir su username y su password --> 
<form method="POST">
    <input type="text" name="username" placeholder="Usyuario" required>
    <input type="password" name="password" placeholder="contraseña" require>
    <butoon type="submit">Registrarse</button>
</form>