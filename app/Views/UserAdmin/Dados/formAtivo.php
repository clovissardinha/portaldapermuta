<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class="card my-5">
        <div class="card-header">
            <p class="text-center text-uppercase pt-5"><strong>Alterar cadastro: Suspenso ou Ativo</strong></p>
            <div class="bg-warning text-center">
              <?php if(isset($validation)):?>
                     <?= $validation->listErrors(); ?>
            <?php endif ?>
            </div>
        </div>
        <div class="card-body">
        <?php echo form_open('UserAdmin/DadosPessoais/salvaAtivo') ?>
            <div class="form-group" >
                            <label for="ativo"></label>
                                <select id="ativo" name="ativo">
                                <option value="null">Escolha uma opção</option>
                                <option value="1">Ativo</option>
                                <option value="0">Suspenso</option>
                                </select>
            </div>
            <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'] ?>">
            <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <th class="btn btn-success " ><a href="<?php echo base_url('UserAdmin/Home')?>" ><strong>VOLTAR</strong></a></th>
            </div>
           
        <?php echo form_close() ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <p class="text-center text-uppercase pt-5"><strong>Alterar senha</strong></p>
        </div>
        <div class="card-body">
        <?php echo form_open('UserAdmin/DadosPessoais/alteraSenha') ?>
            <div class="form">
                <div class="form-group ">
                    <label for="password">Nova Senha: </label> 
                    <input class="ml-4" type="password" name="password" id="password">
                </div>
                <div class="form-group ">
                    <label for="passconf">Confirma senha:  </label> 
                    <input class="ml-4" type="password" name="passconf" id="passconf">
                </div>
                <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION['id_user'] ?>">
                <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                            <th class="btn btn-success " ><a href="<?php echo base_url('UserAdmin/Home')?>" ><strong>VOLTAR</strong></a></th>
                </div>
            </div>
        <?php echo form_close() ?>
        </div>
        
    </div>
</div>