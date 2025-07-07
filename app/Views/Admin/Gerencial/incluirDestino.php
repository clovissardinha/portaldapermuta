<?php echo view('Views/Admin/header') ?>
<div class="container col-md-8 m-auto">
    <div class="card text-center">
        <div class="card-header">
            <h3>Incluir Destino</h3>
        </div>
        <div class="card-body">
            <table class="table-striped ">
                <table-head>
                    <tr class="text-center">
                        <th>id</th>
                        <th>nome</th>
                        <th>origem</th>
                        <th>email</th>
                        <th>destino</th>
                    </tr>
                </table-head>
                <table-body>
                    <tr>
                        <td class="p-3"><?php echo $usuario[0]['id_user'] ?></td>
                        <td class="p-3"><?php echo $usuario[0]['nome'] ?></td>
                        <td class="p-3"><?php echo $usuario[0]['cid_nome'] ?></td>
                        <td class="p-3"><?php echo $usuario[0]['email'] ?></td>
                        <td class="p-3"><?php echo isset($destino[0]['cid_nome'])?$destino[0]['cid_nome']:''  ?></td>
                    </tr>
                </table-body>
            </table>
            <?php echo form_open('Admin/Gerencial/AlteraUsuario/incluiDestFinal') ?>
            <div class="form-group text-danger">
                    <p class="text-success"><?php echo isset($_SESSION['mensagem'])?$_SESSION['mensagem']:''?></p>
                    <label for="cidade">Escolha a Cidade de Destino</label>
                    <input type="text" class="form-control"id="cidade"   placeholder="Pesquisar cidade" onkeyup="carregar_cidade(this.value)">
                </div>
                    <span id="resultado_pesquisa"></span>
                
                <input type="hidden" name="id_inter" id="id_inter" value="<?php  echo $usuario[0]['id_user'] ?>">
                <input type="hidden" id="fk_cidade" name="fk_cidade">
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Cadastrar">
                </div>
            <?php echo form_close()?>
        </div>
    </div>
</div>
<script src="/assets/js/cidade.js"></script>