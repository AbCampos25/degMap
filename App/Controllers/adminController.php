<?php
class adminController extends Controller{

   public function __construct(){
      $this->usuarioModel=$this->model('usuarioModel');
      $this->degModel=$this->model('degModel');
      $this->sessaoModel=$this->model('sessaoModel');
   }
  
  
   public function index(){

      $degs=$this->degModel->todasDeg();
      $usuarios = array();
      
      foreach ($degs as $deg) {
         $usuarios[$deg->fk_usuario_id] = $this->usuarioModel->umUsuario($deg->fk_usuario_id);
      }
      
      $dados=[
         'degs'=>$degs,
         'usuarios'=>$usuarios
      ];

      $this->view('admin/painel-degs', $dados);

  }
   
   
   //.........BUSCA DE USUARIOS E ACTIVIDADES...............


    public function usuarios(){
      $dados=$this->usuarioModel->todosUsuarios();
      $this->view('admin/painel-usuarios', $dados);
    }
   
   
    public function eliminarUsuario($id){
        if (isset($_SESSION['id_admin'])) {
            
            $degs = $this->degModel->todasDegDeUmUsuario($id);
        
            foreach ($degs as $deg) {
                $this->degModel->eliminarImagensDeUmaDeg($deg->id);
                
            }
            $this->usuarioModel->eliminar($id);
            $this->degModel->eliminarDegsDeUmUsuario($id);
            $this->usuarioModel->eliminarSessoesDeUmUsuario($id);
          
          $actividade='O usuário com id '.$id.' foi eliminado pelo admin '. $_SESSION['id_admin'];
          $dados=[
             'actividade'=> $actividade, 
             'id_usuario'=> $_SESSION['id_admin']
          ];
          $this->sessaoModel->armazenar($dados);
        }
        $this->usuarios();
    }

    
    public function eliminarDeg($id){
       $info=$this->degModel->umaDeg($id);
       $this->degModel->eliminar($id);
       $this->degModel-> eliminarImagensDeUmaDeg($id);
      
      $actividade='A degradação ('.$info->nome.') foi eliminado pelo admin '. $_SESSION['id_admin'];
      $dados=[
         'actividade'=> $actividade, 
         'id_usuario'=> $_SESSION['id_admin']
      ];
      $this->sessaoModel->armazenar($dados);
      $this->index();
    }


    public function actividades(){
      $dados=$this->sessaoModel->todasSessoes();
      $this->view('admin/painel-actividades', $dados);

    }
    public function actividades2($id){
      $dados=[
         'usuario'=>$this->usuarioModel->umUsuario($id),
         'actividades'=>$this->sessaoModel->todasSessoesDeUmUsuario($id)
      ];
      $this->view('admin/painel-actividades2', $dados);

    }

    //............RELATORIOS DE TUDO.....................

    public function actividadesRelatorioDeUmUsuario($id){
      $dados=[
         'usuario'=>$this->usuarioModel->umUsuario($id),
         'actividades'=>$this->sessaoModel->todasSessoesDeUmUsuario($id)
      ];
      $this->view('admin/relatorio-actividades', $dados);

    }
    
    
    public function relatorioActividades(){
      $dados= $this->sessaoModel->todasSessoes();
      $this->view('admin/relatorio-actividades', $dados);

    }


    public function relatorioUsuarios(){

      $dados=$this->usuarioModel->todosUsuarios();
      $this->view('admin/relatorio-usuarios', $dados);

    }
    public function relatorioDegs(){

      $degs=$this->degModel->todasDeg();
      $usuarios = array();
      
      foreach ($degs as $deg) {
         $usuarios[$deg->fk_usuario_id] = $this->usuarioModel->umUsuario($deg->fk_usuario_id);
      }
      
      $dados=[
         'degs'=>$degs,
         'usuarios'=>$usuarios
      ];
      $this->view('admin/relatorio-degs', $dados);

    }

    //...........EDIÇÃO DEG......................
    
    public function actualizar($id){

      $formulario=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $dados=[];
         if (isset($formulario)) {
             $dados=[
                'id'=>$id,
                'nome'=>trim($formulario['nome']),
                'comuna'=>trim($formulario['comuna']),
                'bairro'=>trim($formulario['bairo']),
                'rua'=>trim($formulario['rua']),
                'descricao'=>trim($formulario['descricao']),
                'estado'=>trim($formulario['estado']),
                'intervencao'=>trim($formulario['intervencao']),
                'rua'=>trim($formulario['rua'])
             ];

          if (in_array("", $dados)) {
               if (empty($dados['nome'])) {
                  $dados['erro_nome']='Insira o nome, por favor.';
               }
               else {
                  $dados['erro_nome']='';
               }
               if (empty($dados['destricao'])) {
                  $dados['erro_descricao']='Por favor, descreva sobre o que está a ocorrer';
               }
               else {
                  $dados['erro_descricao']='';
               }
               if (empty($dados['estado'])) {
                  $dados['erro_estado']='campo obrigatório';
               }
               else {
                  $dados['erro_estado']='';
               }
               if (empty($dados['intervencao'])) {
                  $dados['erro_intervencao']='campo obrigatório';
               }
               
               else {
                  $dados['erro_intervencao']='';
               }


               if (empty($dados['comuna'])) {
                  $dados['erro_comuna']='campo obrigatório';
               }

               else {
                  $dados['erro_comuna']='';
               }
               if (empty($dados['bairro'])) {
                  $dados['erro_bairro']='campo obrigatório';
               }

               else {
                  $dados['erro_bairro']='';
               }
               if (empty($dados['rua'])) {
                  $dados['erro_rua']='campo obrigatório';
               }

               else {
                  $dados['erro_rua']='';
               }
            }

         else{
                      
                    $this->degModel->actualizar($dados);
                    $info=$this->degModel->umaDeg($id);
                   
                    $actividade='A degradação ('.$info->nome.') foi Editada pelo usuario '.$_SESSION['id_admin'];
                    $dados=[
                       'actividade'=> $actividade, 
                       'id_usuario'=> $_SESSION['id_admin']
                    ];
                    $this->sessaoModel->armazenar($dados);

                    $this->index();
             
          } 

          $this->view('Deg/deg-form', $dados);
     }
     
   }
   
}