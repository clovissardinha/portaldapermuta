<?php echo view('Views/Admin/header')?>
<div class="card">
    <div class="card-header">
        <div class="text-center text-uppercase pt-5"><p><strong> Alerta usuário que não terminou cadastro </strong> </p></div>
    </div>
    <div class="conteiner border">
        <div class="card-body col-sm-4 m-auto">
        <form action="<?php echo base_url('Admin/Gerencial/EmailReforco/enviaReforco')?>" method="get" >
            <div class="text-center ">
                <div class="form-group font-weight-bold">
                    <label for="data_ini ">Data inicial: </label>
                    <input  type="date" name="data_inicial" id="data_inicial"> <small id="data_ini" class="form-text text-muted">Escolha a data inicial  </small>
                </div>
                <div class="form-group font-weight-bold ">
                    <label for="data_fimal">Data final :  </label>
                    <input  type="date" name="data_final" id="data_final"  ><small id="data_final" class="form-text text-muted">Escolha a data final </small>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary " type="submit" value="ENVIAR"> 
                </div>
            </div>
                
        </form>
        </div>
    </div>
    
</div>