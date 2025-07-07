<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class="text-center text-uppercase my-3"><h3> <?php if (!empty($usuarios)):?>
         <p> Sugestões de Triangulação considerando os usuários que tem interesse em ir para a sua <span class="text-primary">cidade de origem  e <?php echo $usuarios[0]['nome_orgao'] ?></span></h3></p>
    <?php endif?>
    <div class="text-center text-uppercase my-3"><h3> <?php if (empty($usuarios)):?>
         <p> Nenhuma sugestão encontrada para <span class="text-primary"> <?php echo $origem[0]['cid_nome'] ?> e seu órgão</span></h3></p>
    <?php endif?>
    
    </div>
    <table class="table table-striped table-bordered  my-5">
        <div class="container">
            <?php if(!empty($usuarios)): ?>
                    <tr class="text-left">
                        <th >nome </th>
                        <th >cargo </th>
                        <th >área </th>
                        <th >origem</th>
                        <th>cadastrado em:</th>
                    </tr>
                    <?php foreach($usuarios as  $destino):?>                        
                            <?php ?>
                    <tr>
                        <td class="text-left text-uppercase"><?php echo $destino['nome'] ?></td>
                        <td class="text-left text-uppercase"><?php echo $destino['nome_cargo'] ?></td>
                        <td class="text-left text-uppercase"><?php echo $destino['name'] ?></td>
                        <td class="text-left text-uppercase"><?php echo $destino['cid_nome'] ?></td>
                        <td><?php echo date('d/m/Y', strtotime($destino['created'])) ?></td>
                        <td class="text-left"> <a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioByIdTriangulacao')."/".$destino['id_user'] ?>"target="_blank">  DETALHES
                        </a></br> </td>
                    </tr>
                    <?php endforeach ?>
            <?php endif ?>        
        </div>
    </table>
    <?= $pager->links('default','bootstrap_pager') ?>
</div>