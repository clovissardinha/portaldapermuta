<?php echo view('UserAdmin/_common/header')?>
<div class="container ml-auto">
    <div class=" card">
        <div class="card-header text-center">
        <div class="bg bg-light border border-secundary rounded ">
            <h2 class="">SUA FOTO DO PERFIL</h2></div>
        </div>
        <div class="card-body">
                <h4>Escolha uma boa foto</h4> (menos de 1mb e menor que 2000*2000 px) 
                <?php if(session()->has('errors')):?>
                    <p class="text-danger"><?php echo session()->get('errors')['userfile']; ?></p>
                <?php endif ?> 
                <?php if(session()->has('uploaded')):?>
                    <p class="text-success"><?php echo session()->get('uploaded'); ?></p>
                <?php endif ?>  
                <?= form_open_multipart('UserAdmin/DadosPessoais/storeFoto') ?>
                <input type="file" name="userfile" class="form-control-file"> 
                <div class="between">
                    <button class="my-3 btn btn-success mr-5" type="submit" >Upload</button>
                    <button"><a class="btn btn-primary ml-5 " href="<?php echo base_url('UserAdmin/Home')?>"><strong>VOLTAR</strong></a></button>
                </div>
                
                </form>
        </div>
    </div>
</div>