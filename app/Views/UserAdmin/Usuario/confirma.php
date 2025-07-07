<?php echo view('UserAdmin/_common/header')?>

	<div class="container col-sm-8 ">
		<div class="text-center">
			<h3>DETALHES DO ENVIO</h3>
		</div>
		<?php echo form_open('Contato/contatoEnviar')?>
		<table class="table  table-striped col-sm-10 m-auto ">
			
				<tr>
				<td colspan="7" class="text-center text-uppercase bg-light text-black"><h3> CONFIRME OS DADOS ANTES DE ENVIAR </h3></td>
				</tr>
			
			
				<div class="form-group">
					<label for="nome">Nome</label>
					<input type="input" class="form-control" name="nome"  value="<?php echo $nome ;?>" disabled>
				</div>
				<div class="form-group">
					<label for="nome">órgão </label>
					<input type="input" class="form-control" name="orgao"  value="<?php echo $orgao;?>" disabled>
				</div>
				<div class="form-group">
					<label for="nome">Função</label>
					<input type="input" class="form-control" name="funcao"  value="<?php echo $cargo?>" disabled>
				</div>
				<div class="form-group">
					<label for="nome">Cidade</label>
					<input type="input" class="form-control" name="cidade"  value="<?php echo $cidade ?>" disabled>
				</div>
				<div class="form-group">
					<label for="nome">email</label>
					<input type="input" class="form-control" name="email"  value="<?php echo $email;?>" disabled>
				</div>
				<div class="form-group">
					<label for="nome">Escreva algo para o seu colega</label>
					<textarea  class="form-control" name="mensagem"  value="" rows="3"></textarea>
				</div>
				<div class="form-group">
					<label for="nome">Seu telefone atual com DDD </label>
					<input type="input" class="form-control" name="telefone"  value="" ></input>
				</div>
			<div class=" custom-control-inline ">
				<div  >
					<input type="hidden" name="email"  value="<?php echo $email ?>" >
					<input type="hidden" name="nome"  value="<?php echo $nome; ?>" >
					<?php echo form_submit('enviar','Enviar', 'class="btn btn-primary"' ); ?>
				</div>
				<div class="ml-5" >
				<button class="btn btn-danger " id="botao"							onclick="window.close()"> <strong>FECHAR</strong></button>
				</div>
			</div>
		</table>				
		<?php echo form_close()?>	
	</div>		
			
