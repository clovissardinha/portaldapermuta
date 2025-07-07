<!DOCTYPE html>
<html lang="pt_br">
<head>
<meta charset="utf-8">
	
</head>
<body>

<div class="alert alert-primary" role="alert">
  olá <?php echo $nome ; ?>,<br>
  
  O(A) colega <b></b> <?php echo $nome_user;?></b> quer falar com você,<br>
  
  </b> O e-mail dele(a) é:<?php echo $email; ?>.<br>
  
  <?php if($telefone==TRUE) {?>
  Seu telefone é:<?php echo $telefone?>
  <?php }?>
  
  <?php if ($mensagem ==TRUE){?>
  <br>Ele(a) mandou a seguinte mensagem:<?php echo $mensagem?>
	<?php }?><br>
	<div text-danger >
	<br >ATENÇÃO:NÃO RESPONDA ESTE E-MAIL <br> 
	LIGUE OU MANDE E-MAIL PARA O ENDEREÇO DE E-MAIL ACIMA.
	</div>
</div>
