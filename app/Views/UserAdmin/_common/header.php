<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal da Permuta - site especializado em remoção de servidores e funcionários</title>
    <script src="<?php echo base_url('assets/jquery/jquery-3.5.1.min.js') ?>"></script>
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <?php if(isset($google)) {echo '';}?>

    <style>
        .logo_site {
            height: 50px;
            margin: 0;
        }

        .bg_site {
            background-color: #62CDFF;
        }

        .bg_link {
            background-color: #146C94;
        }
    </style>
    <script>
        var base_url = "<?php echo base_url() ?>";
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark  bg_site ">
        <button class="navbar-toggler " type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav  flex-row ">
                <div class="p-2" title="home"><a href="<?php echo base_url('UserAdmin/Home')  ?>" class="nav-link text-white"><i class="fa-solid fa-house"></i></a></div>
                <div class="p-2" title="contato"> <a href="<?php echo base_url('UserAdmin/ContatoUser') ?>" class="nav-link text-white"><i class="fa-solid fa-envelope"></i></a></div>
                <div class="p-2" title="senha/ativar"> <a href="<?php echo base_url('UserAdmin/DadosPessoais/alteraAtivo')  ?>" class="nav-link text-white"><i class="fa-solid fa-lock"></i></a></div>
                <div class="p-2" title="videos explicativos"> <a href="<?php echo base_url('UserAdmin/DadosPessoais/videos')  ?>" class="nav-link text-white"><i class="fa-solid fa-photo-film"></i></a></div>
                <div class="p-2" title="dados pessoais"> <a href="<?php echo base_url('UserAdmin/DadosPessoais')  ?>" class="nav-link  text-white"><i class="fa-sharp-duotone fa-solid fa-gear"></i></a></div>
            </div>
            <div class="dropdown flex-sm-fill mb-1">
                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" title="Pesquisas">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/Cidade') ?>">Por cidade do meu destino</a>
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/Cidade/origem') ?>">Por cidade da minha origem</a>
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/PesquisaOrgao/index') ?>">Por órgão</a>
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/PesquisaCargo/index') ?>">Por cargo</a>
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/PesquisaEstado/index') ?>">Por estado</a>
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/PesquisaData/index') ?>">Por data</a>
                    <a class="dropdown-item" href="<?php echo base_url('UserAdmin/Triangulacao/index') ?>">Triangulação</a>
                </div>
            </div>
            <div class="mr-4">


                <ul class="navbar-nav mr-auto">
                    <!-- mostra erros da pesquisa -->
                    <?php if (! empty($errors)): ?>
                        <ul class="text-danger list-unstyled">
                            <?php foreach ($errors as $error): ?>
                                <li><?= esc($error) ?></li>
                                <li><a class="btn btn-primary text-white list-unstyled" href="<?php echo base_url('UserAdmin/Home') ?>">voltar</a></li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
                    <?php echo form_open('UserAdmin/Search'); ?>
                    <input type="text" name="busca" id="busca" class="p-2" placeholder="pesquise">
                    <button class="btn btn-primary mt-1">Buscar</button>
                    <?php echo form_close() ?>
                </ul>
            </div>
            <ul class="navbar-nav">
                <li class="nav-item"><a href="<?php echo base_url('UserAdmin/DadosPessoais/uploadFoto') ?>" class="navbar-brand"><img src="/assets/imagens/<?php echo isset($_SESSION['imagem']) ? $_SESSION['imagem'] : 'image-placeholder.png' ?>" alt="foto de perfil" class="logo_site rounded"></a></li>
                <li class="nav-item mr-auto mt-auto">
                    <a class="nav-link text-white" href="<?php echo base_url('Login/logout') ?>">Sair</a>
                    <div class=""><?php echo isset($_SESSION['usuario']) ? $_SESSION['usuario'] : ""; ?></div>
                </li>

            </ul>
        </div>

    </nav>
    <div class="container" role="main">
        <?php echo $this->renderSection('content') ?>
    </div>

    <script src="<?php echo base_url('assets/jquery.mask/jquery.mask.js') ?>"></script>