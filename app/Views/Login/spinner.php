<?php echo view('_common/header') ?>

<body>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>">Home</a></li>
            <li class="breadcrumb-item active" aria-current="login">Lembrar Senha</li>
        </ol>
    </nav>
    <div class="card">
        <div class="card-header">
            <p class="text-center text-uppercase"><strong>Lembrar Senha</strong></p>
            <p class="text-center text-success"><strong>Um email será encaminhado para sua caixa de correio eletrônico - veja também em spans</strong></p>
            <p class="text-center text-danger"><strong> Atenção: aguarde uns instantes. A cada pedido uma nova senha é gerada.</strong></p>
            <p class="text-center text-uppercase"><strong></strong></p>
        </div>
        <?php echo form_open('Login/recuperaSenha'); ?>
        <div class="form-group text-center col-sm-5 m-auto">
            <label for="email">E-mail</label>
            <input class="form-control" type="email" name="email" value="<?php echo !empty($post['email']) ? $post['email'] : set_value('email'); ?>" placeholder="Informe o email" required>
            <button type="submit" class="btn btn-primary mt-2" onclick="load()" id="press">Enviar</button>
            <button class="btn btn-primary mt-2" type="button" disabled id="spinner">
                <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                <span role="status">Loading...</span>
            </button>
        </div>
        <?php echo form_close() ?>
    </div>


    <script>
        document.getElementById("spinner").style.display = 'none';

        function load() {

            document.getElementById("press").style.display = 'none';
            document.getElementById("spinner").style.display = 'inline';

            setTimeout(function() {
                document.getElementById("press").style.display = 'inline';
                document.getElementById("spinner").style.display = 'none';
            }, 2000);
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <?php echo view('_common/footer'); ?>