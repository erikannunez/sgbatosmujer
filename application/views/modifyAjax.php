                <form id="editarPersona" class="form-horizontal" action="" method="post"
                      enctype="multipart/form-data">
                    <input type="hidden" name="id" id="id" value="<?php echo $persona->id;?>"/>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="legajo">Legajo:</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="legajo" id="legajo" value="<?php echo $persona->legajo; ?>"
                                   type="number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="apellido">Apellido:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo $persona->apellido; ?>"
                                   name="apellido" id="apellido"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="nombre">Nombres:</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="text" value="<?php echo $persona->nombre; ?>"
                                   name="nombre" id="nombre"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="fnac">Fecha de nacimiento:</label>
                        <div class="col-sm-10">
							<input class="form-control" type="date" value="<?php echo $persona->fnac;?>" name="fnac" id="fnac"/>
                        </div>
                    </div>
                    <div class="form-group" id="emailCombo">
                        <?php
                        $e_personal = array();
                        $e_laboral = array();
                        $e_otro = array();

                        foreach($email as $e){
                            if($e->tipoID == 1){
                                $e_laboral = $e;
								$id_laboral = $e->id;
								echo '<input type="hidden" name="id_laboral" id="id_laboral" value="',$e->id,'">';
                            }else if($e->tipoID == 2){
                                $e_personal = $e;
								$id_personal = $e->id;
								echo '<input type="hidden" name="id_personal" id="id_personal" value="',$e->id,'">';
                            }else{
                                $e_otro = $e;
								$id_otro = $e->id;
								echo '<input type="hidden" name="id_otro" id="id_otro" value="',$e->id,'">';
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
                                                <input type="email" class="form-control" value="<?php if (isset($e_laboral->direccion)) echo $e_laboral->direccion;?>" name="mail_laboral" id="mail_laboral">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" name="principal" id="principal" value="1" <?php if($persona->principal == 1) echo "checked"; ?>>Principal
                                                </label>
												<?php if (isset($e_laboral->id) && $persona->principal != 1){?>
												</button>
													<a href="#" button type="button" onclick="eliminar('<?php echo $e_laboral->id; ?>')" class="btn btn-danger" aria-label="Left Align">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
												</button>
												<?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">Personal</span>
                                                <input type="email" class="form-control" name="mail_personal" id="mail_personal" value="<?php if (isset($e_personal->direccion)) echo $e_personal->direccion;?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" name="principal" id="principal" value="2" <?php if($persona->principal == 2) echo "checked"; ?>>Principal
                                                </label>
												<?php if (isset($e_personal->id) && $persona->principal != 2){?>
												</button>
													<a href="#" button type="button" onclick="eliminar('<?php echo $e_personal->id; ?>')" class="btn btn-danger" aria-label="Left Align">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
												</button>
												<?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-addon">Otro</span>
                                                <input type="email" class="form-control" value="<?php if (isset($e_otro->direccion)) echo $e_otro->direccion;?>" name="mail_otro" id="mail_otro">
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="radio">
                                                <label>
                                                    <input required type="radio" name="principal" id="principal" value="3" <?php if($persona->principal == 3) echo "checked"; ?>>Principal
                                                </label>
												<?php if (isset($e_otro->id) && $persona->principal != 3){?>
												</button>
													<a href="#" button type="button" onclick="eliminar('<?php echo $e_otro->id; ?>')" class="btn btn-danger" aria-label="Left Align">
													<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
												</button>
												<?php } ?>
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
                            <input type="submit" value="Guardar" id="actualizarDatos" class="btn btn-primary"/>
                        </div>
                    </div>
                </form>
<script>
$( "#editarPersona" ).submit(function( event ) { //name del form
  $('#actualizarDatos').attr("disabled", true); //id del submit
  
 var parametros = $(this).serialize();
	 $.ajax({
			type: "POST",
			url: "/panel/updatepersona", //URL a la que apuntaría el form
			data: parametros,
			 beforeSend: function(objeto){
				$("#mensajeEditarPersona").html("Mensaje: Cargando..."); //Div vacío para poner cargando...
			  },
			success: function(datos){
			$("#mensajeEditarPersona").html(datos);
			$('#actualizarDatos').attr("disabled", false);
			getPersona(1);
		  }
	});
	
	event.preventDefault();
  
})

	function eliminar (id){
		if (confirm("Realmente deseas eliminar el mail?")){	
		$.ajax({
			type: "GET",
			url: "/panel/deleteMail",
			data: "mailID="+id,
			 beforeSend: function(objeto){
				$("#mensajeEditarPersona").html("Mensaje: Cargando...");
			  },
			success: function(datos){
			$("#mensajeEditarPersona").html(datos);
			getPersona(1)
			}
				});	
		}
		;
	}
</script>