<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">
    <?php echo $canonica ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal da Permuta- login</title>
    <meta name="google-site-verification" content="K1xZyxGDUKEJgfdE8plXVcgo80I65Qon-lJsJcAjrOE" />
    <META NAME="KEYWORDS" CONTENT="Portal da permuta, permutaaki,permutando,permuta de servidores,universidades federais,institutos federais, professores,prefeituras,receita federal,tjsp,trt.">
    <meta name="description" content="A página de login permite ao usuário entrar em sua área pessoal e também obter a senha, caso a tenha esquecido.">
    <meta name="msvalidate.01" content="E43342E7469F9750161499B1BF493118" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="facebook-domain-verification" content="0b5qwbq90vjbjn51f66sjtwyzw1pp2" />
    <meta name="author" content="Clovis A Sardinha">
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
    <script async src="assets/js/lazysizes.min.js"></script>    
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5DHM0DXL"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-MN5DHM0DXL');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3918009181921323"
        crossorigin="anonymous">
    </script>
        <style>
        .bg_site {
            background-color: #4981F2;
        }
    </style>
    <script src="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js
"></script>
    <link href="
https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css
" rel="stylesheet">
        <header class="p-3 bg_site ">
        <div class="container-fluid">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="<?php echo base_url() ?>" class="navbar-brand m-2"><img src="<?php echo base_url('assets/imagens/logo_portal.webp') ?>" alt="Logo do Portal da Permuta" class="logo_site"></a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-sm-content-center mb-md-0">
                        <li class="nav-item m-auto">
                            <a class="nav-link  bg-link   text-white pl-5 pr-5" href="<?php echo base_url('Login') ?>">Entrar</a>
                        </li>
                        <li class="nav-link  font-weight-bold  mr-3"><a class="nav-link  bg-link   text-white pl-5 pr-5" href="<?php echo base_url('Contato') ?>" class="nav-link text-white">Contato</a>
                        </li>
                        <li class="nav-link  font-weight-bold  mr-3"><a class="nav-link  bg-link   text-white pl-5 pr-5" href="<?php echo base_url('SobreNos')  ?>" class="nav-link text-white ">Sobre nós</a>
                        </li>
                        <li class="nav-link  font-weight-bold  mr-3"><a class="nav-link  bg-link   text-white pl-5 pr-5" href="<?php echo base_url('Cadastro')  ?>" class="nav-link text-white">Cadastre-se</a></li>
                    </ul>
                </div>
            </div>
        </header>
        </head>
<body mb-5>
    </div>
    <div class="container" role="main">
        <?php echo $this->renderSection('content') ?>
    </div>

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="login"><?php echo $titulo ?></li>
            </ol>
        </nav>
        <?php echo isset($aviso) ? $aviso : '' ?>
        <div class="card">
            <div class="card-header">
                <p class="text-center text-uppercase h1"><strong><?php echo $titulo ?></strong></p>
                <p class="text-center text-uppercase text-danger"><strong><?php if (isset($mensagem)) echo $mensagem ?></strong></p>
            </div>
            <div class="card-body">
                <div class="bg-warning text-center">
                    <?php if (isset($validation)): ?>
                        <?= $validation->listErrors(); ?>
                    <?php endif ?>
                </div>
                <?php echo form_open('Login/login'); ?>
                <div class="form-group col-sm-5 m-auto">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input class="form-control" type="email" name="email" value="<?php echo !empty($post['email']) ? $post['email'] : set_value('email'); ?>">
                    </div>
                    <div class="form-group ">
                        <label for="senha">Senha</label>
                        <input class="form-control" type="password" name="senha">
                    </div>
                    <div class="form-group  m-auto">
                        <input type="submit" value="Enviar" class="btn btn-success">
                    </div>
                    <div class="form-group ">
                        <p><a href="<?php echo base_url('Login/lembraSenha') ?>">
                                <h5>Esqueceu a senha?</h5>
                            </a></p>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="card-footer">
                <p class="text-center"><strong><a href="<?php echo base_url('Cadastro')  ?>" class="nav-link ">CADASTRE-SE</strong>
                    <a></p>
            </div>
        </div>
    </div>
    <?php echo view('_common/footer') ?>