<?php
if (verificar::logado()) {
    url::redireciona('PaginasController');
}
?>
    <header>
        <div class="nav1">
            <div class=""><a href="<?=URL?>"> <i class="fa fa-home"></i> voltar</a></div>
            <nav></a> <a href="#"><li></li></a> </nav>
        </div>
    </header>
    <section class="conteudo">
        <form method="POST" action="<?=URL?>/usuarioController/login">
            <div>
                <h2>Preencha os campos!</h2>
                <label for="email" >Email * <br> <span style="color:red;" value=""><?php if(isset($dados['erro_email'])){echo $dados['erro_email'];} echo '';?></span></label>
                <input type="email" name="email" maxlength=32 value="<?=$dados['email']?>" required>
                <label for="senha" >Senha *<br> <span style="color:red;" value=""> <?php if(isset($dados['erro_senha'])){echo $dados['erro_senha'];} echo '';?></span></label>
                <input type="password" name="senha" maxlength=16 minlength=6 value="<?=$dados['senha']?>" required>
                <button type="submit">Log in</button>
                <p>Se ainda não é subscrito, <a href="<?=URL?>/usuarioController/subscrever">clique para subscrever.</a></p>
            </div>
        </form>
        <?php
include   App.'/Views/Paginas/footer.php';
?>
    </section>
