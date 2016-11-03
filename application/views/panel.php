<div class="row">
    <div class="col-xs-12">
        <div class="page-header">
            <h1>Panel de Control</h1>
        </div>
        <div class="panel panel-primary">
            <div class="panel-heading"><h2 class="panel-title">Base de datos de mujeres</h2></div>
            <div class="panel-body">

                <?php if ($error): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php elseif ($warning): ?>
                    <div class="alert alert-warning" role="alert">
                        <?php echo $warning; ?>
                    </div>
                <?php endif; ?>
                <div class="row form-actions">
                    <div class="col-xs-12 col-sm-6">
                        <?php if ($search): ?>
                            <h3>Resultados para: <em>"<?php echo $search; ?>"</em></h3>
                        <?php endif; ?>
                        <?php echo $links; ?>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div class="pull-right">
                            <form class="form-inline" action="<?php echo base_url() . 'panel/search'; ?>" method="post"
                                  enctype="multipart/form-data">
                                <div class="input-group">
                                    <input name="search" type="text" class="form-control" placeholder="Buscar...">
                                <span class="input-group-btn">
                                    <button class="btn btn-info" type="submit"><i class="fa fa-search"
                                                                                  aria-hidden="true"></i> Buscar</button>
                                </span>
                                </div>
                                <?php if ($search): ?>
                                <a class="btn btn-default" href="<?php echo base_url() . "panel/system"; ?>"><i
                                        class="fa fa-bath" aria-hidden="true"></i> Limpiar</a>
                                <?php endif;?>
                                <a class="btn btn-success" href="<?php echo base_url() . "panel/add"; ?>"><i
                                        class="fa fa-plus" aria-hidden="true"></i> Agregar</a>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Legajo</th>
                            <th>Apellido</th>
                            <th>Nombre</th>
                            <th>Fecha de nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($personas as $p): ?>
                            <tr>
                                <td>
                                    <?php echo $p->id; ?>
                                </td>
                                <td>
                                    <?php echo $p->legajo; ?>
                                </td>
                                <td>
                                    <?php echo $p->apellido; ?>
                                </td>
                                <td>
                                    <?php echo $p->nombre; ?>
                                </td>
                                <td>
                                    <?php echo mdate("%d/%m/%Y", strtotime($p->fnac)); ?>
                                </td>
                                <td>
                                    <a class="btn btn-warning"
                                       href="<?php echo base_url() . "panel/edit?id=" . $p->id; ?>"><i
                                            class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <a class="btn btn-danger"
                                       href="<?php echo base_url() . "panel/delete?id=" . $p->id; ?>"><i
                                            class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="6" class="text-center"><?php echo $links; ?>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>