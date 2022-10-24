<?php include_once __DIR__ . '/header-dashboard.php'?>

<div class="contenedor-sm">
    <?php include_once __DIR__ . '/../templates/alertas.php'; ?>
    
    <form method="POST" class="formulario" action="/perfil">
        <div class="campo">
            <label for="nombre">Nombre</label>
            <input type="text" value="<?php echo $usuario->nombre ?>" name="nombre" placeholder="Tu nombre">
        </div>
        <div class="campo">
            <label for="email">Email</label>
            <input type="email" value="<?php echo $usuario->email ?>" name="email" placeholder="Tu Email">
        </div>
        <div class="campo">
            <label for="passwordNuevo">Contraseña nueva</label>
            <input type="password" name="passwordNuevo" placeholder="Tu contraseña nueva">
        </div>

        <div class="campo">
            <label for="passwordActual">Contraseña actual</label>
            <input id="passwordActual" type="password"  name="passwordActual" placeholder="Tu contraseña actual">
        </div>

        <input id="perfilBtn" disabled type="submit" value="Guardar Cambios">
    </form> 
</div>

<?php include_once __DIR__ . '/footer-dashboard.php'?>
