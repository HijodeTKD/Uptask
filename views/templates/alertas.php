<div class="alertas">
    <?php 
        //Access inside the associative array(Associative array, remember two types of alert: error and success)
        foreach($alertas as $key => $alerta):
            //Access the value of each of the errors and/or success
            foreach($alerta as $mensaje):
    ?>
        <div class="alerta-contenedor">
            <div class="alerta <?php echo $key ?>"><?php echo $mensaje; ?></div>
        </div>
    <?php
            endforeach;
        endforeach;
    ?>
</div>