<aside class="sidebar">

    <div>
        <div class="contenedor-sidebar">
            <h2>UpTask</h2>
    
            <div class="cerrar-menu">
                <img id="cerrar-menu" src="build/img/cross.svg" alt="imagen cerrar">
            </div>
        </div>
    
        <nav class="sidebar-nav">
            <a class="<?php echo($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Mis proyectos</a>
            <a class="<?php echo($titulo === 'Crear Proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyecto</a>
            <a class="<?php echo($titulo === 'Perfil') ? 'activo' : ''; ?>" href="/perfil">Perfil</a>
        </nav>
    </div>

    <div class="cerrar-sesion-mobile">
        <a href="/logout" class="cerrar-sesion">Cerrar Sesión</a>
    </div>
</aside>