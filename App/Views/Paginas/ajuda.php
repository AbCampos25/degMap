<?php

if (!verificar::logado()) {

      ?>
      <header>
        <div class="nav1">
        <a href="<?=URL?>"><div class="logo"><?=App_name?></div></a>
            <nav> <a href="<?=URL?>/usuarioController/subscrever"><li>subscrever</li></a> <a href="<?=URL?>/usuarioController/login"><li>login</li></a> </nav>
        </div>
     </header>
      <?php
   }
   else {
      ?>
      <header>
      <div class="nav1">
      <a href="<?=URL?>"><div class="logo"><?=App_name?></div></a>
          <nav> <a href="<?=URL?>/usuarioController/perfil/<?=isset($_SESSION['id_admin'])?$_SESSION['id_admin']:$_SESSION['id_comum']?>"><li><i class="fa fa-user"></i></li></a> <a href="<?=URL?>/usuarioController/logout"><li>sair</li></a></nav>
      </div>
      <div class="nav2">
          <a href="<?=URL?>" ><i class="fa fa-home"></i> Home</a>
          <a href="<?=URL?>/paginasController/mapa"> <i class="fa fa-map"></i> Mapa</a>
          <a href="<?=URL?>/degController/cadastrar"><i class="fa fa-camera"></i> Registar</a>
      </div>
  </header>
  
  <?php
   
  }
  ?>
  <section class="conteudo">
    <div class="ajuda">
        <h1>Subscrição</h1>
        <hr>
        <p>Para obter acesso aos serviços do sistema, é necessário que os usuarios subscrevam-se.
            para isso, basta que sigam os seguintes passos. </p>
        <p>1º Passo: Clicar no botão subscrever que está no canto superior direito junto ao botão de login</p>
         <img src="<?=URL?>/Public/Img/index.png" alt="index-foto">
         <p>2º Passo: preencher todos os campos sem deixar nenhum campo vazio. 
         </p>
         <img src="<?=URL?>/Public/Img/subscrever.png" alt="form-foto">
         <p>3º Passo: De seguida clicar no botão subscrever que 
            fica no final do formulário. se tudo estiver certo, será direcionado para a página principal</p>
            <img src="<?=URL?>/Public/Img/home.png" alt="home-foto">
        <h1>Registar degradação</h1>
        <hr>
        <p>1º Passo: Clicar em "registar" que se encontra no menu principal.</p>
        <img src="<?=URL?>/Public/Img/home.png" alt="home-foto">
         <p>2º Passo: Escolha um ficheiro (uma foto), preencha todos os campos sem deixar nenhum campo vazio. 
         </p>
         <img src="<?=URL?>/Public/Img/cadastro-deg.png" alt="form-foto">
         <img src="<?=URL?>/Public/Img/cadastro-deg2.png" alt="form-foto">
         <p>3º Passo: De seguida clicar no botão cadastrar que 
            fica no final do formulário. se tudo estiver certo, será direcionado para a página principal</p>
            <img src="<?=URL?>/Public/Img/home.png" alt="home-foto">
        <h1>Editar degradação</h1>
        <hr>
        <p>1º Passo: Clicar em "ver detalhes" que se encontra de baixo da foto da degradação</p>
        <img src="<?=URL?>/Public/Img/home.png" alt="home-foto">
         <p>2º Passo: Em ver detalhes, poderá ver o botão editar de baixo da imagem da degradação, clique. 
         </p>
         <img src="<?=URL?>/Public/Img/edit.png" alt="form-foto">
         <p>3º Passo: Será levado para o formulário de edição 
            </p>
            <img src="<?=URL?>/Public/Img/edit2.png" alt="home-foto">
            <p>4º Passo: Actualize todos os dados nessários, só não deixe nenhum campo vazio. 
                </p>
                <img src="<?=URL?>/Public/Img/edit3.png" alt="home-foto">
            <p>5º Passo: Se tudo estiver certo, clique em "actulizar" que fica no final e será direcionado novamente em "ver detalhes"</p>
            <img src="<?=URL?>/Public/Img/edit.png" alt="form-foto">
        <h1>Eliminar degradação</h1>
        <hr>
        <p>1º Passo: Para eliminar, basta que siga os mesmos passos da edição, até chegar ao formulário</p>
        <img src="<?=URL?>/Public/Img/edit2.png" alt="home-foto">
         <p>2º Passo: Vai até ao final do formulário onde se encontra o botão "Eliminar". 
         </p>
            <img src="<?=URL?>/Public/Img/eliminar.png" alt="home-foto">
            <p>4º Passo: Clique e será redirecionado para a página principal, se tudo estiver certo. 
                </p>
                <img src="<?=URL?>/Public/Img/home.png" alt="home-foto">
    </div>
        <?php
include   App.'/Views/Paginas/footer.php';
?> 
    </section>
