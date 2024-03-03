<!doctype html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contacta con nosotros y resuelve tus dudas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/principal.css">
    <link rel="stylesheet" href="css/contacto.css">
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>
    <div id="body">

        <?php include('cabecera.php'); ?>

        <section>
            <div id="section" class="container">
                <div id="contactos" class="col-md-6">
                    <form id="formu" action="insertarcontacto.php" method="POST">
                        <fieldset>
                            <legend class="cont">CONTACTAR</legend>
                            <br>
                            <label class="cont">Nombre*</label>
                            <br>
                            <input class="cont form-control" type="text" name="nombre" required>
                            <br><br>
                            <label class="cont">Correo electrónico*</label>
                            <br>
                            <input class="cont form-control" type="email" name="correo" required>
                            <br><br>
                            <label class="cont">Mensaje*</label>
                            <br>
                            <textarea class="cont form-control" rows="8" name="mensaje" required></textarea>
                            <div class="g-recaptcha" data-sitekey="6Ldhwl0pAAAAAPsnRk7POYESKg8MR1TWbLim1Ycg"
                                data-callback="habilitarBoton"></div>

                            <script>
                                function habilitarBoton() {
                                    document.getElementById('enviarBtn').disabled = false;
                                }
                            </script>
                            <button class='boton btn btn-primary' type='submit' id='enviarBtn' disabled>Enviar</button>
                        </fieldset>
                    </form>
                </div>
                <div id="localizacion" class="col-md-6">
                    <p class="direccion">GRUPO IMAGYM<br>C/ Doctor Beltrán Mateos N 10, 4ºA <br> 02002 Albacete<br>
                        Teléfono de contacto: 969 12 34 78</p>
                    <br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d1096.492342994844!2d-1.8517710224634156!3d38.9845377307178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMzjCsDU5JzA0LjIiTiAxwrA1MScwNS41Ilc!5e0!3m2!1ses!2ses!4v1698752162095!5m2!1ses!2ses"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </section>

        <?php include('pie.php'); ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
