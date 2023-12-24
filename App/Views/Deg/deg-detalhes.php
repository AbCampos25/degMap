<?php

if (!verificar::logado()) {

      ?>
      <header>
        <div class="nav1">
            <div class="logo"><a href="<?=URL?>"> <i class="fa fa-home"></i> voltar</a></div>
            <nav> <a href="<?=URL?>/usuarioController/subscrever"><li>subscrever</li></a> <a href="<?=URL?>/usuarioController/login"><li>login</li></a> </nav>
        </div>
     </header>
      <?php
   }
   else {
      ?>
    <header>
        <div class="nav1">
            <div class="logo">degMap</div>
            <nav> <a href="<?=URL?>/usuarioController/perfil/<?=isset($_SESSION['id_admin'])?$_SESSION['id_admin']:$_SESSION['id_comum']?>"><li><i class="fa fa-user"></i></li></a> <a href="<?=URL?>/usuarioController/logout"><li>sair</li></a></nav>
        </div>
        <div class="nav2">
            <a href="<?=URL?>/paginasController" ><i class="fa fa-home"></i> Home</a>
            <a href="<?=URL?>/paginasController/mapa"><i class="fa fa-map"></i> Mapa</a>
            <a href="<?=URL?>/degController/cadastrar"><i class="fa fa-camera"></i> Registar</a>
        </div>
    </header>
  
  <?php
   
  }

  $deg=$dados['deg'];
  $capa=$dados['capa'];
  ?>
    <section class="conteudo">
        <div class="lista-deg">
            <div class="deg">
                <div class="capa" style="background-image: url(<?=URL?>/Public/Img/<?=$capa->nome?>);">
                    <div class="capa-titulo">
                        <h2><?=$deg->nome?></h2>
                    </div>
                </div>
                <?php
                    if (verificar::logado()) {
                        if (isset($_SESSION['id_admin']) || isset($_SESSION['id_comum']) && $_SESSION['id_comum']==$deg->fk_usuario_id) {
                            ?>
                                 <a href="<?=URL?>/degController/Editar/<?=$deg->id?>"><button>Editar</button> </a>
                            <?php
                        }
                    }

                ?>
               
            </div>
        </div>
        <div class="detalhes">
            <p> <?=$deg->descricao?> </p>
            <h5>Comuna: <span><?=$deg->comuna?></span></h5>
            <h5>Bairro: <span><?=$deg->bairro?></span></h5>
            <h5>Rua: <span><?=$deg->rua?></span></h5>
            <h5>Estado de degradação: <span><?=$deg->estado?></span></h5>
            <h5>Intervenção: <span><?=$deg->intervencao?></span></h5>
        </div>
        <?php
include   App.'/Views/Paginas/footer.php';
?> 
    </section>