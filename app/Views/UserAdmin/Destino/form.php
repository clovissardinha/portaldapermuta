<?php echo view('UserAdmin/_common/header')?>
<div class="card-header">
            <?php if (session()->has('errors')): ?>
            <div class="alert col-sm-6 m-auto ">
                <ul>
                    <?php foreach (session('errors') as $error): ?>
                        <li class="list-group-item text-danger"><?php echo($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif;?>
    </div>
<div class="card  ">
    <div class="card-header">
    <p class="text-center text-uppercase pt-5"><strong> Pesquisa por Cidades </strong></p> 
    </div>
    <div class="conteiner border ">
        <div class="card-body col-sm-4 m-auto">
            <?php echo form_open('UserAdmin/CadastraDestino/escolheCidade') ?>
                
                <div class="form-group text-danger">
                    <label for="cidade">Escolha a Cidade de Destino</label>
                    <input type="text" class="form-control"id="cidade"   placeholder="Pesquisar cidade" onkeyup="carregar_cidade(this.value)">
                </div>
                    <span id="resultado_pesquisa"></span>
                
                <input type="hidden" name="id_inter" id="id_inter" value="<?php echo $id_inter ?>">
                <input type="hidden" name="ativo" id="ativo" value="1">
                <input type="hidden" id="fk_cidade" name="fk_cidade">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<script src="/assets/js/cidade.js"></script>
<?php echo view('_common/footer')?>