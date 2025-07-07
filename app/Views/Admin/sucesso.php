<?php echo view('Views/Admin/header')?>
<div class="card col-md-8 m-auto text-center">
    <div class="card-header">
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $item = $_SESSION['sucesso'];}  ?></p>
    </div>
    <button class="link "><a class="link" href="<?php echo base_url('Admin/Login/retorno') ?>">VOLTAR</a></button>
</div>