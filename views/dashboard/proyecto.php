<?php include_once __DIR__ . '/header-dashboard.php'?>

    <div class="contenedor-sm">
        <div class="contenedor-nueva-tarea">
            <button type="button" class="agregar-tarea" id="agregar-tarea">&#43; Nueva tarea</button>
        </div>

        <div class="filtros" id="filtros">
            <div class="filtros-inputs">

                <label class="campo" for="todas" id="todas-label">
                    <input type="radio" class="rad-input" name="filtro" id="todas" checked value="">
                    <div class="rad-design"></div>
                    <div class="rad-text">Todas</div>
                </label>

                <label class="campo" for="completadas" id="completadas-label">
                    <input type="radio" class="rad-input" name="filtro" id="completadas" value="1">
                    <div class="rad-design"></div>
                    <div class="rad-text">Completadas</div>
                </label>

                <label class="campo" for="pendientes" id="pendientes-label">
                    <input type="radio" class="rad-input" name="filtro" id="pendientes" value="0">
                    <div class="rad-design"></div>
                    <div class="rad-text">Pendientes</div>
                </label>

            </div>
        </div>

        <div class="alertas"></div>
        <ul id="listado-tareas" class="listado-tareas"></ul>
    </div>

<?php include_once __DIR__ . '/footer-dashboard.php'?> <!-- First part of script (app.js) -->

<?php

    $script .= '
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/build/js/tareas.js"></script>
    ';

?>
