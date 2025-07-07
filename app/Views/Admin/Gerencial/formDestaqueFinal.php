<?php echo view('Views/Admin/header')?>
<div class="container col-md-4 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Incluir o novo Destaque</h3>
        </div>
        <?php if($user):?>
        <div class="card-body">
                <div class="form-group p-2">
                    <span><p class="text-primary">email: <?php echo $user['email']?></p></span>
                    <span><p  class="text-primary">ID do usuário: <?php echo $user['id_user']?></p> </span>
                </div>
           <?php echo form_open('Admin/Gerencial/AlteraDestaque/saveDestaque')?>
                 <div class="text-left ">
                    <span class="text-danger"><?php echo isset($erro)?$erro:''?></span>
                <div class="form-group font-weight-bold">
                    <input type="hidden" name="id_user" value="<?php echo $user['id_user'] ?>">
                </div>
                <div class="form-group font-weight-bold">
                    <label for="data_ini ">Data pgto: </label>
                    <input  type="date" name="data_pgto" id="data_pgto"> <small id="data_ini" class="form-text text-muted">Data efetiva do pagamento do Destaque</small>
                </div>
               
                <div class="form-group font-weight-bold">
                    <label for="data_ini ">Data inicial: </label>
                    <input  type="date" name="data_inicial" id="data_inicial"> <small id="data_ini" class="form-text text-muted">Data inicial do Destaque </small>
                </div>
                <div class="form-group font-weight-bold ">
                    <label for="data_ini">Data final :  </label>
                    <input  type="date" name="data_final" id="data_final"  ><small id="data_fim" class="form-text text-muted">Data final do Destaque</small>
                </div>
                <div class="form-group font-weight-bold ">
                    <label for="data_ini">Tipo de Destaque:  </label>
                    <select name="tipo">
					        <option value=1  >Principal</option>
					        <option value=2  >Interno</option>
					</select>
                </div>
                <div class="form-group">
                    <input class="btn btn-danger " type="submit" value="CONFIRMAR"> 
                </div>
            </div>
            <?php echo form_close()?>
        </div>
        <?php endif ?>
      <p class="text-danger">  <?php echo !$user ? 'Verifique o email lançado': ''?></p>
    </div>
</div>