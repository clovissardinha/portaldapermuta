<?php echo view('Views/Admin/headerDeslogado')?>
<div class="col-md-8 m-auto">
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo base_url('Admin/Inicial'); ?>">Home</a></li>
        <li class="breadcrumb-item active" aria-current="login"><?php echo $titulo ?></li>
    </ol>
</nav>

<div class="card">
    <div class="card-header">
      <p class="text-center text-uppercase"><strong><?php echo $titulo ?></strong></p>
      <div class="text-danger"><?php echo isset($_SESSION['mensagem'])?$_SESSION['mensagem']:""; ?></div>
    </div>
    <div class="card-body">
        <?php echo form_open('Admin/Login/signIn');?>
            <div class="form-group col-sm-5">
                <label for="username">Usuário</label>
                <input class="form-control" type="text" name="username"value="<?php echo !empty($post['username']) ? $post['username'] :set_value('username') ;?>" required >
            </div>
            <div class="form-group col-sm-2">
                <label for="password">Senha</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group col-sm-5">
                <input type="submit" value="Enviar" class="btn btn-success">
            </div>
        <?php echo form_close();?>
    </div>
    
    </div>
</div>
