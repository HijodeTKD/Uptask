<div class="contenedor confirmar">
    <?php include_once __DIR__ . '/../templates/darkmode.php'; ?>
    <?php include_once __DIR__ . '/../templates/header.php'; ?>
    
    <div class="contenedor-sm">
        <?php include_once __DIR__ . '/../templates/alertas.php';
        if($confirmado):
        ?>
        
        <div class="acciones">
            <a href="/">¡Es hora de iniciar sesion!</a>
        </div>

        <?php endif; ?>
    </div> <!-- contenedor-sm -->
</div>