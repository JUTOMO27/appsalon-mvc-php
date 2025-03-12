
<h1 class="nombre-pagina">Restablecer tu contraseña</h1>
<p class="descripcion-pagina">Introduce tu correo electronico y recibirás un enlace para crear una nueva contraseña.</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" method="POST" action="/olvide">
    <div class="campo">
        <!-- <label for="email">Email</label> -->
        <input 
            type="email"
            id="email"
            placeholder="Email"
            name="email"
        />
    </div>

    <input type="submit" class="boton" value="Restablecer Contraseña">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
    <a href="/crear-cuenta">¿No tienes cuenta? Crea una aquí</a>
</div>
