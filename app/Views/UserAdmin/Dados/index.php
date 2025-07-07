<?php echo view('UserAdmin/_common/header');?>
<div class="container ml-auto">
  
    <div class="card-header">
      <p class="text-center  pt-2"><strong> Seus Dados</strong></p> 
      <p class="text-success text-center"><strong> <?php echo(isset($sucesso))? $sucesso :" "?> </strong></p> 
      <div class="text-success text-center"><?php echo isset($_SESSION['mural'])?$_SESSION['mural']:'' ?></div>
          <div class="text-success text-center"><?php echo isset($_SESSION['senha'])?$_SESSION['senha']:'' ?></div>
   </div> 
    <div class="container">
      <div class="card-body  ml-3">
          <?php echo form_open('UserAdmin/DadosPessoais/alteraNomeApelido') ?>
              <div class="form-group">
                <label for="nome">Usuário</label>
                <input type="text" name="nome" value="<?php echo $usuario[0]['nome'] ?> " class= "form-control text-left " >
              </div>
              <div class="form-group">
                <label for="apelido">Apelido</label>
                <input type="text" name="apelido" value="<?php echo $usuario[0]['apelido'] ?> " class= "form-control text-left " >
              </div>
              <div class="form-group">
                <label for="email">E-mail Principal</label>
                <input type="text" name="email" value="<?php echo $usuario[0]['email'] ?> " class= "form-control text-left " disabled >
              </div>
              <div class="form-group">
                <label for="email_alternativo">E-mail Alternativo</label>
                <input type="text" name="email_alternativo" value="<?php echo $usuario[0]['email_alternativo'] ?> " class= "form-control text-left " >
              </div>
              <div class="form-group">
                <label for="fone">Telefone</label>
                <input type="fone" name="fone" id="fone" value="<?php echo $usuario[0]['fone'] ?> " class= "form-control text-left "placeholder="00-999999999" maxlength="13"  >
              </div>
              <div class="form-group">
                <label for="celular">Celular</label>
                <input type="fone" name="celular" id="celular" value="<?php echo $usuario[0]['celular'] ?> " class= "form-control text-left "placeholder="00-999999999" maxlength="13"  >
              </div>
              <div class="form-group">
                <label for="whatsapp">Whatsapp</label>
                <input typpe="fone" name="whatsapp" id="whatsapp" value="<?php echo $usuario[0]['whatsapp'] ?> " class= "form-control text-left "placeholder="00-999999999" maxlength="13" >
              </div>

              <input type="hidden" name="id_user" id="id_user" value="<?php echo $usuario[0]['id_user'] ?>">
              <input type="hidden" name="user" id="user" value="<?php echo $usuario[0]['id_contato'] ?>">
                      <div class="form-group">
                          <input type="submit" class="btn btn-primary" value="Alterar">
                      </div>
          <?php echo form_close() ?> 
      </div>
    <hr>
  </div>
  <table class="table  table-bordered  my-3 ml-5 ">      
    <div class="group ">
      <div class="form-group ml-3">
        <tr>
          <th >Cidade de Origem</th>
          <td class="text-left"><?php echo $usuario[0]['cid_nome']  ?> / <?php echo $usuario[0]['cid_uf']  ?></td>
          <td > <?php echo anchor('UserAdmin/DadosPessoais/alteraCidade','Alterar') ?></td>
        </tr>
      </div>
    </div>
        <tr>
        <th >órgão</th>
        <td class="text-left "><?php echo $usuario[0]['nome_orgao']  ?></td>
        <td > <?php echo anchor('UserAdmin/DadosPessoais/alteraOrgao','Alterar') ?></td>
        </tr>
        <tr>
        <th >cargo</th>
        <td class="text-left "><?php echo $usuario[0]['nome_cargo']  ?></td>
        <td > <?php echo anchor('UserAdmin/DadosPessoais/alteraCargo','Alterar') ?></td>
        </tr>
        <tr>
        <th >área</th>
        <td class="text-left "><?php foreach ($area as $key=>$are) : ?>
          <?php echo $area[$key]['nome']; ?>
        <?php endforeach ?>
        </td>
        <td > <?php echo anchor('UserAdmin/DadosArea/alteraArea','Alterar/Incluir') ?></td>
        </tr>
        <?php echo form_open('UserAdmin/DadosPessoais/alteraMural')?>
            <tr>
            <th >mural ('coloque aqui comentarios sobre seu cargo')</th>
            <td ><textarea class="form-control" rows="5" id="comentario" name="comentario"><?php echo $usuario[0]['comentario']?$usuario[0]['comentario']:" "  ?></textarea></td>
            <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['id_user'] ?>">
            <td  class=" text-danger "> <input type="submit" class="btn btn-primary" value="Alterar"></td>
            </tr>
        <?php echo form_close()?>
        <tr>
          <th >destinos</th>
          <td class="text-left "><?php foreach($destinos as $destino):?>
            <?php echo $destino['cid_nome'].'/'.$destino['cid_uf']; ?><?php endforeach ?>
          </td>
          <td > <?php echo anchor('UserAdmin/CadastraDestino/alteraDestino','Alterar') ?></td>
        </tr> 
        <tr>
        <th >email confirmado</th>
        <td class="text-left "><?php echo ($usuario[0]['cadastro_ativado']=='1')?"sim":"não" ?></td>
        <td></td>
        </tr>
        <tr>
        <th >usuario ativo</th>
        <td class="text-left "><?php echo (($atual[0]['ativo']=='1')?'sim':'não') ?></td>
        <td><a href="<?php echo base_url('/UserAdmin/DadosPessoais/alteraAtivo') ?>">Alterar</a></td>
        </tr>
        <tr>
          <th>senha</th>
          <td></td>
          <td class="link">
            <a href="<?php echo base_url('/UserAdmin/DadosPessoais/alteraAtivo') ?>">Alterar senha</a>
          </td>
        </tr>
        <tr>
           <th >cadastrado em:</th>
           <td class="text-left"><?php  echo date('d/m/Y', strtotime ($usuario[0]['created_at']) ) ?></td>
           <td > <?php echo anchor('Cadastro/excluir','excluir') ?></td>
        </tr>
        
        
        <tr colspan="2" class="between">
				
				<th ><a class="btn btn-success " href="<?php echo base_url('UserAdmin/Home')?>"><strong>VOLTAR</strong></a>
				</th>
				</tr>
        
    </div>
  </table>
</div>
<script src="<?php echo base_url('assets/jquery.mask/jquery.mask.js') ?>"></script>
<script>
    $(function() {
        $('#cpf').mask('000.000.000-00', {
            
        });
        $('#cnpj').mask('000.000.000/0000-00', {
            
        });
        $('#insc_estadual').mask('000.000.000.000', {
            reverse: true
        });
        $('#ctps').mask('000.000.000.000', {
            reverse: true
        });
        $('#fone').mask('(00)00000-0000', {
            
        });
        $('#celular').mask('(00)00000-0000', {
            
        });
        $('#whatsapp').mask('(00)00000-0000', {
            
        });
        $('#CEP').mask('00.000-000', {
            
        });
    });
</script>