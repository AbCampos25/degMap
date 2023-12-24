<?php

if (!isset($_SESSION['id_admin'])) {
    url::redireciona('PaginasController');
}

$degs= $dados['degs'];
$usuarios= $dados['usuarios'];
?>
<header>
      <div class="nav1">
          <a href="<?=URL?>"><div class="logo"><?=App_name?></div></a>
          <nav> <a href="<?=URL?>/usuarioController/perfil/<?=isset($_SESSION['id_admin'])?$_SESSION['id_admin']:$_SESSION['id_comum']?>"><li><i class="fa fa-user"></i></li></a> <a href="<?=URL?>/usuarioController/logout"><li>sair</li></a></nav>
      </div>
      <div class="nav2">
          <a href="">Painel do administrador</a>
      </div>
  </header>
<section class="conteudo">
   <nav class="menu-admin">
      <a href="#Degradações" style="color: rgb(20,20,20)">Degradações</a>
      <a href="<?=URL?>/adminController/usuarios">Usuarios</a>
      <a href="<?=URL?>/adminController/actividades">Actividades</a>
   </nav>
   <div class="emitir">
        <a href="<?=URL?>/adminController/relatorioDegs">emitir relatório<i class="fa fa-download"></i></a>
   </div>
   <div class="lista-deg-admin">
   <?php 
        foreach ($degs as $deg) {
            ?>
      <div class="deg">
        <div class="detalhes">
            <h3><?=$deg->nome?></h3>
            <a href="<?=URL?>/usuarioController/perfil/<?=$usuarios[$deg->fk_usuario_id]->id?>">cadastrado por: <br> <h4><?=$usuarios[$deg->fk_usuario_id]->nome?></h4></a>
            <p>Data de registo:</p>
            <p><?=$deg->data_registo?></p>
        </div>
        <div class="config">
            <a href="<?=URL?>/degController/detalhes/<?=$deg->id?>"><i class="fa fa-eye"></i></a>
            <a href="<?=URL?>/adminController/eliminarDeg/<?=$deg->id?>"><i class="fa fa-trash"></i></a>
        </div>
      </div>            
              <?php
        }
   ?>

   </div>
   <?php
include   App.'/Views/Paginas/footer.php';
?> 
</section>