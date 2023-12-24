    <header>
        <div class="nav1">
            <div class="logo">degMap</div>
            <nav> <a href="<?=URL?>/usuarioController/perfil/<?=isset($_SESSION['id_admin'])?$_SESSION['id_admin']:$_SESSION['id_comum']?>"><li><i class="fa fa-user"></i></li></a> <a href="../index.html"><li>sair</li></a></nav>
        </div>
        <div class="nav2">
            <a href="<?=URL?>/paginasController"><i class="fa fa-home"></i> Home</a>
            <a href=""  class="activo"><i class="fa fa-map"></i> Mapa</a>
            <a href="<?=URL?>/degController/cadastrar"><i class="fa fa-camera"></i> Registar</a>
        </div>
    </header>
    <section class="conteudo">
        <div class="mapa capa" style="background-image: url(../IMAGENS/map.jpg);">
        </div>
        <?php
include   App.'/Views/Paginas/footer.php';
?> 
    </section>