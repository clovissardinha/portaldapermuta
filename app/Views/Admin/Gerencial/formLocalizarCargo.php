<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>localizar cargo</h3>
        </div>
        <div class="card-body">        
           <?php echo form_open('Admin/Gerencial/AlteraCargos/localizaFinal')?>
                <div class="form-group p-5">
                    <label for="orgao">Nome:</label>
                    <input type="text" name="cargo" value="" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Localizar</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>