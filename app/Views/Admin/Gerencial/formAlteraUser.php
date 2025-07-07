<?php echo view('Views/Admin/header')?>
<div class="container col-md-6 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Altera Usuário</h3>
        </div>
        <div class="card-body text-left">
        <p class="text-uppercase text-primary"><?php if(isset($_SESSION['sucesso'])){echo $item = $_SESSION['sucesso'];}  ?></p>
        <p class="text-uppercase text-danger"><?php if(isset($_SESSION['item'])){echo $item = $_SESSION['item'];}  ?></p>
           <?php echo form_open('Admin/Gerencial/AlteraUsuario/alteraUserFinal')?>
         
                <div class="form-group ">                     
                    <label for="data_ini ">Nome</label>
                    <input type="text" name="nome" value="<?php echo $nome ?>">
                </div>  
                <div class="form-group ">        
                    <label for="apelido ">Apelido</label>
                    <input type="text" name="apelido" value="<?php echo $apelido ?>">
                </div>
                <div class="form-group ">    
                    <label for="email ">E-mail</label>
                    <input type="text" name="email"  class="bg-danger text-white" value="<?php echo $email ?>">
                </div>
                <div class="form-group">
                        <label for="comentario">Mural-Detalhes importantes</label>
                        <textarea name="comentario" id="comentario" row="3"maxlength="500"  class= "form-control textarea" value="<?php echo  $comentario?>" ><?php echo  $comentario?></textarea>
                        
                </div>
                <div class="form-group ">    
                <label for="ativo">Ativo:(atual:<?php echo $ativo==1?'Sim':'Não' ?>)  </label>
                    <select name="ativo">
                            <option value='' >Selecione...</option>
					        <option value=1  >Ativo</option>
					        <option value=0  >Suspenso</option>
					</select>
                </div>
                <input type="hidden" name="id_user" value="<?php echo $id_user ?>">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="hidden" name="id_mural" value="<?php echo $id_mural ?>">
                <div class="form-group">    
                    <button type="submit" class="btn btn-primary">Alterar</button>
                </div>
                <div class="btn    mr-3"><a href="http://portalv4/Admin/Login/retorno">INICIO</a>
            </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>