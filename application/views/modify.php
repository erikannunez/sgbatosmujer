<script src="<?php echo base_url() . "assets/js/jquery.min.js"; ?>"></script>
<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Panel de Control</h1>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h2 class="panel-title">Modificar datos</h2></div>
            <div class="panel-body">
				<div id="id" style="display:none;"><?php echo $id?></div>
				<div id="mensajeEditarPersona"></div>
				<div id="resultadosEditarPersona"></div>
            </div>
        </div>
    </div>
</div>

<script>
	$(document).ready(function(){
		getPersona(1);
	});
//Trae Persona a Editar
	function getPersona(page){
		var q= $("#id").html();
		var base = '/panel/getPersona?id=' + q;
		$("#mensajeEditarPersona").fadeIn('slow');
		$.ajax({
			url : base,
			 beforeSend: function(objeto){
			 $('#mensajeEditarPersona').html('Cargando...');
		  },
			success:function(data){
				$("#resultadosEditarPersona").html(data).fadeIn('slow');
				$('#mensajeEditarPersona').html('');
				
			}
		})
	}	

</script>