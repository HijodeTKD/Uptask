<div class="contenedor reestablecer">
    <?php include_once __DIR__ . '/../templates/header.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reestablece tu contraseña</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <?php if($mostrar): ?>

            <form class="formulario" method="POST"> <!-- No action, cause we lost GET token reference in url -->
                
                <div class="campo">
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" placeholder="Tu contraseña" name="password">
                </div>
    
                <div class="campo">
                    <label for="password2">Confirma tu contraseña</label>
                    <input type="password" id="password2" placeholder="Repite tu contraseña" name="password2">
                </div>
                
                <input type="submit" value="Establecer nueva contraseña">
    
            </form>
        
        <?php endif;

        if($passChanged): ?>
        
        <div class="acciones single">
            <a href="/">¡Prueba a iniciar session con tu nueva contraseña!</a>
        </div>

        <?php endif; ?>
    </div> <!-- contenedor-sm -->
</div>