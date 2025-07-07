<!DOCTYPE html>
<html lang="pt-BR">
<!-- Este header serve apenas aqueles que fizeram o cadastro e ainda não 
confirmaram o e-mail. Quando voltam não tem acesso ao link de entrar -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal da Permuta - site especializado em remoção de servidores e funcionários</title>
    <script src="<?php echo base_url('assets/jquery/jquery-3.5.1.min.js') ?>"></script>
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>


    <style>
        .logo_site {
            height: 60px;
            margin: 0;
        }
    </style>
    <script>
        var base_url = "<?php echo base_url() ?>";
    </script>
</head>

<body mb-5>
    <nav class="navbar navbar-expand-sm navbar-dark bg-info ">
        <a href="<?php echo base_url() ?>" class="navbar-brand"><img src="<?php echo base_url('assets/imagens/logo_portal.png') ?>" alt="Logo do Portal da Permuta" class="logo_site"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item font-weight-bold"><a href="<?php echo base_url() ?>" class="nav-link">Home</a></li>
                <li class="nav-item font-weight-bold"><a href="<?php echo base_url('Contato') ?>" class="nav-link ">Contato</a></li>
                <li class="nav-item font-weight-bold"><a href="<?php echo base_url('SobreNos')  ?>" class="nav-link ">Sobre nós</a></li>
                <li class="nav-item "><a href="<?php echo base_url('Cadastro')  ?>" class="nav-link text-dark">
                        <h5>Cadastre-se</h5>
                    </a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="<?php echo base_url('UserAdmin/Login') ?>" class="navbar-brand"></a></li>
            </ul>
        </div>
    </nav>
    <div class="container" role="main">
        <?php echo $this->renderSection('content') ?>
    </div>