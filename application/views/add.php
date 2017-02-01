<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Panel de Control</h1>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h2 class="panel-title">Agregar a la base de datos</h2></div>
            <div class="panel-body">
			<div id="resultadoPersona"></div>
				<div id="resultadosEditarPersona"></div>
                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php elseif ($warning): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $warning; ?>
                    </div>
                <?php elseif ($success): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                <form id="guardarPersona" class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="legajo">Legajo:</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="legajo" name="legajo" placeholder="Ej: 123456" type="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="apellido">Apellido:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Ej: Perez" id="apellido" name="apellido"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nombre">Nombres:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Ej: Ana María" id="nombre" name="nombre"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="fnac">Fecha de nacimiento:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" placeholder="Ej: 30/06/1990" id="fnac" name="fnac"/>
                        </div>
                    </div>
                    <div class="form-group" id="emailCombo">
                        <label class="col-sm-2 control-label">E-mail:</label>
                        <div class="col-sm-10">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">Laboral</span>
                                                <input type="email" class="form-control" id="mail_laboral" name="mail_laboral">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" id="principal" name="principal" value="1" checked>Principal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">Personal</span>
                                                <input type="email" class="form-control" id="mail_personal" name="mail_personal">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" id="principal" name="principal" value="2">Principal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">Otro</span>
                                                <input type="email" class="form-control" id="mail_otro" name="mail_otro">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" id="principal" name="principal" value="3">Principal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() . "panel/system"; ?>" class="btn btn-default">Volver</a>
                            <input type="submit" value="Agregar" class="btn btn-primary" id="guardarDatos"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>