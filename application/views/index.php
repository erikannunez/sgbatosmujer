<div class="page-header">
    <h1>¡Bienvenida!</h1>
	<h1>Hoy cumplen:</h1>
	<?php if($cumplen){?>
	               <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>Legajo</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($cumplen as $p): ?>
                            <tr>
                                <td>
                                    <?php echo $p->legajo; ?>
                                </td>
                                <td>
                                    <?php echo $p->apellido; ?>
                                </td>
                                <td>
                                    <?php echo $p->nombre; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
						<?php }else{?>
						<?php echo '<div class="alert alert-warning" role="alert">Hoy no hay cumpleañeras</div>';}?>
                        </tbody>
                    </table>
                </div>
</div>