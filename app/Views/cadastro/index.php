<?php echo view('_common/header')?>
<body mb-5>
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><?php echo anchor("", 'Home') ?></li>
                <li class="breadcrumb-item active" aria-corrent="pag">Cadastro</li>
            </ol>
        </nav>
    </div>
    <div class="card  m-auto">
        <div class="card-header text-center">
            <p class="h1"><strong>Cadastro no Portal da Permuta</strong></p>
        </div>
        <div class="card-body col-sm-5 m-auto">
            <div class="bg-warning text-center">
                <?php if (isset($validation)): ?>
                    <?= $validation->listErrors(); ?>
                <?php endif ?>
                <?php echo form_open('Cadastro/inicial') ?>
            </div>
            <div class="form-group ">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php echo !empty($post['nome']) ? $post['nome'] : set_value('nome'); ?>" class="form-control" autofocus>
            </div>
            <div class="form-group ">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" value="<?php echo !empty($post['email']) ? $post['email'] : set_value('email'); ?>" class="form-control" autofocus>
            </div>
            <div class="form-group ">
                <label for="email">Repita o E-mail</label>
                <input type="email" name="confirma_email" id="email_confirma" value="<?php echo !empty($post['confirma_email']) ? $post['confirma_email'] : set_value('confirma_email'); ?>" class="form-control" autofocus>
            </div>
            <input type="hidden" name="senha" value="<?php echo rand(100000, 990000); ?>">
            <div class="form-group ">
                <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
            <a href="Login" class="link ml-3">Já sou cadastrado</a>
            <?php echo form_close() ?>
        </div>
    </div>
    <?php echo view('_common/footer') ?>