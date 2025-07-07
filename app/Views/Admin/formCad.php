<?php echo view('Views/Admin/header')?>
<div class="container">
    <div class="col-md-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>Cadastro de novo administrador</h3>
            </div>
            <div><?php if (! empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <ul>
        <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        </ul>
    </div>
<?php endif ?></div>
            <div class="card-body">
                <?php echo form_open('Admin/Cadastro/save')?>
                <div class="form-group">
                <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo !empty($post['username']) ? $post['username'] :set_value('username') ;?>" class="form-control" autofocus >  
                </div>
                <div class="form-group">
                <label for="password">Senha</label>
                    <input type="text" name="password" id="password" value="<?php echo !empty($post['password']) ? $post['password'] :set_value('password') ;?>" class="form-control" autofocus >  
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Cadastrar</button>
                </div>
                <?php echo form_close()?>
            </div>
        </div>
    </div>
</div>