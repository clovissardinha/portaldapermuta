<?php echo view('UserAdmin/_common/header')?>
<div class="card  ">
    <div class="card-header">
    <p class="text-center text-uppercase pt-5"><strong> Pesquisa por Cidades </strong></p> 
    </div>
    <div class="conteiner border ">
        <div class="card-body col-sm-4 m-auto">
            <?php echo form_open('UserAdmin/DadosArea/salvarDados') ?>
                <div class="form-group text-success">
                    <label for="estado">Escolha a Área (opcional)</label>
                    <?php echo form_dropdown('area_id',
                    $formDropDown,null,['class'=>'form-control']) ?>
                    
                </div>
                <input type="hidden" name="usuario_id" id="usuario_id" value="<?php echo $usuario ?>">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
