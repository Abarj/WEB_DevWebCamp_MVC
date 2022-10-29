<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>

    <p class="pagina__descripcion">Tu entrada - Te recomendamos descargarla, ¡compártela en redes sociales!</p>

    <div class="entrada-virtual">
        <div class="entrada entrada--<?php echo strtolower($registro->paquete->nombre); ?> entrada--acceso">
            <div class="entrada__contenido">
                <h4 class="entrada__logo">
                    &#60;DevWebCamp />
                </h4>

                <p class="entrada__plan"><?php echo $registro->paquete->nombre; ?></p>
                <p class="entrada__nombre"><?php echo $registro->usuario->nombre . " " . $registro->usuario->apellido; ?></p>
            </div>

            <p class="entrada__codigo"><?php echo '#' . $registro->token; ?></p>
        </div>
    </div>
</main>