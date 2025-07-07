<?php echo $this->extend('UserAdmin/_common/header')?>
<?php echo $this->section('content')?>
<div class="conteiner">

<div class="card">
        <div class="card-header">
             <p class="text-center text-uppercase pt-2"><strong> Excluir Cadastro de Usuário </strong></p>
             <p class="text-center text-danger "><strong> Todos os dados serão excluidos. Você pode suspender o cadastro no icone acima(Cadastro).  </strong></p>
             <p class="text-center text-danger "><strong>Se precisar trocar o e-mail principal, entre em contato com a gente por e-mail. </strong></p>
             <p class="text-center "><strong> <?php echo $_SESSION['email'] ?></strong></p>
        </div>
        <div class="bg-warning text-center">
              <?php if(isset($validation)):?>
                     <?= $validation->listErrors(); ?>
              <?php endif ?>
        </div>
        <?php echo form_open('Cadastro/exclueFinal') ?>
        <div class="card-body  ml-3">
            <p ><h5 >Escolha um motivo:</h5></p>
                   
            <div class="form-check">
                <input class="form-check-input" type="radio" name="motivo" id="exampleRadios1" value="1" >
                <label class="form-check-label" for="exampleRadios1">
                            Consegui a permuta pelo Portal
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="motivo" id="exampleRadios2" value="2">
                <label class="form-check-label" for="exampleRadios2">
                            Consegui a permuta
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="motivo" id="exampleRadios3" value="3" >
                <label class="form-check-label" for="exampleRadios3">
                            Desisti da permuta
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="motivo" id="exampleRadios3" value="4" >
                <label class="form-check-label" for="exampleRadios3">
                            Entrei por curiosidade
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="motivo" id="exampleRadios3" value="5" >
                <label class="form-check-label" for="exampleRadios3">
                        Outro motivo
                </label>
            </div>
            <h5 class="mt-2">Você recomendaria o Portal da Permuta a um amigo?</h5>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="indica" id="exampleRadios3" value="1" >
                    <label class="form-check-label" for="exampleRadios3">
                        Sim
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="indica" id="exampleRadios3" value="2" >
                    <label class="form-check-label" for="exampleRadios3">
                        Não
                    </label>
                </div>
                <div class="form-group" >
                    <label for="comentario"><h5 class="mt-2">Criticas ou elogios</h5></label>
                    <textarea class="form-control" name="comentario" rows="3"></textarea>
                    <input type="hidden" name="id_user" value="<?php echo $_SESSION['id_user']?>">
                </div>	 
                
                <div class="justify-content-between mt-3">
                    <button type="submit" class="btn btn-danger ">EXCLUIR</button>
                    <a class="btn btn-success " href="<?php echo base_url('UserAdmin/Home')?>"><strong>VOLTAR</strong></a>
                </div>
                    
    <?php echo form_close()?>
		</div>	
</div>
<?php echo $this->endsection('content')?>