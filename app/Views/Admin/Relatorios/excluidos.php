<?php echo view('Views/Admin/header')?>
<div class="container col-md-8 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>Motivo de Exclusão do Cadastro</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Motivo</th>
        <th>Critica</th>
        <th>Indicação</th>
        <th>Data de inscrição</th>
        <th>Data de exclusão</th>

      </tr>
    </thead>
    <tbody class="text-left">
        <?php foreach($excluidos as $key=>$excluido): ?>
      <tr>
        <td><?php echo $excluido['id_exclusao'] ?></td>
        <td><?php echo $excluido['nome'] ?></td>
        <td><?php echo $excluido['email']   ?></td>
        <td><?php if ( $excluido['motivo']==1){ echo "Consegui permuta pelo Portal";} else if( $excluido['motivo']==2){echo "Desisti da Permuta";}  else if( $excluido['motivo']== 3){echo "Entrei por curiosidade";} else if( $excluido['motivo']==4){echo "Outro motivo";} else if( $excluido['motivo']==5){echo "Consegui a permuta";}?></td>
        <td><?php echo $excluido['critica']   ?></td>
        <td><?php echo $excluido['indicacao']==1 ? "SIM" : "NÃO"?></td>
        <td><?php echo date('d/m/Y', strtotime($excluido['data_inscricao'])) ?></td>
        <td><?php echo date('d/m/Y', strtotime($excluido['data_exclusao'])) ?></td>
      </tr>
       <?php endforeach ?>
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>