<?php echo view('Views/Admin/header')?>
<div class="container col-md-4">
    <div class="card">
        <div class="card-header">
            <h3 class="text-danger text-uppercase">CONFIRMAR EXCLUSÃO DE DESTAQUE</h3>
        </div>
        <div class="card-body">
            <P class="text-uppercase"><?php echo $nome ?></P>
            <P class="text-uppercase">Data inicial: <?php echo date('d/m/Y', strtotime($destaque['data_inicio'])) ?></P>
            <P class="text-uppercase">Data final: <?php echo date('d/m/Y', strtotime($destaque['data_fim'])) ?></P>
            <P class="text-uppercase">Tipo: <?php echo  $destaque['tipo']==1?"PRINCIPAL":'INTERNO' ?></P>
        </div>
        <?php echo form_open('Admin/Gerencial/AlteraDestaque/excluirDestaqueFinal') ?>
        <div class="text-center">
            <input type="hidden" name="id_destaque" value="<?php echo $destaque['id_destaque'] ?>">
             <input class="btn btn-danger " type="submit" value="EXCLUIR !!!!"> 
        </div>
        <?php echo form_close() ?>
    </div>
</div>
