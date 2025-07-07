<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class="card">
        <div class="card-header">
            <p class="text-center text-uppercase pt-5"><strong> Cadastro de órgãos</strong></p>
        </div>
        <div class="card-body">
        <?php echo form_open('UserAdmin/DadosPessoais/salvaOrgao') ?>
        <div class="form-group text-danger" >
                        <label for="orgao">Selecione o Órgão</label>
                        <?php echo form_dropdown('orgao',
                        $formDropOrgao,null,['class'=>'form-control']) ?>
        </div>
        <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'] ?>">
        <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
        <?php echo form_close() ?>
        </div>
    </div>
</div>