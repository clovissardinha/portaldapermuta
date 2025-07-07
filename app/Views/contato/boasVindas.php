<?php echo view('_common/header')?>

<div class="card">
    <div class="card-head m-5 text-center bg-light">
            <h3 class="alert alert-success"> Cadastrado com sucesso! Verifique no seu e-mail o recebimento<br>da sua senha provisória. Clique no botão abaixo para retornar.</h3>
    </div>
    <div class="card-body">
        <button class="btn btn-link"><a href="<?php echo base_url('Login/') ?>">Entrar</a></button>
    </div>
</div>
<?php echo view('_common/footer')?>