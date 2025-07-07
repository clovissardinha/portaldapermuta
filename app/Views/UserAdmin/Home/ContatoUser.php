<?php echo $this->extend('UserAdmin/_common/header')?>
<?php echo $this->section('content')?>
<nav aria-label="breadcrumb ">
	<ol class="breadcrumb my-3">
		<li class="breadcrumb-item"><?php echo anchor("",'Home')?></li>
		<li class="breadcrumb-item active" aria-corrent="pag">Contato</li>
	</ol>
</nav>
<div class="text-success">
       <?php echo  isset($msg)?$msg:''?>
</div>
<div class="card ">
        <div class="card-header text-center">
            <p><strong>Contato com o Portal da Permuta</strong></p>
        </div>
        <div class="card-body">
              <div class="bg-warning text-center">
              <?php if(isset($validation)):?>
                     <?= $validation->listErrors(); ?>
              <?php endif ?></div>
       <?php echo form_open('UserAdmin/ContatoUser') ?>
       <div class="form-group col-sm-6">
              <label for="nome">Nome</label>
              <input type="text" name="nome" id="nome" value="<?php echo !empty($post['nome']) ? $post['nome'] :set_value('nome') ;?>" class="form-control" autofocus >
              
       </div>
       <div class="form-group col-sm-6">
              <label for="email">E-mail</label>
              <input type="email" name="email" id="email" value="<?php echo !empty($post['email']) ? $post['email'] :set_value('email') ;?>" class="form-control" autofocus >
       </div>
       <div class="form-group col-sm-6">
              <label for="assunto">Assunto</label>
              <select class="form-control" name="assunto">
                     <option>Escolha o assunto</option>
                     <option>Suporte</option>
                     <option>Comentário</option>
                     <option>Dúvidas</option>
                     <option>Incluir órgao</option>
                     <option>Incluir cargo</option>
               </select>
       </div>
       <div class="form-group col-sm-6">
              <label for="mensagem">Mensagem</label>
              <textarea class="form-control" name="mensagem" rows="3" ></textarea>
       </div>
       <div class="text-center">
              <div class="form-group col-sm-6">
              <button type="submit" class="btn btn-primary">Enviar</button>
              </div>
              <div class="card-body">
              <button class="btn btn-link"><a href="<?php echo base_url('UserAdmin/Home') ?>">Voltar</a></button>
              </div>
       </div>
       
      
       <?php echo form_close() ?>
        </div>
</div>
<?php echo $this->endsection('content')?>