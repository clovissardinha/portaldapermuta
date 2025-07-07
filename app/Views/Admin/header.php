<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle Administrativo do Portal da Permuta</title>
    <script src="<?php echo base_url('assets/jquery/jquery-3.5.1.min.js') ?>"></script>
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>


    <style>
        .logo_site {
            height: 50px;
            margin: 0;
        }
    </style>
    <script>
        var base_url = "<?php echo base_url() ?>";
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-success  p-3 ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="flex custom-control-inline">
                <div class="btn btn-light  mr-3"><a href="<?php echo base_url('Admin/Login/retorno') ?>">INICIO</a></div>
                <div class="dropdown flex-sm-fill">
                    <button type="button" class="btn btn-primary dropdown-toggle mr-3" data-toggle="dropdown">
                        Relatórios
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios/twitter') ?>">Twitter</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/NovosUsuarios/ListaUsuarios') ?>">Lista Usuarios ATIVOS</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/NovosUsuarios/inativos') ?>">Lista Usuarios INATIVOS</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios/exclusao') ?>">Motivos de exclusão</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios/mural') ?>">Mural</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios/orgaoRanking') ?>">Participação dos órgãos</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios/cargoRanking') ?>">Participação dos cargos</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios/crescimentoPortal') ?>">Evolução do cadastro</a>
                    </div>
                </div>
                <div class="dropdown flex-sm-fill">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        Administrativo
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Relatorios/AdminUsuarios') ?>">Busca Usuário</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Gerencial/AlteraDestaque/destaques') ?>">Destaques</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Gerencial/AlteraOrgao') ?>">Órgaos</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Gerencial/AlteraCargos') ?>">Cargos</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Gerencial/AlteraArea') ?>">Áreas</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Cadastro/') ?>">Cadastrar novo Administrador</a>
                        <a class="dropdown-item" href="<?php echo base_url('Admin/Gerencial/EmailReforco') ?>">Mandar e-mail de reforço</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-rigth text-white">

            <div><?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ''; ?>
                <ul class="navbar-nav">
                    <li class="nav-item mr-auto mt-auto">
                        <a class="btn btn-light ml-3 " href="<?php echo base_url('Admin/Login/logout') ?>">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" role="main">
        <?php echo $this->renderSection('content') ?>
    </div>

    <script src="<?php echo base_url('assets/jquery.mask/jquery.mask.js') ?>"></script>