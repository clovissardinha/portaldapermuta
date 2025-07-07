<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Incluir nova Área</h3>
        </div>
        <div class="card-body">
        <p class="text-uppercase text-danger"><?php echo isset($_SESSION['erro'])? $erro = $_SESSION['erro']:''  ?></p>
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $sucesso= $_SESSION['sucesso'];}  ?></p>
        
           <?php echo form_open('Admin/Gerencial/AlteraArea/saveArea')?>
                <div class="form-group p-5">
                    <label for="area">Nome:</label>
                    <input type="text" name="area" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Incluir</button>
                    <button type="link" class="btn btn-lind"><a href="<?php echo base_url('Admin/Gerencial/AlteraArea')?>">voltar</a></button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>