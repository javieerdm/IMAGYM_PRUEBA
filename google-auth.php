<?php
require 'google-api-php-client--PHP8.2/vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('24936604300-7nbsa047akchfp437hd3s8gg1mgl4521.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/IMAGYM');
$client->addScope("email");
$client->addScope("profile");
session_start();

// Manejar la respuesta de Google
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    $google_oauth = new Google_Service_Oauth2($client);
    $user_info = $google_oauth->userinfo->get();
    
    // Conectar a la base de datos
    include('conexion.php');

    // Verificar si el usuario existe
    $email = $user_info->email;
    $nombre = $user_info->name;
    $consulta = "SELECT * FROM Usuarios WHERE EMAIL='$email'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) > 0) {
        // Usuario existe, actualizar contraseña
        $nuevaContraseña = password_hash('nueva_contraseña_aleatoria', PASSWORD_DEFAULT);
        $update = "UPDATE Usuarios SET CONTRASEÑA='$nuevaContraseña' WHERE EMAIL='$email'";
        mysqli_query($conexion, $update);

        // Aquí, podrías llamar a insertarcliente.php o manejar la sesión directamente
    } else {
        // Usuario no existe, crear nuevo usuario
        $contraseñaHash = password_hash('contraseña_aleatoria', PASSWORD_DEFAULT);
        $insertar = "INSERT INTO Usuarios (NOMBRE, EMAIL, CONTRASEÑA, Rol) VALUES ('$nombre', '$email', '$contraseñaHash', 'cliente')";
        mysqli_query($conexion, $insertar);
    }

    // Establecer variables de sesión y redirigir
    $_SESSION["cliente"] = $nombre;
    // Otros datos de sesión según sea necesario
    header("Location: index.php");
    exit;
} else {
    // Si no hay código, iniciar el flujo de autenticación
    $login_url = $client->createAuthUrl();
    header("Location: " . $login_url);
    exit();
}
