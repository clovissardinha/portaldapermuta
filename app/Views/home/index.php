<body>
    <div class="container">
        <div class="card mt-2">
            <div class="jumbotron">
                <h1 class=" text-center text-primary">PORTAL DA PERMUTA</h1>
            </div>
            <div class=" text-center text-danger border border-2">
                <?php if($destaques) :?>
                <h2>DESTAQUES DO PORTAL</h2>
                <?php endif ?>
            </div>
            <div class="row  ">
                <?php foreach ($destaques as $destaque): ?>
                    <div class="card-body bg-ligth min-height: 300px;">
                        <div class=" text-center ">
                            <p>
                            <h3 class="text-uppercase"><?php echo $destaque['nome']; ?></h3>
                            </p>
                            <p><?php echo $destaque['nome_orgao']; ?></p>
                            <p><?php echo $destaque['nome_cargo']; ?></p>
                            <p><?php echo $destaque['cid_nome']; ?></p>
                            <p><?php echo $destaque['cid_uf']; ?></p>
                            <p><a href="<?php echo base_url('Login') ?>">Detalhes</a> </p>
                            <hr>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="jumbotron">
                <h2 class=" text-center">PORQUÊ O PORTAL DA PERMUTA?</h2>
                <p class="text-center">Desde de 2012 o Portal da Permuta vem ajudando servidores federais, estaduais e municipais a conseguirem permuta entre cargos semelhantes. Veja mais:</p>
                <ul class="list-group alert-success font-weight-bold text-center">
                    <li class="list-group-item">Mais de 40 mil já se cadastraram</li>
                    <li class="list-group-item">Muitos casos de sucesso</li>
                    <li class="list-group-item">Totalmente gratuito</li>
                    <li class="list-group-item">Site seguro(https)</li>
                    <li class="list-group-item">Pesquisa automática e manual</li>
                    <li class="list-group-item">Sempre atualizado</li>
                </ul>
                <div class="jumbotron">
                    <h3 class=" text-center"><a href="<?php echo base_url('Cadastro') ?>">CADASTRE-SE</a></h3>
                </div>
            </div>
            <div class="text-center  img-responsive img-thumbnail m-4">
                <a href="https://youtu.be/hO-E3oQ-AfY" target="_blank"><img src="assets/imagens/apresentacaoyoutube.webp" alt="Portal da Permuta" width="650" height="366" class="img-thumbnail" loading="lazy"></a>
            </div>
        </div>
        <p class="bg-light text-center p-5">desde 2012 - Portal da Permuta - Você no lugar certo</p>
    </div>
    <?php echo view('_common/footer') ?>