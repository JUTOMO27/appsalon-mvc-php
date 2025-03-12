<link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/dark.css">
<?php 
    include_once __DIR__ . '/../templates/barra.php'
?>
<h1 class="nombre-pagina">Crear nueva cita</h1>
<!-- <p class="descripcion-pagina">Elige los servicios que quieres reservar e introduce tus datos.</p> -->

<div id=app>
    <nav class="tabs">
        <button class="actual" type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Datos y Cita</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav>

    <div id=paso-1 class="seccion">
        <h2>Servicios</h2>
        <p class="text-center">Escoge los servicios que quieres reservar</p>
        <div id="servicios" class="listado-servicios"></div>
    </div>

    <div id=paso-2 class="seccion">
        <h2>Tus datos y cita</h2>
        <p class="text-center">Introduce tus datos y la fecha de tu cita</p>

        <form class="formulario">
            <div class="campo">
                <input 
                type="text"
                id="nombre"
                placeholder="Nombre"
                value="<?php echo $nombre ?>"
                disabled
                >
            </div>

            <label for="fecha">Fecha <p class="texto-pequeño">Domingos y Lunes cerrado</p></label>
            <div class="campo">
                <input 
                type="date"
                id="fecha"
                value="<?php echo date('d-m-Y') ?>"
                min="<?php echo date('d-m-Y', strtotime('+1 day')) ?>"
                >
            </div>

            <label for="hora">Hora<p class="texto-pequeño">Horario de: 10:00 a 18::00</p></label>
            <div class="campo">
                <input 
                type="time"
                id="hora"
                >
            </div>
            <input type="hidden" id="id" value="<?php echo $id; ?>">
        </form> 
    </div>

    <div id=paso-3 class="seccion resumen">
        <h2>Resumen</h2>
        <p class="text-center">Verifica que todo es correcto para reservar</p>
    </div>

    <div class="paginacion">
        <button
            id="anterior"
            class="boton"
        >&laquo;Atrás</button>
        <button
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
</div>

<?php 
    $script = "
        <script src='https://npmcdn.com/flatpickr/dist/flatpickr.min.js'></script>
        <script src='https://npmcdn.com/flatpickr/dist/l10n/es.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>

