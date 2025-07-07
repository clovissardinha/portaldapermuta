<?php echo view('UserAdmin/_common/header')?>
<div class="container col-sm-10 ">
	<table class="table  table-striped col-sm-10 m-auto ">
	<table-header>
				<tr>
				<td ><button class="btn btn-danger " id="botao"
							onclick="window.close()"> <strong>FECHAR</strong></button>
				</td>
				<td colspan="4" class="text-center text-uppercase bg-light text-black"><h3> DETALHES </h3></td>
				</tr>
	</table-header>
			<table-body">
						<tr>
							<th><label for="nome">Nome</label></th>
							<td class="text-uppercase"><?php echo $usuarios[0]['nome'] ?></td>
						</tr>
						
						<tr>
							<th><label for="cidade">Cidade atual</th>
							<td><?php echo $usuarios[0]['cid_nome'] .'-'.$usuarios[0]['cid_uf']?></td>
						</tr>
						<tr>
							<th><label for="cargo">Órgão</th>
							<td><?php echo $usuarios[0]['nome_orgao'] ?></td>
						</tr>
						<tr>
							<th><label for="cargo">Cargo ou função</th>
							<td><?php echo $usuarios[0]['nome_cargo'] ?></td>
						</tr>
						<tr>
							<th><label for="area">Área</th>
							<td><?php echo $usuarios[0]['name'] ?></td>
						</tr>
						<tr>
							<th><label for="email">E-mail</th>
							<td><?php echo $usuarios[0]['email'] ?></td>
						</tr>
						<tr>
							<th><label for="email">E-mail alternativo</th>
							<td><?php echo $usuarios[0]['email_alternativo'] ?></td>
						</tr>
						<tr>	
							<th><label for="telefone">Telefone</th>
							<td><?php echo $usuarios[0]['fone'] ?></td>
						</tr>
						<tr>
							<th><label for="celular">Celular</th>
							<td><?php echo $usuarios[0]['celular'] ?></td>
						</tr>
						<tr>
							<th><label for="mural">Mural</th>
							<td><?php echo $usuarios[0]['comentario'] ?></td>
						</tr>
						<tr>
							<th ><label for="destino">Destino</th>
						
							<td><?php	foreach($destino as $i){ ?><?php echo $i['cid_nome']." - ".$i['cid_uf'] ?>	<?php	} ?></td>
						</tr>
						<tr>
							<th><label for="cadastro">Cadastrado em:</th>
							<td><?php echo date('d/m/Y', strtotime( $usuarios[0]['created_at'])) ?></td>
						</tr>
						<tr colspan="2" class="between">
							<?php echo form_open('Contato/formConfimaContato') ?>
							<input type="hidden" name="nome" id="nome" value="<?php echo $usuarios[0]['nome'] ?>">
							<input type="hidden" name="email" id="email" value="<?php echo $usuarios[0]['email'] ?>" >
							<input type="hidden" name="id_user" id="id_user" value="<?php echo $usuarios[0]['id_user'] ?>" >
							<input type="hidden" name="orgao" id="orgao" value="<?php echo $usuarios[0]['nome_orgao'] ?>" >
							<input type="hidden" name="cargo" id="cargo" value="<?php echo $usuarios[0]['nome_cargo'] ?>" >
							<input type="hidden" name="cidade" id="cidade" value="<?php echo $usuarios[0]['cid_nome'] ?>" >
							<th ><button type="submit" class="btn btn-primary "><strong>CONTATO</strong></button>
							</th>
							<?php echo form_close()?>
						</tr>
					</div>
			</table-body>		
	</table>
</div>