<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Acceso al sistema</h2>
    </div>
    <div class="panel-body">
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
            <?php elseif ($success): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="<?php echo base_url() . "panel/doRecover"; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <p>Para recuperar su contraseña ingrese su dirección de e-mail y le enviaremos las instrucciones para
                    reestablecerla.</p>
                <label for="email">E-mail:</label>
                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input <?php if($success) echo 'disabled="disabled"';?> class="form-control" type="text" name="email"/>
                </div>
            </div>
            <div class="form-actions">
                <input class="btn btn-primary" type="submit" value="Recuperar contraseña"/>
            </div>
        </form>

    </div>
</div>