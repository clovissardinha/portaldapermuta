<?php echo view('UserAdmin/_common/header')?>
<div class="card  ">
    <div class="card-header">
    <p class="text-center text-uppercase pt-5"><strong> Pesquisa por Estado </strong></p> 
    </div>
    <div class="conteiner border ">
        <div class="card-body col-sm-4 m-auto">
            <form action="<?php echo base_url('UserAdmin/PesquisaEstado/buscarEstado')?>" method='get'  ?>
                <div class="form-group">
                    <label for="cargo">Escolha o estado a pesquisar:</label>
                    <?php echo form_dropdown('estado',
                    $formDropEstado,null,['class'=>'form-control']) ?>
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
                        ordenar por:
                        <div>
                        <input type="radio" id="usuarios.created_at" name="indice" value="usuarios.created_at"checked >
                            <label for="dez">data do cadastro</label>
                            <input type="radio" id="indice" name="indice" value="cargo.id_cargos">
                            <label for="cinquenta">Cargo</label>
                            <input type="radio" id="indice" name="indice" value="usuarios.cidade_origem">
                            <label for="indice">Cidade de Origem</label>
                </div>
                
                <div class="form-group">
                <button type="submit" class="btn btn-primary mt-2" onclick="load()" id="press">Enviar</button>
                <button class="btn btn-primary mt-2" type="button" disabled id="spinner">
                    <span class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">Loading...</span>
                </button>
                </div>
            </form>
        </div>
    </div>
    <script>
    document.getElementById("spinner").style.display = 'none';
    
    function load() {
        
        document.getElementById("press").style.display='none';
        document.getElementById("spinner").style.display='inline';

        setTimeout(function(){
                document.getElementById("press").style.display='inline';
                document.getElementById("spinner").style.display='none';
            },2000);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>