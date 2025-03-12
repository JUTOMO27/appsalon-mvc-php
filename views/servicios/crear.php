<!-- <?php
    // include_once __DIR__ . '/../templates/barra.php';
?> -->
<a href="/servicios" class="boton-volver">Volver</a>
<h1 class="nombre-pagina">Crear un Nuevo Servicio</h1>
<p class="descripcion-pagina">Rellena los campos para añadir un nuevo servicio para tus clientes.</p>


<form action="/servicios/crear" method="POST" class="formulario">
    <?php
        include_once __DIR__ . '/../templates/alertas.php';
        include_once __DIR__ . '/formulario.php';
    ?>
    <input type="submit" class="boton" value="Guardar">
</form>
