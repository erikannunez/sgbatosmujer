<div class="panel panel-primary">
    <div class="panel-heading">
        <h2 class="panel-title">Acceso al sistema</h2>
    </div>
    <div class="panel-body">
        <?php if($error):?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error;?>
            </div>
            <?php elseif($warning):?>
            <div class="alert alert-warning" role="alert">
                <?php echo $warning;?>
            </div>
        <?php endif;?>
        <form method="post" action="<?php echo base_url() . "panel/doLogin"; ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="user">Nombre de usuario:</label>
                <div class="input-group">
                    <span class="input-group-addon"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                    <input class="form-control" type="text" name="user"/>
                </div>
            </div>
            <div class="form-group">
                <label for="pass">Contrase&ntilde;a:</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-key" aria-hidden="true"></i></span>
                    <input class="form-control" type="password" name="pass"/>
                </div>
            </div>
            <div class="form-actions">
                <input class="btn btn-primary" type="submit" value="Iniciar sesión"/>
                <a class="btn btn-link" href="<?php echo base_url() . "panel/recover";?>" title="Recuperar password">Olvid&oacute; su contrase&ntilde;a?</a>
            </div>
        </form>

    </div>
</div>