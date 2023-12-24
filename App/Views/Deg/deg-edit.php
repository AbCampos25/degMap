<?php

if (!verificar::logado()) {
    url::redireciona('PaginasController');
}
?>
<header>
        <div class="nav1">
            <div class="logo">degMap</div>
            <nav> <a href="<?=URL?>/usuarioController/perfil/<?=isset($_SESSION['id_admin'])?$_SESSION['id_admin']:$_SESSION['id_comum']?>"><li><i class="fa fa-user"></i></li></a> <a href="<?=URL?>/usuarioController/logout"><li>sair</li></a></nav>
        </div>
        <div class="nav2">
            <a href="<?=URL?>/paginasController" ><i class="fa fa-home"></i> Home</a>
            <a href="<?=URL?>/paginasController/mapa"><i class="fa fa-map"></i> Mapa</a>
            <a href="<?=URL?>/degController/cadastrar" class=""><i class="fa fa-camera"></i> Registar</a>
        </div>
    </header>
    <section class="conteudo">
        <form action="<?=URL?>/degController/actualizar/<?=$dados['id']?>" method="POST" enctype="multipart/form-data">
            <div>
                <h2>Actualize os dados!</h2>
                <label for="nome">Nome 
                *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_nome'])){echo $dados['erro_nome'];} echo '';?></span>
                </label>
                <input type="text" name="nome" required maxlength=32 value="<?=$dados['nome']?>">
                <label for="descricao">Descrição
                *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_descricao'])){echo $dados['erro_descricao'];} echo '';?></span>
                </label>
                <textarea name="descricao" id="" cols="30" rows="10" required><?=$dados['descricao']?></textarea>
                <label for="estado">Estado de degradação</label>
                <select name="estado" id="">
                    <option value="Estágio Inicial">Estágio Inicial</option>
                    <option value="Médio">Médio</option>
                    <option value="Estágio Avançado">Estágio Avançado</option>
                    <option value="Grave">Grave</option>
                </select>
                <label for="intervencao">Intervenção</label>
                <select name="intervencao" id="">
                    <option value="Nenhuma">Nenhuma intervenção</option>
                    <option value="Em andamento">intervenção em andamento</option>
                    <option value="Aplicada">Intervenção Aplicada</option>
                </select>
                <label for="comuna">Comuna 
                *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_comuna'])){echo $dados['erro_comuna'];} echo '';?></span>
                </label>
                <input type="text" name="comuna" maxlength=32 value="<?=$dados['comuna']?>" required>
                <label for="bairro">Bairro 
                *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_bairro'])){echo $dados['erro_bairro'];} echo '';?></span>
                </label>
                <input type="text" name="bairro" maxlength=32 value="<?=$dados['bairro']?>" required>
                <label for="rua">Rua 
                *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_rua'])){echo $dados['erro_rua'];} echo '';?></span>
                </label>
                <input type="text" name="rua" maxlength=13 value="<?=$dados['rua']?>" required>
                <button type="submit">actualizar</button>
                <a href="<?=URL?>/degController/eliminarDeg/<?=$dados['id']?>"><button style="background: black;">Eliminar</a>
            </div>
        </form>
        <?php
include   App.'/Views/Paginas/footer.php';
?> 
    </section>