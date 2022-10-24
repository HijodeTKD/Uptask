<?php

include_once __DIR__ . '/header-dashboard.php'?>

    <?php if(count($proyectos) === 0){ ?>
        <div class="no-proyectos">
            <p>No has creado ningún proyecto</p>
            <a class="boton" href="/crear-proyecto">Crea tu primer proyecto aqui</a>
        </div>
    <?php }else{ ?>
            

        <ul class="listado-proyectos">
            <?php foreach($proyectos as $proyecto){?>

                <li class="proyecto">
                    <a href="proyecto?url=<?php echo $proyecto->url; ?>"><?php echo $proyecto->proyecto; ?></a>
                </li>

            <?php }; ?> <!--Endforeach-->
        </ul>
    <?php }; ?><!--Endelse-->


<?php include_once __DIR__ . '/footer-dashboard.php'?>
