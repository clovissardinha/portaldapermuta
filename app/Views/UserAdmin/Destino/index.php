<?php echo view('UserAdmin/_common/header')?>
<div class="card  ">
    <div class="card-header">
    <p class="text-center text-uppercase pt-5"><strong> Buscar cidade de Destino </strong></p> 
    </div>
    <div class="conteiner border ">
        <div class="card-body col-sm-4 m-auto">
            <?php echo form_open('UserAdmin/CadastraDestino/buscarEstado') ?>
                <div class="form-group ">
                    <div class="alert-danger"><?php echo isset($_SESSION['mensagem'])?$_SESSION['mensagem']:''?></div>
                    <label for="estado">Escolha o Estado</label>
                    <?php echo form_dropdown('estado',
                    $formDropEstado,null,['class'=>'form-control']) ?>
                    
                </div>
                
                <div class="form-group text-danger">
                    <input type="submit" class="btn btn-primary" value="Pesquisar">
                </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>