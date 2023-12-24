   <footer class="rodape">
        <div class="menu-rodape">
            
                <li><a href="#">Voltar ao topo</a></li>
                <li><a href="<?=URL?>/paginasController/ajuda">Ajuda</a></li>
                <li><a href="<?=URL?>/paginasController/sobre">Sobre</a></li>
                <?php 
                   if (isset($_SESSION['id_admin'])) {
                    ?>
                     <li><a href="<?=URL?>/adminController">Painel do Administrador</a></li>
                    <?php 
                   }

                   if (verificar::logado()) {
                    ?>
                    <li><a href="<?=URL?>/usuarioController/logout">Terminar sessão</a></li>
                   <?php
                    
                   }
                ?>

        </div>
        <div class="copy">copyright &copy 2023 degmap@gmail.com</div>
    </footer>