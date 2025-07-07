<!-- PÁGINA NÃO OPERACIONAL -->
<?php echo view('UserAdmin/_common/header')?>
<div class="card  ">
    <div class="card-header">
    <p class="text-center text-uppercase pt-5"><strong> Pesquisa por Cidades </strong></p> 
    </div>
    <div class="conteiner border ">
        <div class="card-body col-sm-4 m-auto">
        <form action="<?php echo base_url('UserAdmin/Cidade/finalizaBusca') ?>", method="get">
                <div class="form-group">
                    <label for="estado">Selecione o Estado</label>
                    <input type="text" value="<?php echo $buscaEstadoById[0]['estado_nome'] ?> " class= "form-control" >
                    
                </div>
                <div class="form-group">
                    <label for="cidade" class="alert-danger">Selecione a Cidade</label>
                    <?php echo form_dropdown('cidade',
                    $formDropCidade,null,['class'=>'form-control']) ?>
                    
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
                    <div class="form-group">
                        ordenar por:
                        <div>
                        <input type="radio" id="created_at" name="indice" value="usuarios.created_at" checked>
                            <label for="data">data do cadastro</label>
                            <input type="radio" id="indice" name="indice" value="cargo.nome_cargo">
                            <label for="cargo">Cargo</label>
                            <input type="radio" id="indice" name="indice" value="usuarios.cidade_origem">
                            <label for="cidade">Cidade de Origem</label>
                </div>
                </div>
                
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Pesquisar">
                </div>
        </form>
        </div>
    </div>
</div>