<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Panel de Control</h1>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h2 class="panel-title">Modificar datos</h2></div>
            <div class="panel-body">
                <form class="form-horizontal" action="<?php echo base_url() . 'panel/updatepersona'; ?>" method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="persona_id" value="<?php echo $persona->id;?>"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="legajo">Legajo:</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="legajo" value="<?php echo $persona->legajo; ?>"
                                   type="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="apellido">Apellido:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo $persona->apellido; ?>"
                                   name="apellido"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nombre">Nombres:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo $persona->nombre; ?>"
                                   name="nombre"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="fnac">Fecha de nacimiento:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="date" value=" <?php echo mdate("%d/%m/%Y", strtotime($persona->fnac)); ?>" name="mail"/>
                        </div>
                    </div>
                    <div class="form-group" id="emailCombo">
                        <?php
                        $e_personal = array();
                        $e_laboral = array();
                        $e_otro = array();

                        foreach($email as $e){
                            if($e->tipoID == 1){
                                $e_personal = $e;
                            }else if($e->tipoID == 2){
                                $e_laboral = $e;
                            }else{
                                $e_otro = $e;
                            }
                        }
                        ?>
                        <label class="col-sm-2 control-label">E-mail:</label>
                        <div class="col-sm-10">
                            <ul class="list-group">
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">Laboral</span>
                                                <input type="email" class="form-control" value="<?php if (isset($e_laboral->direccion)) echo $e_laboral->direccion;?>" name="mail_laboral">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" name="optionsRadios" value="2" <?php if(isset($e_laboral->principal) && $e_laboral->principal == 1) echo "checked"; ?>>Principal
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
                                                <input type="email" class="form-control" name="mail_personal" value="<?php if (isset($e_personal->direccion)) echo $e_personal->direccion;?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" name="optionsRadios" value="1" <?php if(isset($e_personal->principal) && $e_personal->principal == 1) echo "checked"; ?>>Principal
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
                                                <input type="email" class="form-control" value="<?php if (isset($e_otro->direccion)) echo $e_otro->direccion;?>" name="mail_otro">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" name="optionsRadios" value="3" <?php if(isset($e_otro->principal) && $e_otro->principal == 1) echo "checked"; ?>>Principal
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
                            <a href="<?php echo base_url() . "panel/system";?>" class="btn btn-default">Cancelar</a>
                            <input type="submit" value="Guardar" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>