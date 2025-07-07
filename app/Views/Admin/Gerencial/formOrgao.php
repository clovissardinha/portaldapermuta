<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Incluir novo órgao</h3>
        </div>
        <div class="card-body">
        <p class="text-uppercase text-danger"><?php echo isset($_SESSION['erro'])? $erro = $_SESSION['erro']:''  ?></p>
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $sucesso= $_SESSION['sucesso'];}  ?></p>
        
           <?php echo form_open('Admin/Gerencial/AlteraOrgao/saveOrgao')?>
                <div class="form-group p-5">
                    <label for="orgao">Nome:</label>
                    <input type="text" name="orgao" >
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Incluir</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>