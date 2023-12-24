<?php

if (!isset($_SESSION['id_admin'])) {
    url::redireciona('PaginasController');
}
?>
<section class="conteudo">
   <div class="emitir">
        <a href="">Actividades</a>
   </div>
   <div class="lista-deg-admin">
   <?php 
        foreach ($dados as $sessao) {
            ?>
      <div class="deg">
        <div class="detalhes">
            <h3><?=$sessao->actividade?></h3>
            <a href="<?=URL?>/usuarioController/perfil/<?=$sessao->fk_usuario_id?>">Usuario: <br> <h4><?=$sessao->fk_usuario_id?></h4></a>
            <p>Data:</p>
            <p><?=$sessao->data_registo?></p>
        </div>
        <div class="config">
        </div>
      </div>            
              <?php
        }
   ?>

   </div>
</section>