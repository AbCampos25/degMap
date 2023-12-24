  
    <section class="conteudo">  <br>
        <form method="POST" action="<?=URL?>/usuarioController/subscrever" >
            <div>
                <h2>Preencha todos os campos!</h2>
                <label for="nome">Nome *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_nome'])){echo $dados['erro_nome'];} echo '';?></span></label>
                <input type="text" name="nome" maxlength=32 value="<?=$dados['nome']?>" required>
                <label for="telefone">telefone *<br> <span style="color:red;" value=""><?php if(isset($dados['erro_telefone'])){echo $dados['erro_telefone'];} echo '';?></span></label>
                <input type="number" name="telefone" maxlength=13 value="<?=$dados['telefone']?>" required>
                <label for="email" >E-mail * <br> <span style="color:red;" value=""><?php if(isset($dados['erro_email'])){echo $dados['erro_email'];} echo '';?></span></label>
                <input type="email" name="email" maxlength=32 value="<?=$dados['email']?>" required>
                <label for="senha" >Senha *<br> <span style="color:red;" value=""> <?php if(isset($dados['erro_senha'])){echo $dados['erro_senha'];} echo '';?></span></label>
                <input type="password" name="senha" maxlength=16 minlength=6 value="<?=$dados['senha']?>" required>
                <label for="senha2" >Confirmar senha * <br> <span style="color:red;" value=""><?php if(isset($dados['erro_senha2'])){echo $dados['erro_senha2'];} echo '';?></span></label>
                <input type="password" name="senha2" minlength=6 maxlength=16 value="<?=$dados['senha2']?>" required>
                <button type="submit">submeter</button>
                <a href="<?=URL?>/usuarioController/login">Ir para login...</a>
            </div>
        </form>
    </section>