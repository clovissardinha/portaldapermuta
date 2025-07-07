<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
  <div class="text-center text-uppercase my-3">
      <div ><h3> Origem dos Usuarios Pesquisados:  <?php echo !empty($usuarios[0]['cid_nome'])? $usuarios[0]['cid_nome']."-".$usuarios[0]['cid_uf'] :'Nenhum registro encontrado' ?></h3></div>
  </div>  
      <div class="text-left">    
        <form class="form-inline my-4  " action="<?php echo base_url('UserAdmin/Cidade/finalizaBusca') ?>", method="get">
          <div class="form-group">
                                  <label  for="cargo">Cargo</label>
                                  <input type="text" class="form-control" id="cargo" placeholder="Pesquisar cargo" onkeyup="carregar_cargo(this.value)">
                                  <input type="hidden" id="fk_cargo" name="fk_cargo" > 
                                  <input type="hidden" id="fk_cidade" name="fk_cidade" value="<?php echo $cidade?>"> 
                                  <input type="hidden" id="paginas" name="paginas" value="<?php echo $paginas?>">
                                  <input type="hidden" id="indice" name="indice" value="<?php echo $indice?>"> 
                                  <input class="ml-3 btn btn-primary" type="submit" class="btn btn-primary" value="Pesquisar">
                      </div>
          </div>
        </form>
        <span id="resultado_pesquisa"></span>
      <table class="table table-striped table-bordered  my-5 table-responsive" id="cargoTable">
          <div class="container">
            <?php if(!empty($usuarios[0]['cid_nome'])): ?>
              <tr class="text-left">
                <th >nome</th>
                <th >órgão</th>
                <th >cargo</th>
                <th>área</th>
                <th >destino</th>
                <th >cadastrado em:</th>
              </tr>
              <?php foreach ($usuarios as $usuario) : ?>
                
              <tr>
                  <td class="text-left text-uppercase"><?php echo $usuario['nome'] ?></td>
                  <td class="text-left"><?php echo $usuario['nome_orgao']  ?></td>
                  <td class="text-left"><?php echo $usuario['nome_cargo']  ?></td>
                  <td class="text-left"><?php echo isset($usuario['name'])?$usuario['name']:'';  ?></td>
                    
                  <td class="text-left"><?php foreach($usuario['destinos'] as $key=>$cidade):?><?php echo $cidade['cid_nome']  ?> <?php endforeach ?></td>
                  
                  <td><?php echo date('d/m/Y', strtotime( $usuario['created_at'])) ?></td>
                  <td align="left"><a href="<?php echo base_url('UserAdmin/Usuario/getUsuarioById')."/".$usuario['id_user'] ?>"target="_blank">DETALHES</a></td>
              </tr>
              <?php endforeach ?>
              <?php endif ?>
          </div>
      </table>
      <div class="text-center">
         <?= $pager->links('default','bootstrap_pager') ?>
      </div>
  </div>
  <script src="/assets/js/cargo.js"></script>