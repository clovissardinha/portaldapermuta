<?php echo view('Views/Admin/header')?>

<div class="conteiner col-md-8 m-auto">
    <div class="text-center"><p class="text-danger"><?php echo($user)?'': "USUÁRIO NÃO ENCONTRADO" ?></p>
    </div>
   
         <H5 class="text-center">PESQUISA DE USUÁRIOS</H3>
        <table class="table table-striped">
        
            <thead>
            <tr>
                <th>Nome</th>
                <th>ID</th>
                <th>E-email</th>
                <th>E-mail alternativo</th>
                <th>Cadastrado em</th>
                <th>Cadastro ativado</th>
                <th>Ativo</th>
                <th>Plus</th>
                <th coldspan="2"></th>
            </tr>
            </thead> 
            <?php foreach($user as $key=>$usuario): ?>
            <tbody>
            <tr>
            <td ><?php echo $user[$key]['nome'] ?></td> 
            <td ><?php echo $user[$key]['id_user'] ?></td> 
            <td ><?php echo $user[$key]['email']?></td> 
            <td ><?php echo $user[$key]['email_alternativo'] ?></td>
            <td ><?php echo $user[$key]['created_at'] ?></td>
            <td ><?php echo $user[$key]['cadastro_ativado']==1?"Sim":'Não' ?></td>
            <td ><?php echo $user[$key]['ativo']==1?"Sim":'Não' ?></td> 
            <td ><?php echo $user[$key]['plus']==1?"Sim":'Não' ?></td> 
            <td><a href="<?php echo base_url('Admin/Gerencial/AlteraUsuario/alteraUsuario')."/".$user[$key]['id_user']?>">alterar</a></td>
            <td><a href="<?php echo base_url('Admin/Gerencial/AlteraUsuario/incluirDestino')."/".$user[$key]['id_user']?>">incluir destino</a></td>
        <td><a class="text-danger" href="<?php echo base_url('Admin/Gerencial/AlteraUsuario/excluirUser')."/".$user[$key]['id_user']?>">excluir</a></td>
            </tr>
        </tbody>
        <?php endforeach ?>
       </table>
        
       
    
</div>

