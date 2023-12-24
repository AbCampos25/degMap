<?php

if (!isset($_SESSION['id_admin'])) {
    url::redireciona('PaginasController');
}
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
      <a href="<?=URL?>/adminController">Degradações</a>
      <a href="#Usuarios" style="color: rgb(20,20,20)">Usuarios</a>
      <a href="<?=URL?>/adminController/actividades">Actividades</a>
   </nav>
   <div class="emitir">
        <a href="<?=URL?>/adminController/actividades">emitir relatório<i class="fa fa-download"></i></a>
   </div>
   <div class="lista-deg-admin">
   <?php 
        foreach ($dados as $usuario) {
            ?>
      <div class="deg">
        <div class="detalhes">
            <h3><?=$usuario->nome?></h3>
            <a href="<?=URL?>/usuarioController/perfil/<?=$usuario->id?>">E-mail: <br> <h4><?=$usuario->email?></h4></a>
            <a href="<?=URL?>/usuarioController/perfil/<?=$usuario->id?>">telefone: <br> <h4><?=$usuario->telefone?></h4></a>
            <p>Data de subscrição:</p>
            <p><?=$usuario->data_registo?></p>
            <a href="<?=URL?>/adminController/actividades2/<?=$usuario->id?>"><br> <h4>Ver actividades</h4></a>
        </div>
        <div class="config">
            <a href="<?=URL?>/usuarioController/perfil/<?=$usuario->id?>"><i class="fa fa-eye"></i></a>
            <a href="<?=URL?>/adminController/eliminarUsuario/<?=$usuario->id?>"><i class="fa fa-trash"></i></a>
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