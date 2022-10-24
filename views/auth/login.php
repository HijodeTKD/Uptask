
<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/darkmode.php'; ?>
    <?php include_once __DIR__ . '/../templates/header.php';     ?>
    
    <div class="contenedor-sm">
        <p class="descripcion-pagina">Iniciar sesión</p>

        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form class="formulario" action="/" method="POST">
            
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email" value="<?php echo $usuario->email ?? '' ?>">
            </div>
            
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu contraseña" name="password">
            </div>
            
            <input type="submit" value="Iniciar sesión">

        </form>

        <div class="acciones">
            <a href="/crear">¿No tienes una cuenta? Crea una</a>
            <a href="/olvide">No recuerdo mi contraseña</a>
        </div>

    </div> <!-- contenedor-sm -->
</div>