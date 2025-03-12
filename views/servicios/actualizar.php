<!-- <?php
    // include_once __DIR__ . '/../templates/barra.php';
?> -->

<a href="/servicios" class="boton-volver">Volver</a>
<h1 class="nombre-pagina">Actualizar un Servicio</h1>
<p class="descripcion-pagina">Edita los campos para actualizar tu servicio.</p>


<form method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/../templates/alertas.php';
        include_once __DIR__ . '/formulario.php';
    ?>
    <input type="submit" class="boton" value="Actualizar">
</form>
