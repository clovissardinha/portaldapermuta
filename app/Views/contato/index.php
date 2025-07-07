<body mb-5>
   
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
                <li class="breadcrumb-item active" aria-current="login"><?php echo $titulo ?></li>
            </ol>
        </nav>
        <?php if (isset($_SESSION['msg'])): ?>
            <div class="alert alert-success text-center">
                <?php echo isset($_SESSION['msg']) ? $_SESSION['msg'] : '' ?>
            </div>
        <?php endif ?>
        <?php if (session()->has('errors')) : ?>
                    <div class="alert alert-warning"></div>
                    <ul>
                        <?php foreach (session('errors') as $error) : ?>
                            <li class="list-group-item text-danger"><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif ?>

        <div class="card m-auto">
            <div class="card-header text-center">
                <p class="h1"><strong><?php echo $titulo ?></strong></p>
            </div>
            <div class="card-body col-sm-5 m-auto">
                <?php echo form_open('Contato') ?>               
                <div class="form-group ">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" id="nome" value="<?php echo !empty($post['nome']) ? $post['nome'] : set_value('nome'); ?>" class="form-control" autofocus>
                </div>
                <div class="form-group ">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" value="<?php echo !empty($post['email']) ? $post['email'] : set_value('email'); ?>" class="form-control" autofocus>
                </div>
                <div class="form-group ">
                    <label for="assunto">Assunto</label>
                    <select class="form-control" name="assunto">
                        <option>Escolha o assunto</option>
                        <option>Suporte</option>
                        <option>Comentário</option>
                        <option>Dúvidas</option>
                        <option>Incluir órgao</option>
                        <option>Incluir cargo</option>
                    </select>
                </div>
                <div class="form-group ">
                    <label for="mensagem">Mensagem</label>
                    <textarea class="form-control" name="mensagem" rows="3"></textarea>
                </div>
                <div class="form-group ">
                    <div class="g-recaptcha" data-sitekey="6LcDoAArAAAAAGc92LjRaMFSMUOejsLaKfSpWY8R"></div>
                    <button type="submit"  id="btn-contato" class="btn btn-primary">Enviar</button>
                </div>
                <div class="text-center">

                    <div class="card-body">
                        <button class="btn btn-link"><a href="<?php echo base_url() ?>">Voltar</a></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
    <?php echo view('_common/footer') ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="<?php echo base_url('/assets/js/custom.js') ?>"></script>