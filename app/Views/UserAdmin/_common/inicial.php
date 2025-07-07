<div class="text-center clearfix ">
  <div>
    <?php if ($ativo == '0'): ?>
      <h4>Cadastro suspenso. saiba mais <a href="<?php echo
                                                  base_url('/Cadastro/suspenso') ?>">aqui</a></h4>
    <?php endif; ?>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="row col-sm-10 m-auto  ">
        <?php foreach ($destaques as $destaque): ?>
          <div class="card-body bg-ligth">
            <div class=" text-center ">
              <p>
              <h3 class="text-uppercase"><?php echo $destaque['nome']; ?></h3>
              </p>
              <p><?php echo $destaque['nome_orgao']; ?></p>
              <p><?php echo $destaque['nome_cargo']; ?></p>
              <p><?php echo $destaque['cid_nome']; ?></p>
              <p><?php echo $destaque['cid_uf']; ?></p>
              <p><a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioById') . "/" . $destaque['id_user'] ?>" target="_blank">DETALHES</a></p>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <div class="m-5">
        <h5><?php echo  "50 últimos cadastrados para : " . $cargos[0]['nome_cargo'] ?></h5>
        <a class="text-primary" href="<?php echo base_url('UserAdmin/PesquisaCargo/index') ?>">VEJA MAIS +</a>
        <table class="table table-striped table-bordered  my-5" id="orgaoTable">
          <thead>
            <div class="container">
              <div class="text-center"> <?php if (!empty($cargos[0]['nome_cargo'])): ?></div>
              <div class="text-center"> <?php !empty($cargos[0]['nome_cargo']) ? $cargos[0]['nome_cargo'] : '' ?></div>
              <tr class="text-left">
                <th>órgão</th>
                <th>nome</th>
                <th>origem</th>
                <th>cadastrado em:</th>
                <th>&nbsp;</th>
              </tr>
          </thead>
          <?php foreach ($cargos as $cargo) : ?>
            <?php if ($cargo['id_user'] != $id_user) : ?>
              <tbody>
                <tr>
                  <td class="text-left text-uppercase">
                    <?php echo $cargo['nome_orgao'] ?>
                  </td>
                  <td class="text-left text-uppercase">
                    <?php echo $cargo['nome'] ?>
                  </td>
                  <td class="text-left text-uppercase">
                    <?php echo $cargo['cid_nome'] . '/' . $cargo['cid_uf'] ?>
                  </td>
                  <td>
                    <?php echo date('d/m/Y', strtotime($cargo['created_at'])) ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdCargo') . "/" . $cargo['id_user'] ?>" target="_blank">DETALHES
                    </a>
                  </td>
                </tr>
              <?php endif ?>
            <?php endforeach ?>
          <?php endif ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>