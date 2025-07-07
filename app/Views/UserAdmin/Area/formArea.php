<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
<table class="table table-striped table-bordered  my-5">
    <tr>
    <td colspan="5" class="text-center text-uppercase"><h3> AREAS CADASTRADAS</h3></td>
    </tr>
    <div class="container">
      
        <tr class="text-left">
          <th >Area</th>
          <th ></th>
        </tr>
        <div class="text-danger bg-light text-center p-4 h-3 font-weight-bold">
          <?php if(empty($areas)) echo "Nenhuma área cadastrada. Use o botão abaixo para cadastrar."?> 
        </div>
        
        <?php if(isset($areas)) foreach($areas as $area):?>
        <tr>
            <td class="text-left text-uppercase"><?php echo $area['nome'];?></td>
            <td class="text-left "><a href="<?php echo base_url('UserAdmin/DadosArea/deletar')."/".$area['area_id']?>"class="btn btn-danger" role="button">Excluir</a></td>
        </tr> 
       <?php endforeach ?>
     
        <tr colspan="2" class="between">
        <?php if(!$areas):?>  
				<th  ><a class="btn btn-primary " href="<?php echo base_url('UserAdmin/DadosArea/cadastrar')?>"><strong>CADASTRAR MAIS</strong></a>
				</th>
        
        <?php endif ?>
				<th ><a class="btn btn-primary " href="<?php echo base_url('UserAdmin/DadosPessoais')?>"><strong>VOLTAR</strong></a><span class="ml-5">Para substituir exclua primeiro</span>
				</th>
				</tr>
        
    </div>
</table>
</div>