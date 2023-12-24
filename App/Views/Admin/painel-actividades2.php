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
      <a href="<?=URL?>/adminController/usuarios">Usuarios</a>
      <a href="#Actividades" style="color: rgb(20,20,20)">Actividades</a>
   </nav>
   <div class="emitir">
        <a href="">emitir relatório<i class="fa fa-download"></i></a>
   </div>
   <div class="lista-deg-admin">
   <?php 
        $actividades=$dados['actividades'];
        $usuario=$dados['usuario'];
        
        foreach ($actividades as $sessao) {
            ?>
      <div class="deg">
        <div class="detalhes">
            <h3><?=$sessao->actividade?></h3>
            <a href="<?=URL?>/usuarioController/perfil/<?=$sessao->fk_usuario_id?>">Usuario: <br> <h4><?=$usuario->nome?></h4></a>
            <p>Data:</p>
            <p><?=$sessao->data_registo?></p>
        </div>
        <div class="config">
            <a href=""><i class="fa fa-trash"></i></a>
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