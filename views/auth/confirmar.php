<main class="auth">
    <h2 class="auth__heading"><?php echo $titulo; ?></h2>

    <p class="auth__texto">Tu cuenta Devwebcamp</p>

    <?php
        require_once __DIR__ . '/../templates/alertas.php';
    ?>

    <?php if(isset($alertas['exito'])) { ?>
        <div class="acciones">
            <a href="/login" class="formulario__submit--center">Iniciar Sesión</a>
        </div>
    <?php } ?>
</main>