<?php echo view('_common/headerInativo') ?>

<p></p>
<div class="card">
    <div class="card-header">
        <p class="text-center text-uppercase pt-1"><strong> Cadastro de Usuário - Continuação</strong></p>
        <p class="text-center text-uppercase pt-1"><strong> Preencha todos os campos obrigatórios</strong></p>
        <p class="text-center pt-1"><strong> <?php echo $_SESSION['email'] ?></strong></p>
    </div>
    <div class="card-body">
        <!-- Verifica se há erros e mostra -->
        <div class="card-body">
            <?php if (session()->has('errors')) : ?>
                <div class="alert col-sm-6 m-auto ">
                    <ul>
                        <?php foreach (session('errors') as $error) : ?>
                            <li class="list-group-item text-danger"><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif ?>
                </div>
                <div class="card-body  m-auto col-md-5">
                    <?php echo form_open('/Cadastro/dadosPessoais') ?>
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" value="<?php echo $_SESSION['usuario'] ?> " class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="cidade" class="text-danger">Cidade Atual<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="cidade" placeholder="Pesquisar cidade" onkeyup="carregar_cidade(this.value)">
                    </div>
                    <span id="resultado_pesquisa"></span>
                    <div class="form-group text-danger">
                        <label for="orgao">Órgão<span class="text-danger">*</span></label>
                        <?php echo form_dropdown(
                            'orgao',
                            $formDropDow,
                            old('orgao'),
                            ['class' => 'form-control']
                        ) ?>
                    </div>
                    <div class="form-group text-danger">
                        <label for="cargo">Cargo<span class="text-danger">*</span></label>
                        <?php echo form_dropdown(
                            'cargo',
                            $formDropDowCargo,
                            old('cargo'),
                            ['class' => 'form-control']
                        ) ?>
                    </div>
                    <div class="form-group text-success">
                        <label for="area">Área -'opcional'</label>
                        <?php echo form_dropdown(
                            'area',
                            $formDropDowArea,
                            old('area'),
                            ['class' => 'form-control']
                        ) ?>
                    </div>
                    <div class="form-group text-danger">
                        <label for="celular">Celular<span class="text-danger">*</span></label>
                        <input type="text" name="celular" id="celular" placeholder="(00)99999-9999" maxlength="12" value="<?= old('celular'); ?>" class="form-control">
                    </div>
                    <div class="form-group text-success">
                        <label for="comentario">Mural-Detalhes importantes</label>
                        <textarea name="comentario" id="comentario" row="3" maxlength="500" value="<?= old('comentario'); ?>" class="form-control textarea"><?= old('comentario') ?></textarea>
                    </div>
                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'] ?>">
                    <input type="hidden" name="cadastro_ativado" id="cadastro_ativado" value="1">
                    <input type="hidden" name="ativo" id="ativo" value="1">
                    <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'] ?>">
                    <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['email'] ?>">
                    <input type="hidden" id="fk_cidade" name="fk_cidade">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary mt-2" onclick="load()" id="press">Cadastrar</button>
                        <button class="btn btn-primary mt-2" type="button" disabled id="spinner">
                            <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                            <span role="status">Aguarde...</span>
                        </button>
                    </div>
                    <?php echo form_close() ?>
                    <p class="text-danger">* campos obrigatórios</p>
                </div>

        </div>
        <script src="/assets/js/cidade.js"></script>
        <script src="<?php echo base_url('assets/jquery.mask/jquery.mask.js') ?>"></script>
        <script>
            $(function() {
                $('#cpf').mask('000.000.000-00', {

                });
                $('#cnpj').mask('000.000.000/0000-00', {

                });
                $('#insc_estadual').mask('000.000.000.000', {
                    reverse: true
                });
                $('#ctps').mask('000.000.000.000', {
                    reverse: true
                });
                $('#fone').mask('(00)00000-0000', {

                });
                $('#celular').mask('(00)00000-0000', {

                });
                $('#whatsapp').mask('(00)00000-0000', {

                });
                $('#CEP').mask('00.000-000', {

                });
            });
        </script>
        <script>
    document.getElementById("spinner").style.display = 'none';
    
    function load() {
        
        document.getElementById("press").style.display='none';
        document.getElementById("spinner").style.display='inline';

        setTimeout(function(){
                document.getElementById("press").style.display='inline';
                document.getElementById("spinner").style.display='none';
            },2000);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>