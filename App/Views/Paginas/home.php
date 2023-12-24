<?php

if (!verificar::logado()) {

      ?>
      <header>
        <div class="nav1">
            <div class="logo"><?=App_name?></div>
            <nav> <a href="<?=URL?>/usuarioController/subscrever"><li>subscrever</li></a> <a href="<?=URL?>/usuarioController/login"><li>login</li></a> </nav>
        </div>
     </header>
      <?php
   }
   else {
      ?>
      <header>
      <div class="nav1">
          <div class="logo"><?=App_name?></div>
          <nav> <a href="<?=URL?>/usuarioController/perfil/<?=isset($_SESSION['id_admin'])?$_SESSION['id_admin']:$_SESSION['id_comum']?>"><li><i class="fa fa-user"></i></li></a> <a href="<?=URL?>/usuarioController/logout"><li>sair</li></a></nav>
      </div>
      <div class="nav2">
          <a href="" class="activo"><i class="fa fa-home"></i> Home</a>
          <a href="<?=URL?>/paginasController/mapa"> <i class="fa fa-map"></i> Mapa</a>
          <a href="<?=URL?>/degController/cadastrar"><i class="fa fa-camera"></i> Registar</a>
      </div>
  </header>
  
  <?php
   
  }
  ?>
  <section class="conteudo">
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
                <p style="font-size: 10pt !important; text-align:center !important; margin: 5px auto !important; color: rgb(20,20,20) !important;"><?=$deg->data_registo?></p>
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