<?php echo view('UserAdmin/_common/header') ?>
<div class="container ml-auto">
  <div class="text-center text-uppercase my-3">
    <h3> Termo Pesquisado : <?php echo !empty($termo) ? $termo : 'Nenhum registro encontrado' ?>
      <h3 class="text-danger"><?php echo !empty($buscas) ? '' : 'Nenhum registro encontrado' ?></h3>
  </div>


  <table class="table table-striped table-bordered  my-5">
    <div class="container">
      <?php if (!empty($buscas)): ?>
        <tr class="text-left">
          <th>cidade origem</th>
          <th>cargo</th>
          <th>órgão</th>
          <th>área</th>
          <th>&nbsp</th>
        </tr>
        <?php foreach ($buscas as $busca) : ?>
          <tr>
            <td class="text-left text-uppercase"><?php echo $busca['cid_nome'] ?></td>
            <td class="text-left text-uppercase"><?php echo $busca['nome_cargo'] ?></td>
            <td class="text-left text-uppercase"><?php echo $busca['nome_orgao'] ?></td>
            <td class="text-left text-uppercase"><?php echo $busca['name'] ?></td>
            <td>
              <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdEstado') . "/" . $busca['id_user'] ?>" target="_blank">DETALHES
              </a>
            </td>
          </tr>
        <?php endforeach ?>
      <?php endif ?>
    </div>
  </table>
  <div class="text-center text-danger h4">
    <?php echo ($quantidade >100 )? $quantidade. " resultados foram encontrados e apenas 100 foram mostrados. Refine sua pesquisa":'' ?>
  </div>
</div>
<script src="/assets/js/searc.js"></script>