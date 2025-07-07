<?php echo view('_common/header')?>
    <div class="container">
    <p>
        <h3 class="alert alert-warning"><?php echo $mensagem ?></h3>
    </p>
    </div>
     <div class="text-center">
     <button type="button" class="btn btn-link btn-lg border-dark "><a href="<?php echo base_url('Login') ?>"> Voltar</button>
     </div>

<?php echo view('_common/footer')?>