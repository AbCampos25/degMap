<?php
class usuarioController extends Controller{

   public function __construct(){
      $this->usuarioModel=$this->model('usuarioModel');
      $this->degModel=$this->model('degModel');
      $this->sessaoModel=$this->model('sessaoModel');
   }
  
  
   public function index(){

      $degs=$this->degModel->todasDeg();
      $imagens = array();
      
      foreach ($degs as $deg) {
         $imagens[$deg->id] = $this->degModel->umaImagemDeUmaDeg($deg->id);
      }
      
      $dados=[
         'degs'=>$degs,
         'imagens'=>$imagens
      ];

      $this->view('Paginas/home', $dados);

  }
   
  
  
  //.......SUBINSCRIÇÃO E INSUBINSCRIÇÃO............


   public function subscrever(){

      $formulario=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      if (isset($formulario)) {
          $dados=[
             'nome'=>trim($formulario['nome']),
             'telefone'=>trim($formulario['telefone']),
             'email'=>trim($formulario['email']),
             'senha'=>trim($formulario['senha']),
             'senha2'=>trim($formulario['senha2'])
          ];

       if (in_array("", $dados)) {
            if (empty($dados['nome'])) {
               $dados['erro_nome']='campo obrigatório';
            }
            else {
               $dados['erro_nome']='';
            }
            if (empty($dados['telefone'])) {
               $dados['erro_telefone']='campo obrigsório';
            }
            else {
               $dados['erro_telefone']='';
            }
            if (empty($dados['email'])) {
               $dados['erro_email']='campo obrigsório';
            }
            else {
               $dados['erro_email']='';
            }
            if (empty($dados['senha'])) {
               $dados['erro_senha']='campo obrigatório';
            }
            
            else {
               $dados['erro_senha']='';
            }


            if (empty($dados['senha2'])) {
               $dados['erro_senha2']='confirme a senha';
            }

            else {
               $dados['erro_senha2']='';
            }
         }

      else{

           if (verificar::email($dados['email'])) {
            $dados['erro_email']='E-mail inválido!';
           }
           elseif (strlen($dados['senha'])<6) {
            $dados['erro_senha']='6 caracteres no minimo';
         }

           elseif ($dados['senha2']!=$dados['senha']) {
            $dados['erro_senha2']='a senha deve ser igual';
         }
           elseif ($this->usuarioModel->existeEmail($dados['email'])) {
            $dados['erro_email']='E-mail ja existente!';
         }
   
           else { 
              
            $dados['senha']= md5($dados['senha']);
              if ($this->usuarioModel->armazenar($dados)) {
               $usuario=$this->usuarioModel->loginValido($dados['email'],$dados['senha2']);
                     if ($usuario) {
                     $this->sessaoUsuario($usuario);
                     }

                  }

               }  

               
            } 
          
     }



      else {
         $dados=[
             'nome'=>'',
             'telefone'=>'',
             'email'=> '',
             'senha'=> '',
             'senha2'=> '',
             'erro_nome'=>'',
             'erro_telefone'=>'',
             'erro_email'=> '',
             'erro_senha'=> '',
             'erro_senha2'=> ''
          ];             
      }
      
     $this->view('Usuarios/subscricao', $dados);
   }

     public function insubscrever($id){
      if (isset($_SESSION['id_admin']) || isset($_SESSION['id_comum']) && $_SESSION['id_comum']==$id) {
         $this->usuarioModel->eliminar($id);
         $actividade='O usuário com id '.$id.' foi insubinscrito';
         $dados=[
            'actividade'=> $actividade, 'id_usuario'=>$id
         ];
         $this->sessaoModel->armazenar($dados);
         $this->logout();
      }

      else {
         $this->index();
      }
   }

   
   //.........BUSCA DE USUARIOS E ACTIVIDADES........


    public function usuariosSubinscritos(){
      $dados=$this->usuarioModel->todosUsuarios();
      $this->view('Usuarios/lista-usuarios', $dados);
    }
    
    public function perfil($id){
      $usuario=$this->usuarioModel->umUsuario($id);
      $degs=$this->degModel->todasDegDeUmUsuario($id);
      $imagens = array();
      
      foreach ($degs as $deg) {
         $imagens[$deg->id] = $this->degModel->umaImagemDeUmaDeg($deg->id);
      }
      $dados=[
         'usuario'=>$usuario,
         'degs'=>$degs,
         'imagens'=>$imagens
      ];

      $this->view('Usuarios/perfil-usuario', $dados);
    }


    public function actividades($id){
      $dados=$this->sessaoModel->todasSessoesDeUmUsuario($id);
      $this->view('Usuarios/actividades', $dados);

    }


    //.....LOGIN E LOGOUT..........................

    public function login(){
      $formulario=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if (isset($formulario)) {
               $dados=[
                  'email'=>trim($formulario['email']),
                  'senha'=>trim($formulario['senha'])
               ];

            if (in_array("", $dados)) {
      
                  if (empty($dados['email'])) {
                     $dados['erro_email']='campo obrigsório';
                  }
                  else {
                     $dados['erro_email']='';
                  }
                  if (empty($dados['senha'])) {
                     $dados['erro_senha']='campo obrigatório';
                  }
                  
                  else {
                     $dados['erro_senha']='';
                  }

               }

            else{
               

               if (verificar::email($dados['email'])) {
                  $dados['erro_email']='E-mail inválido!';
               }
               elseif (strlen($dados['senha'])<6) {
                  $dados['erro_senha']='6 caracteres no minimo';
               }

               elseif ($this->usuarioModel->existeEmail($dados['email'])) {
                     $usuario=$this->usuarioModel->loginValido($dados['email'], $dados['senha']);
                    if ($usuario) {
                      $this->sessaoUsuario($usuario);
                    }
                    else {
                     $dados['erro_senha']='senha errada';
                    }
              
               }
               
               else $dados['erro_email']='conta inexistente!';
 
            }
 
        }
         
        else {
            $dados=[
               'email'=> '',
               'senha'=> '',
               'erro_senha'=> '',
               'erro_email'=> '',
            ];             
            
         }
     
      $this->view('Usuarios/login', $dados );
     
   }
  
   private function sessaoUsuario($usuario){

      if ($usuario->id==45) {
         $_SESSION['id_admin']=$usuario->id;
         $_SESSION['nome']=$usuario->nome;
         $_SESSION['telefone']=$usuario->telefone;
         $_SESSION['email']=$usuario->email;
      }
      else {
         $_SESSION['id_comum']=$usuario->id;
         $_SESSION['nome']=$usuario->nome;
         $_SESSION['telefone']=$usuario->telefone;
         $_SESSION['email']=$usuario->email;
      }
      url::redireciona('Paginas');
   }

   public function logout(){
      $id_usuario= isset($_SESSION['id_comum'])? $_SESSION['id_comum']:$_SESSION['id_admin'];
      unset($_SESSION);
      session_destroy();
      $actividade='O usuário com id '.$id_usuario.' terminou sessão.';
      $dados=[
         'actividade'=> $actividade, 'id_usuario'=>$id_usuario
      ];
      $this->sessaoModel->armazenar($dados);
      url::redireciona('paginasController');
   }
   
}