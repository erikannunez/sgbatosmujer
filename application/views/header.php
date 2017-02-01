<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo "Panel de Control"; ?></title>

    <link href="<?php echo base_url() . "assets/css/bootstrap.min.css"; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . "assets/css/bootstrap-theme.min.css"; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . "assets/css/font-awesome.min.css"; ?>" rel="stylesheet">
    <link href="<?php echo base_url() . "assets/css/styles.css"; ?>" rel="stylesheet">
	<script src="<?php echo base_url() . "assets/js/jquery.min.js"; ?>"></script>
    <!--[if lt IE 9]>
    <script src="<?php echo base_url() . " assets/js/html5shiv.min.js"; ?>"></script>
    <script src = "<?php echo base_url() . "assets / js / respond.min.js"; ?>" ></script>
    <![endif]-->
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">Departamento de la Mujer - SGBATOS</a>
        </div>
        <?php
        $segment = $this->uri->rsegment(2);
        ?>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left">
                <li class="<?php if ($segment == 'index') echo 'active'; ?>"><a
                        href="<?php echo base_url(); ?>">Inicio</a>
                </li>
                <li class="<?php if ($segment == 'system') echo 'active'; ?>"><a
                        href="<?php echo base_url() . 'panel/system'; ?>">Panel</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                    <?php if (!isset($user['username'])): ?>
                       <li><a href="<?php echo base_url() . "panel/login"; ?>">Iniciar sesión</a></li>
                    <?php else: ?>
                        <li><span class="label label-success">Bienvenid@, <?php echo $user['username']; ?>!</span></li>
                        <li><a href="<?php echo base_url() . "panel/logout"; ?>">Cerrar sesión</a></li>
                    <?php endif; ?>

            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<div class="container theme-showcase" role="main">