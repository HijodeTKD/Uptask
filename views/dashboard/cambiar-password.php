<?php include_once __DIR__ . '/header-dashboard.php'?>

<div class="contenedor-sm">
    <div class="cambiar-contraseña">
        <a href="/perfil">Volver a perfil</a>
    </div>
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>


    <form method="POST" class="formulario" action="/cambiar-contraseña">
        <div class="campo">
            <label for="passwordActual">Contraseña actual</label>
            <input type="password"  name="passwordActual" placeholder="Tu contraseña actual">
        </div>
        <div class="campo">
            <label for="passwordNuevo">Contraseña nueva</label>
            <input type="password" name="passwordNuevo" placeholder="Tu contraseña nueva">
        </div>

        <input type="submit" value="Guardar Cambios">
    </form> 
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'?>
