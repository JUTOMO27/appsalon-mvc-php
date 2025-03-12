<div class="pagina-login">
    <div class="centrar-login">
        <h1 class="nombre-pagina">Login</h1>
        <p class="descripcion-pagina">Inicia sesión con tus datos</p>

        <?php 
            include_once __DIR__ . '/../templates/alertas.php';
        ?>


        <form class="formulario" method="POST" action="/">
            <div class="campo">
                <!-- <label for="email">Email</label> -->
                <input 
                    type="email"
                    id="email"
                    placeholder="E-mail"
                    name="email"
                />
            </div>

            <div class="campo">
                <!-- <label for="password">Contraseña</label> -->
                <input 
                    type="password"
                    id="password"
                    placeholder="Contraseña"
                    name="password"
                />
            </div>

            <input type="submit" class="boton" value="Iniciar Sesión">


        </form>

        <div class="acciones">
            <a href="/crear-cuenta">¿No tienes cuenta? Crea una aquí</a>
            <a href="/olvide">¿Has olvidado tu contraseña?</a>
        </div>

    </div>
</div>