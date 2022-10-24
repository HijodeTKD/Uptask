<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/darkmode.php'; ?>
    <?php include_once __DIR__ . '/../templates/header.php'; ?>

    <div class="contenedor-sm">
        <p class="descripcion-pagina">Reestablece tu contraseña escribiendo tu Email a continuación</p>
        <?php include_once __DIR__ . '/../templates/alertas.php';?>

        <form action="/olvide" method="POST" class="formulario" >
            
            <div class="campo">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="Tu email" name="email">
            </div>
            
            <input type="submit" value="Enviar instrucciones a mi email">

        </form>

        <div class="acciones">
            <a href="/">¿Ya tienes una cuenta? Inicia sesión</a>
            <a href="/crear">¿No tienes una cuenta? Crea una</a>
        </div>
    </div> <!-- contenedor-sm -->
</div>