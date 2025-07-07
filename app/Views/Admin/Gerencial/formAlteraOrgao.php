<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>ALTERAR ÓRGÃO</h3>
        </div>
        <div class="card-body">
        <p class="text-uppercase text-danger"><?php echo isset($_SESSION['erro'])? $erro = $_SESSION['erro']:''  ?></p>
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $sucesso= $_SESSION['sucesso'];}  ?></p>
        
           <?php echo form_open('Admin/Gerencial/AlteraOrgao/alteraOrgaoFinal')?>
                <div class="form-group p-5">
                    <label for="orgao">Nome:</label>
                    <input type="text" name="orgao" value="<?php echo $orgao['nome_orgao'] ?>" >
                </div>
                <input type="hidden" name="id_orgao" value="<?php echo $orgao['id_org'] ?>">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>