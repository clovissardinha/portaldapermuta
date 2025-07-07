<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
  <div class="text-center text-uppercase my-3">
      <h3> Orgão Pesquisado :  <?php echo !empty($orgaos[0]['nome_orgao'])? $orgaos[0]['nome_orgao'] :'Nenhum registro encontrado' ?></h3>
  </div>
  <div class="text-left">    
      <form class="form-inline my-4  " action="<?php echo base_url('UserAdmin/PesquisaOrgao/buscarOrgao') ?>", method="get">
        <label for="cargo"><h4>Filtrar por cargo:</h4></label>
        <label for="cargo"></label>
        <input type="text" class="form-control" id="cargo" placeholder="Pesquisar cargo - digite parte do nome" onkeyup="carregar_cargo(this.value)">
        <input type="hidden" name="paginas" value="<?php echo $paginas?>">
        <input type="hidden" name="fk_orgao" value="<?php echo $fk_orgao?>">
        <input type="hidden" id="fk_cargo" name="fk_cargo"> 
        <input type="hidden" name="indice" value="<?php echo $indice?>">
        <input class="ml-3 btn btn-primary" type="submit" class="btn btn-primary" value="Pesquisar">
      </form>
      <span id="resultado_pesquisa"></span>
    </div>
    <table class="table table-striped table-bordered  my-5">
    <?php if(!empty($orgaos[0]['nome_orgao'])): ?>
      <thead>
        <tr class="text-left">
          <th >nome</th>
          <th >cargo</th>
          <th >área</th>
          <th>origem</th>
          <th >destino</th>
          <th >cadastrado em:</th>
        </tr>
      </thead>
      <?php foreach ($orgaos as $orgao) : ?>
        <tbody>
          <tr>
            <td class="text-left text-uppercase"><?php echo $orgao['nome'] ?></td>
            <td class="text-left"><?php echo $orgao['nome_cargo']  ?></td>
            <td class="text-left"><?php echo $orgao['name']  ?></td>
            <td class="text-left"><?php echo $orgao['cid_nome']  ?></td>
            <td class="text-left"><?php foreach($orgao['id_user'] as $key=>$cidade):?>
              <?php echo $cidade['cid_nome']  ?> <?php endforeach ?></td>
            <td><?php echo date('d/m/Y', strtotime( $orgao['created_at'])) ?></td>
            <td class="link">
                <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdOrgao')."/".$orgao['usuario_id'] ?>" target="_blank">DETALHES
                </a>
            </td>
          </tr>
        </tbody>
      <?php endforeach ?>
  <?php endif ?>
    </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
<script src="/assets/js/cargo.js"></script>