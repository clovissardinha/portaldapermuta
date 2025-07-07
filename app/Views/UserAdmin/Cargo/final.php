<?php
 echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
  <div class="text-center text-uppercase my-3">
      <h3> Cargo Pesquisado :  <?php echo !empty($usuarios[0]['nome_cargo'])? $usuarios[0]['nome_cargo'] :'Nenhum registro encontrado' ?></h3>
      
  </div>
  
    <div class="text-left">    
      <form class="form-inline my-4  " action="<?php echo base_url('UserAdmin/PesquisaCargo/buscarCargo') ?>", method="get">
        <div class="form-group">
          <label for="orgao">Filtrar por órgão</label>
          <input type="text" class="form-control" id="orgao" placeholder="Pesquisar orgao - digite parte do nome" onkeyup="carregar_orgao(this.value)">
        </div>     
        <input class="ml-3 btn btn-primary" type="submit" class="btn btn-primary" value="Pesquisar">
        <input type="hidden" name="paginas" value="<?php echo $numero?>">
        <input type="hidden" name="fk_cargo" value="<?php echo $cargo?>">
        <input type="hidden" id="fk_orgao" name="fk_orgao"> 
        <input type="hidden" name="indice" value="<?php echo $indice?>">
        <input type="hidden" name="area" value="<?php echo $area?>">
      </form>
      <span id="resultado_pesquisa"></span>   
    </div>
  
  <table class="table table-striped table-bordered  my-5" id="orgaoTable">
    <thead>
      <div class="container">
        <div class="text-center"> <?php if(!empty($usuarios[0]['nome_cargo'])): ?></div>
        <div class="text-center"> <?php !empty($usuarios[0]['nome_cargo'])?$usuarios[0]['nome_cargo']:'' ?></div>
      <tr class="text-left">
        <th >nome</th>
        <th >órgão</th>
        <th >área</th>
        <th>origem</th>
        <th >destino</th>
        <th >cadastrado em:</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
      <?php foreach ($usuarios as $usuario) : ?>
    <tbody>
      <tr>
          <td class="text-left text-uppercase">
            <?php echo $usuario['nome'] ?>
          </td>
          <td class="text-left text-uppercase">
            <?php echo $usuario['nome_orgao'] ?>
          </td>
          <td class="text-left text-uppercase">
            <?php echo $usuario['name'] ?>
          </td>
          <td class="text-left text-uppercase">
            <?php echo $usuario['cid_nome'] ?>
          </td>
          <td class="text-left">
            <?php $cidade= $usuario['destinos']?>
            <?php foreach ($cidade as $city) : ?>
              <?php echo $city['cid_nome'] ?>
              <?php endforeach ?>
          </td>
          <td>
            <?php echo date('d/m/Y', strtotime( $usuario['created_at'])) ?>
          </td>
          <td >
            <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdCargo')."/".$usuario['id_user'] ?>"target="_blank">DETALHES
            </a> 
          </td>
      </tr>
          <?php endforeach ?> 
          <?php endif ?>
      </div>
    </tbody>
  </table>
  <div class="text-center">
  <?= $pager->links('default','bootstrap_pager') ?>
  </div>
</div>
<script src="/assets/js/orgao.js"></script>