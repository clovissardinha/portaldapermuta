<?php echo view('Views/Admin/header')?>
<div class="container col-md-4 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Alterar Destaque</h3>
        </div>
        <div class="card-body">
                <div class="form-group p-2">
                    <span><p class="text-primary">nome: <?php echo $nome?></p></span>
                   </span>
                </div>
           <?php echo form_open('Admin/Gerencial/AlteraDestaque/saveAlteraDestaque')?>
                 <div class="text-left ">
                    <span class="text-danger"><?php echo isset($_SESSION['erro'])?$_SESSION['erro']:'' ?></span>
                <div class="form-group font-weight-bold">
                    <input type="hidden" name="id_destaque" value="<?php echo $destaque['id_destaque'] ?>">
                </div>
                <div class="form-group font-weight-bold">
                    <label for="data_ini ">Data pgto: </label>
                    <input  type="date" name="data_pgto" id="data_pgto" value="<?php echo $destaque['data_pgto']?>"> <small id="data_ini" class="form-text text-muted">Data efetiva do pagamento do Destaque</small>
                </div>
               
                <div class="form-group font-weight-bold">
                    <label for="data_ini ">Data inicial: </label>
                    <input  type="date" name="data_inicial" id="data_inicial" value="<?php echo $destaque['data_inicio']?>"> <small id="data_ini" class="form-text text-muted">Data inicial do Destaque </small>
                </div>
                <div class="form-group font-weight-bold ">
                    <label for="data_ini">Data final :  </label>
                    <input  type="date" name="data_final" id="data_final" value="<?php echo $destaque['data_fim']?>" ><small id="data_fim" class="form-text text-muted">Data final do Destaque</small>
                </div>
                <div class="form-group font-weight-bold ">
                    <label for="tipo">Tipo de Destaque:  </label>
                    <select name="tipo">
                            <option value=''  >Selecione...</option>
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
    </div>
</div>