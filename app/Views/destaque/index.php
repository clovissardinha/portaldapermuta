<body mb-5>
    <div class="container">
        <div class="container" role="main">
            <?php echo $this->renderSection('content') ?>
        </div>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><?php echo anchor("", 'Home') ?></li>
                    <li class="breadcrumb-item active" aria-corrent="pag">Destaques</li>
                </ol>
            </nav>
            <div class="row no-gutters d-flex justify-content-center justify-content-sm-between">

                <p class="text-center">
                <h1>CONTRATAÇÃO DE DESTAQUE NO PORTAL DA PERMUTA</h1>
                </p>
                <p class="text-justify"><strong> Destaque na página inicial após login</strong></p>
                <p class="text-justify">Você ficará, <strong>por 30 (trinta) dias</strong>,
                    na página inicial após login.Todos os cadastrados verão você em primeiro lugar,
                    sem precisar pesquisar. Anúncio fixo. O custo, por período de 30 dias, é de <strong> R$ 20,00</strong>.
                    O pagamento poderá ser feito através do PagSeguro ou PayPal, através de boleto bancário
                    ou cartão de credito. É só clicar no botão do PagSeguro ou PayPal abaixo. </p>
            </div>
            <div class="row no-gutters d-flex justify-content-center justify-content-sm-between">

                <!--INICIO DOS BOTÕES DE PAGAMENTO destaque 20 reais -->

                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick">
                    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
			">
                    <input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
                    <img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
                </form>

                <!-- FIM FORMULARIO BOTAO PAY-PAL -->
                <!-- INICIO FORMULARIO BOTAO PAGSEGURO 20 reais -->
                <form action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
                    <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                    <input type="hidden" name="code" value="6D49E04F9595E8C004348F96AAB3848E" />
                    <input type="hidden" name="iot" value="button" />
                    <input type="image" src="https://stc.pagseguro.uol.com.br/public/img/botoes/pagamentos/120x53-comprar.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
                </form>
                <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
            </div>
    
            <div class="row no-gutters d-flex justify-content-center justify-content-sm-between mt-3">
                <p class="text-justify"><strong>IMPORTANTE</strong></p>
                <p class="text-justify">Colocação no site é imediatamente após a confirmação de pagamento. Seguiremos sempre a ordem cronológica de pagamento. Você pode desistir da contratação, desde que ela não tenha sido veiculada há mais de 3 dias, e ter o reembolso do valor pago, descontadas as taxas cobradas pelo PagSeguro ou PayPal.
                    Qualquer dúvida entre em <a href="<?php echo base_url('Contato'); ?>">contato.</a> </p>
            </div>
        </div>
        <?php echo view('_common/footer') ?>