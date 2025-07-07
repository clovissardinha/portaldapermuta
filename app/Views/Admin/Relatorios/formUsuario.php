<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Busca Usuário por email ou nome</h3>
        </div>
        <div class="card-body">
           <?php echo form_open('Admin/Relatorios/AdminUsuarios/buscaUsuario')?>
                <div class="form-group p-5">
                    <label for="usuario">Nome ou email:</label>
                    <input type="text" name="usuario" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Pesquisar</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>