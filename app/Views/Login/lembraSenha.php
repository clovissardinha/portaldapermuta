<?php echo $this->extend('_common/header')?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url(''); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="login"><?php echo $titulo ?></li>
    </ol>
</nav>
<div class="alert alert-danger text-center"><?php echo isset($aviso)?$aviso:'' ?></div>
<div class="card">
    <div class="card-header">
      <p class="text-center text-uppercase"><strong><?php echo $titulo ?></strong></p>
      <p class="text-center text-success"><strong><?php echo "Um email será encaminhado para sua caixa de correio eletrônico - veja também em spans" ?></strong></p>
      <p class="text-center text-danger"><strong><?php echo " Atenção: aguarde uns instantes. A cada pedido uma nova senha é gerada."?></strong></p>
      <p class="text-center text-uppercase"><strong><?php if(isset($mensagem)) echo $mensagem ?></strong></p>    
    </div>
    <div class="card-body">
            <div class="bg-warning text-center">
              <?php if(isset($validation)):?>
                     <?= $validation->listErrors(); ?>
            <?php endif ?>
            </div>
        <?php echo form_open('Login/recuperaSenha');?>
            <div class="form-group col-sm-5">
                <label for="email">E-mail</label>
                <input class="form-control" type="email" name="email"value="<?php echo !empty($post['email']) ? $post['email'] :set_value('email') ;?>" required >
            </div>
            <div class="form-group col-sm-5">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        <?php echo form_close();?>
    </div>
</div>
<?php echo view('_common/footer') ?>