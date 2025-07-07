<?php if(isset($usuarios,$pager)):?>
<?php echo view('Views/Admin/header')?>
<div class="container col-md-10 text-center">
<div class="table">
    <div class="table-header mb-3">
        <h3>LISTAGEM DE CADASTRADOS INATIVOS</h3>
    </div>
    <table class="table table-striped">
    <thead class="text-left">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>fone</th>
        <th>email_alternativo</th>
        <th>cadastro ativado</th>
        <th>ativo</th>
        <th>Cadastrado em:</th>

      </tr>
    </thead>
    <tbody class="text-left">
     
        <?php foreach($usuarios as $key=>$usuario): ?>
          <tr>
        <td><?php echo $usuario['id_user'] ?></td>
        <td><?php echo $usuario['nome'] ?></td>
        <td><?php echo $usuario['email'] ?></td>
        <td><?php echo $usuario['fone'] ?></td>
        <td><?php echo $usuario['email_alternativo'] ?></td>
        <td><?php echo $usuario['cadastro_ativado'] ?></td>
        <td><?php echo $usuario['ativo'] ?></td>
        <td><?php echo date('d/m/Y', strtotime($usuario['created_at'])) ?></td>
        
      </tr>
       <?php endforeach ?>
    
    </tbody>
  </table>
  <?= $pager->links('default','bootstrap_pager') ?>
</div>
</div>
<?php endif?>
