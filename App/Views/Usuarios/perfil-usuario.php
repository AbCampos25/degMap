<?php
if (!verificar::logado()) {
    url::redireciona('PaginasController');
}
$usuario=$dados['usuario'];
?>
<header>
        <div class="nav1">
            <div class="logo">degMap</div>
            <nav> <a href="#"><li></li></a> <a href="<?=URL?>/usuarioController/logout"><li>sair</li></a></nav>
        </div>
        <div class="nav2">
            <a href="<?=URL?>/paginasController" ><i class="fa fa-home"></i> Home</a>
            <a href="<?=URL?>/paginasController/mapa"><i class="fa fa-map"></i> Mapa</a>
            <a href="<?=URL?>/degController/cadastrar"><i class="fa fa-camera"></i> Registar</a>
        </div>
    </header>
<section class="conteudo">
        <h1>
        </h1>
        <div class="lista-deg">
            <div class="deg">
                <div class="usuario-icon"><i class="fa fa-user"></i></div>
            </div>
        </div>
        <div class="detalhes">
            <h5>Nome: <span><?=$usuario->nome?></span></h5>
            <h5>E-mail: <span><?=$usuario->email?></span></h5>
            <h5>Telefone: <span><?=$usuario->telefone?></span></h5>
        </div>
        <div class="lista-deg">
        <?php
            $degs=$dados['degs'];
            $imagens=$dados['imagens'];
            foreach ($degs as $deg) {
                ?> 
            <div class="deg">
                <div class="capa " style="background-image: url(<?=URL?>/Public/Img/<?=$imagens[$deg->id]->nome?>);">
                    <div class="capa-titulo">
                        <h2><?=$deg->nome?></h2>
                    </div>
                </div>
                <p style="font-size: 10pt; text-align:center; margin: 5px auto; color: rgb(20,20,20);"><?=$deg->data_registo?></p>
                <a href="<?=URL?>/degController/detalhes/<?=$deg->id?>"> <button>Ver Detalhes</button> </a>
            </div>
                <?php
            }
   
         ?>
           
        </div>
        <?php
include   App.'/Views/Paginas/footer.php';
?> 
    </section>