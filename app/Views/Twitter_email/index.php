<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <link rel="canonical" href="https://www.portaldapermuta.com/Twitter_email" />
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-MN5DHM0DXL"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-MN5DHM0DXL');
    </script>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3918009181921323"
     crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novos cadastrados</title>   
    <script src="<?php echo base_url('assets/jquery/jquery-3.5.1.min.js') ?>"></script>
    <?php echo link_tag('assets/bootstrap/css/bootstrap.min.css') ?>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    
    
    <style>
        .logo_site {
            height: 50px;
            margin: 0;
        }
    </style>
    <script>
        var base_url = "<?php echo base_url() ?>";
    </script>
</head>
<div class="body">
  <div class="container col-md-8 text-center">
        <div class="text-center m-2 bg-secondary text-white p-2" ><h1>Destaques da Semana</h1></div>
        <div class="text-center">
        <a href="<?php echo base_url('Login')?>" class="navbar-brand"> <img  src="<?php echo base_url('assets/imagens/logo_portal.webp')?>" height="60" width="60" class="img-thumbnail m-4" alt="Destaque"></a>
        </div>
      </img>
    <div class="table">
    <div class="table-header mb-3">
        <h3>Cadastrados no Portal da Permuta nos últimos dias</h3>
    </div>
      <table class="table table-striped">
        <thead class="text-left">
        <tr>
          <th>Cargo</th>
          <th>Órgão</th>
          <th>Cidade de Origem</th>
          <th>Data de inscrição</th>
          <th>Data de atualização</th>
        </tr>
        </thead>
        <tbody class="text-left">
          <?php foreach($novos as $key=>$user): ?>
        <tr>
          <td><?php echo $user['nome_cargo'] ?></td>
          <td><?php echo $user['nome_orgao'] ?></td>
          <td><?php echo $user['cid_nome']   ?></td>
          <td><?php echo date('d/m/Y', strtotime($user['created_at_usuarios'])) ?></td>
          <td><?php echo date('d/m/Y', strtotime($user['updated_at_usuarios'])) ?></td>
        </tr>
        <?php endforeach ?>
        </tbody>
      </table>
      <div class="mt-3 mb-3">Vejam mais em: <a href="https://www.portaldapermuta.com">Portal da Permuta</a> </div>
     <!--  <div class="bg-dark text-white p-3"> Se você está recebendo este e-mail você foi ou é cadastrado no Portal da Permuta. Caso não queira mais receber nossos e-mails clique aqui:</div> -->
    </div>
  </div>
</div>
</html>