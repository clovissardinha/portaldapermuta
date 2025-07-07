<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>SUBSTITUIR CARGO</h3>
        </div>
        <div class="card-body">
        <p class="text-uppercase text-danger"><?php echo isset($_SESSION['erro'])? $erro = $_SESSION['erro']:''  ?></p>
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $sucesso= $_SESSION['sucesso'];}  ?></p>
        
           <?php echo form_open('Admin/Gerencial/AlteraCargos/substituirFinal')?>
                <div class="form-group p-5">
                    <label for="cargo">Cargo Principal a ser <span class="text-success h4"> mantido:</span></label>
                    <?php echo form_dropdown('cargo',$cargos,null,['class'=>'form-control ']) ?>
                </div>
                <div class="form-group p-5">
                    <label for="cargo"> Cargo a ser<span class="text-danger h4"> Excluido:</span></label>
                    <?php echo form_dropdown('cargoExcluido',$cargos,null,['class'=>'form-control ']) ?>
                </div>
               
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>