<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>ALTERAR ÁREA</h3>
        </div>
        <div class="card-body">
        <p class="text-uppercase text-danger"><?php echo isset($_SESSION['erro'])? $erro = $_SESSION['erro']:''  ?></p>
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $sucesso= $_SESSION['sucesso'];}  ?></p>
        
           <?php echo form_open('Admin/Gerencial/AlteraArea/alteraAreaFinal')?>
                <div class="form-group p-5">
                    <label for="area">Nome:</label>
                    <input type="text" name="area" value="<?php echo $area['nome'] ?>" >
                </div>
                <input type="hidden" name="id_area" value="<?php echo $area['id'] ?>">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>