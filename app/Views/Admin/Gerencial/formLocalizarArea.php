<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>localizar órgao</h3>
        </div>
        <div class="card-body">        
           <?php echo form_open('Admin/Gerencial/AlteraArea/localizaFinal')?>
                <div class="form-group p-5">
                    <label for="area">Nome:</label>
                    <input type="text" name="area" value="" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Localizar</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>