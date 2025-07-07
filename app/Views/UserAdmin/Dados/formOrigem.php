<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class="card">
        <div class="card-header">
            <p class="text-center text-uppercase pt-5"><strong> Cadastro de cidade de origem</strong></p>
        </div>
       
        <div class="card-body">
        <?php echo form_open('UserAdmin/DadosPessoais/salvaCidadeOrigem') ?>
                <div class="form-group">
                                        <label for="cidade"></label>
                                        <small id="helpId" class="font-weight-bold">cidade</small>  
                                        <input type="text" class="form-control" id="cidade" placeholder="Pesquisar cidade" onkeyup="carregar_cidade(this.value)">
                                </div>
                                        <span id="resultado_pesquisa"></span>
                <div class="form-group">
                    <input type="hidden" id="fk_cidade" name="fk_cidade">    
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </div>
        <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php echo view('_common/footer')?>
<script src="/assets/js/cidade.js"></script>