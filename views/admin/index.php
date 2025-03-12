<?php 
    include_once __DIR__ . '/../templates/barra.php'
?>

<h1 class="nombre-pagina">Panel de Aministración</h1>

<h2>Buscar Citas</h2>

<div class="busqueda">
    <form class="formulario">
        <p>Fecha</p>
        <div class="campo">
            <input 
            type="date" 
            id="fecha" 
            name="fecha"
            value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>

<?php
    if(count($citas) === 0){
        echo "<h2>No tienes citas para el dia seleccionado</h2>";
    }
?>

<div id="citas-admin">
    <ul class="citas">
        <?php   
            $idCita = 0;
            foreach ($citas as $key => $cita){
                if($idCita !== $cita->id){
                $total = 0;
        ?>        
        <li>
            <div class="cita-cliente">
            <h3>Cliente</h3>
            <p>ID: <span> <?php echo $cita->id; ?></span></p>
            <p>Cliente: <span> <?php echo $cita->cliente; ?></span></p>
            <p>Hora: <span> <?php echo $cita->hora; ?></span></p>
            <p>Email: <span> <?php echo $cita->email; ?></span></p>
            <p>Telefono: <span> <?php echo $cita->telefono; ?></span></p>
            </div>

            <div class="cita-servicio">
                <h3>Servicios</h3>
                <?php 
                    $idCita = $cita->id;
                } //Fin de if 
                $total += $cita->precio; ?>

                <p class="servicio"> <?php echo $cita->servicio . " " . $cita->precio . "€"; ?></p>   

                <?php 
                    $actual = $cita->id;
                    $proximo = $citas[$key + 1]->id ?? 0;

                    if(esUltimo($actual, $proximo)){ ?>
                       <p class="total">  Total: <span> <?php echo $total . "€";?></span></p> 
                        
                       <form action="/api/eliminar" method="POST">
                            <input type="hidden" name="id" value="<?php echo $cita->id; ?>">
                            <input type="submit"  value="Eliminar" class="boton-eliminar">
                       </form>
                    </div> <!-- Cerrar el div servicios-admin -->
                    <?php } ?>
        <?php } //Fin de for each ?>
        </li> <!-- Cerrar el último <li> -->
    </ul>
</div>

<?php
    $script = "<script src='build/js/buscador.js'></script>";
?>