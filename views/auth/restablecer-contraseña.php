<h1 class="nombre-pagina">Restablecer contraseña</h1>
<p class="descripcion-pagina">Crea una nueva contraseña para cuenta.</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>


<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <input 
            type="password"
            id="password"
            placeholder="Nueva contraseña"
            name="password"
        />
    </div>

    <input type="submit" class="boton" value="Restablecer Contraseña">
</form>

<div class="acciones">
    <a href="/">¿Has recordado tu contraseña en el último momento? No pasa nada, inicia sesión</a>
</div>