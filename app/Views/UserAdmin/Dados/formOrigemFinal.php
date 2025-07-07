<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class="card">
        <div class="card-header">
            <p class="text-center text-uppercase pt-5"><strong> Cadastro de cidade de origem</strong></p>
        </div>
        <div class="card-body">
        <?php echo form_open('UserAdmin/DadosPessoais/salvaCidadeOrigem') ?>
        <div class="form-group" >
                        <label for="estado_origem">Estado de Origem</label>
                        <input type="text" name="estado" value="<?php  echo $nomeEstado[0]['estado_nome'] ?>" class= "form-control " disabled >
                </div>
                <div class="form-group text-danger">
                        <label for="cidade">Selecione a Cidade</label>
                        <?php echo form_dropdown('cidade',
                    $formaDropDowCidade,null,['class'=>'form-control','required'=>'required']) ?>
                </div>
                <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'] ?>">
        <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
        <?php echo form_close() ?>
        </div>
    </div>
</div>