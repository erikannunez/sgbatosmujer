<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Panel de Control</h1>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h2 class="panel-title">Agregar a la base de datos</h2></div>
            <div class="panel-body">
                <form class="form-horizontal" action="<?php echo base_url() . '/panel/addpersona'; ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="legajo">Legajo:</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="legajo" placeholder="Ej: 123456" type="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="apellido">Apellido:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Ej: Perez" name="apellido"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nombre">Nombres:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" placeholder="Ej: Ana María" name="nombre"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="fnac">Fecha de nacimiento:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" placeholder="Ej: 30/06/1990" name="mail"/>
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
                                                <input type="email" class="form-control" name="mail1">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-default dropdown-toggle"
                                                            data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        Laboral <span class="caret"></span></button>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#" data-tipoid="1">Laboral</a></li>
                                                        <li><a href="#" data-tipoid="2">Personal</a></li>
                                                        <li><a href="#" data-tipoid="3">Otro</a></li>
                                                    </ul>
                                                    <input value="1" type="hidden" class="form-control" name="tipoEmail1"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="optionsRadios" value="option1" checked>Principal
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item list-group-item-info text-right">
                                    <a class="btn btn-success" href="#">Añadir e-mail</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <a href="<?php echo base_url() . "panel/system";?>" class="btn btn-default">Cancelar</a>
                            <input type="submit" value="Agregar" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>