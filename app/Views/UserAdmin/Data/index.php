<?php echo view('UserAdmin/_common/header')?>
<div class="card">
    <div class="card-header">
        <div class="text-center text-uppercase pt-5"><p><strong> Busca por intervalo de data de cadastro</strong> </p></div>
        <div class="text-center text-uppercase pt-5"><p><strong><?php if( isset ( $erro )){echo $erro;} ?></strong> </p></div>
    </div>
    <div class="conteiner border">
        <div class="card-body col-sm-2 m-auto">
        <form action="<?php echo base_url('UserAdmin/PesquisaData/final')?>"  method="get"  >
            <div class="text-center ">
                <div class="form-group font-weight-bold">
                    <label for="data_ini ">Data inicial: </label>
                    <input  type="date" name="data_inicial" id="data_inicial"> <small id="data_ini" class="form-text text-muted">Escolha a data inicial de cadastramento para pesquisar </small>
                </div>
                <div class="form-group font-weight-bold ">
                    <label for="data_ini">Data final :  </label>
                    <input  type="date" name="data_final" id="data_final"  ><small id="data_fim" class="form-text text-muted">Escolha a data final de cadastramento para pesquisar</small>
                </div>
                <div class="form-group">
                    número de resultados por página:
                    <div>
                    <input type="radio" id="paginas" name="paginas" value="10" checked>
                        <label for="dez">10</label>
                        <input type="radio" id="paginas" name="paginas" value="50">
                        <label for="cinquenta">50</label>
                        <input type="radio" id="paginas" name="paginas" value="100">
                        <label for="paginas">100</label>
                    </div>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary " type="submit" value="Pesquisar"> 
                </div>
            </div>
             
        </form>
        </div>
    </div>
    
</div>