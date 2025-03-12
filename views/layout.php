<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <div class="contenedor-app">
        <div class="imagen"></div>
            <div class="app">
                    <?php echo $contenido; ?>

                <div class="rs">
                    <p>Siguenos en nuestras redes!</p>

                    <div class="iconos-rs">
                    <a class="icono" href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a class="icono" href="https://www.twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a class="icono" href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a class="icono" href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <?php 
        echo $script ?? '';
    ?>
</body>


</html>