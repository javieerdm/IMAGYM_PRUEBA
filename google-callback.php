<?php
require_once 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('24936604300-7nbsa047akchfp437hd3s8gg1mgl4521.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/IMAGYM/google-callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token);

    // Obtener datos del perfil del usuario
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email = $google_account_info->email;
    $name = $google_account_info->name;
    // Puedes generar una contraseña aleatoria o dejarla en blanco si prefieres
    $password = password_hash("seguridad", PASSWORD_DEFAULT);
    $rol = 'cliente';
}
include 'conexion.php'; 

$consulta = "SELECT ID FROM usuarios WHERE email = '$email'";
$resultado = mysqli_query($conexion, $consulta);

if(mysqli_num_rows($resultado) == 0) {
    $consulta = "INSERT INTO usuarios (Nombre, Email, Contraseña, Rol) VALUES ('$name', '$email', '$password', '$rol')";
    mysqli_query($conexion, $consulta);
} else {
    mysqli_query($conexion, $consulta);
}

$fila=mysqli_fetch_row($resultado);
$nom=$fila[1];
$ID=$fila[0];
$rol=$fila[4];


session_start();
$_SESSION["cliente"]=$nom;
$_SESSION["codusuario"]=$ID;
$_SESSION["rol"]=$rol;
header("location:registrado.php");


?>