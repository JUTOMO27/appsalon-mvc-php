<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Rellena el formulario para crear tu cuenta</p>

<?php 
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form class="formulario" action="/crear-cuenta" method="POST">
    <div class="campo">
        <label for="nombre"></label>
        <input 
        type="text" 
        name="nombre" 
        id="nombre" 
        placeholder="Nombre"
        value="<?php echo s($usuario->nombre);?>"
        />
    </div>

    <div class="campo">
        <label for="apellido"></label>
        <input 
        type="text" 
        name="apellido" 
        id="apellido" 
        placeholder="Apellido"
        value="<?php echo s($usuario->apellido);?>"
        />
    </div>  

    <div class="campo">
        <label for="telefono"></label>
        <input 
        type="tel" 
        name="telefono" 
        id="telefono" 
        placeholder="Teléfono"
        value="<?php echo s($usuario->telefono);?>"
        />
    </div>

    <div class="campo">
        <label for="email"></label>
        <input
        type="email" 
        name="email" 
        id="email" 
        placeholder="E-mail"
        value="<?php echo s($usuario->email);?>"
        />
    </div>

    <div class="campo">
        <label for="password"></label>
        <input 
        type="password" 
        name="password" 
        id="password" 
        placeholder="Contraseña"
        />
    </div>

    <input type="submit" value="Crear Cuenta" class="boton">

    <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
            <a href="/olvide">¿Has olvidado tu contraseña?</a>
    </div>

</form>