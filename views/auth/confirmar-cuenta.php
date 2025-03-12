
<h1 class="nombre-pagina">Confirmar Cuenta</h1>

<?php 
include_once __DIR__ . '/../templates/alertas.php';
?>

<?php if (isset($alertas['exito'])): ?>
    <div class="confirmar-cuenta">
        <p>Hemos confirmado tu cuenta, ya puedes iniciar sesión para empezar.</p>
        <a class="boton" href="/">Inicia sesión</a>
    </div>
<?php endif; ?>
