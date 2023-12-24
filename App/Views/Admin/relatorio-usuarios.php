<?php

if (!isset($_SESSION['id_admin'])) {
    url::redireciona('PaginasController');
}
?>
<section class="conteudo">
   <div class="emitir">
        <a href="">Usuarios</a>
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
        </div>
        <div class="config">
        </div>
      </div>            
              <?php
        }
   ?>

   </div>
</section>