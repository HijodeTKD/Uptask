<div class="contenedor crear">
    <?php include_once __DIR__ . '/../templates/darkmode.php';?>
    <?php include_once __DIR__ . '/../templates/header.php';?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Crea tu cuenta en Uptask</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>
        <form class="formulario" action="/crear" method="POST">
            
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" placeholder="Tu nombre" name="nombre" value="<?php echo $usuario->nombre ?>">
            </div>
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email" value="<?php echo $usuario->email ?>">
            </div>
            
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu contraseña" name="password">
            </div>

            <div class="campo">
                <label for="password2">Confirmar Contraseña</label>
                <input type="password" id="password2" placeholder="Repite tu contraseña" name="password2">
            </div>
            
            <input type="submit" value="Crear cuenta">

        </form>
        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
            <a href="/olvide">No recuerdo mi contraseña</a>
        </div>
    </div> <!-- contenedor-sm -->
</div>
