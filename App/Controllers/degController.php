<?php
class degController extends Controller{

   public function __construct(){
      $this->usuarioModel=$this->model('usuarioModel');
      $this->degModel=$this->model('degModel');
      $this->sessaoModel=$this->model('sessaoModel');
   }
  
  
   //.........LEVA PARA A PÉGINA DE DEGRADAÇÕES
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
   
  
  
  //.......CADASTRAMENTO DE DEGRADAÇÃO............


   public function cadastrar(){

      $formulario=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $dados=[];


         if (isset($formulario)) {
             
             $dados=[
                'nome'=>trim($formulario['nome']),
                'comuna'=>trim($formulario['comuna']),
                'bairro'=>trim($formulario['bairro']),
                'rua'=>trim($formulario['rua']),
                'descricao'=>trim($formulario['descricao']),
                'estado'=>trim($formulario['estado']),
                'intervencao'=>trim($formulario['intervencao']),
                'altitude'=>'1',
                'longitude'=>'2',
                'id_usuario'=> (isset($_SESSION['id_admin']))?$_SESSION['id_admin']:$_SESSION['id_comum']
             ];

          if (in_array("", $dados)) {
               if (empty($dados['nome'])) {
                  $dados['erro_nome']='Insira o nome, por favor.';
               }
               else {
                  $dados['erro_nome']='';
               }
               if (empty($dados['descricao'])) {
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
              $existe=$this->degModel->jaExiste($dados);
              if ($existe) {
               $dados['erro_geral']='Esta degração já se encontra cadastrada';
              }
      
              else { 
                  if (!isset($_FILES["foto"])) {
                     $dados['erro_foto']='tire ou esolha uma foto';
                  }
                  else {
                     $foto=array();
                     if(isset($_FILES["foto"])){
                         for($i=0;$i<count($_FILES["foto"]["name"]);$i++){
              
                      //SALVAR DENTRO DE UMA PASTA
              
                       $nome_arq=md5($_FILES["foto"]["name"][$i].rand(1,999)).'.jpg';
                       move_uploaded_file($_FILES["foto"]["tmp_name"][$i],'../Public/Img/'.$nome_arq);
                      
                       //SALVAR NOMES PARA O BANCO DE DADOS
              
                        array_push($foto,$nome_arq );
                         }
                     }
                     if ($this->degModel->armazenar($dados, $foto)) {
                        $id= (isset($_SESSION['id_admin']))?$_SESSION['id_admin']:$_SESSION['id_comum'];                   
                        $actividade='A degradação ('.$dados['nome'].') foi cadastrada pelo usuario com id ->'.$id;
                        $relato=[
                           'actividade'=> $actividade, 
                           'id_usuario'=> $id
                        ];
                          $this->sessaoModel->armazenar($relato);
                          url::redireciona('paginasController');
                     }

                  }
                


               }  

               
            } 
             
             
        }
        else {
         $dados=[
             'nome'=>'',
             'descricao'=>'',
             'estado'=> '',
             'intervencao'=> '',
             'comuna'=> '',
             'bairro'=> '',
             'rua'=> '',
             'erro_nome'=>'',
             'erro_descricao'=>'',
             'erro_geral'=>'',
             'erro_estado'=> '',
             'erro_intervencao'=> '',
             'erro_comuna'=> '',
             'erro_bairro'=> '',
             'erro_rua'=> '',
             'erro_foto'=> '',
          ];             
      }

      $this->view('Deg/deg-form', $dados); 

         
    }

    //..............EDIÇÃO.........................
    
    
    //REDIRECIANA PARA A PÁGINA DE EDIÇÃO
    public function Editar($id){
        $deg=$this->degModel->umaDeg($id);
        $dados=[
         'id'=>$deg->id,
         'nome'=>$deg->nome,
         'comuna'=>$deg->comuna,
         'bairro'=>$deg->bairro,
         'rua'=>$deg->rua,
         'descricao'=>$deg->descricao,
         'estado'=>$deg->estado,
         'intervencao'=>$deg->intervencao
      ];
        $this->view('Deg/deg-edit', $dados);
    }
    
    
    //REDIRECIONA PARA O FORMULARIO DE CADASTRO
    public function formulario(){
        $this->view('Deg/deg-form');
    }   
   
    //ACTUALIZA OS DADOS DA DEGRADAÇÃO
    public function actualizar($id){

      $formulario=filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $dados=[];
         if (isset($formulario)) {
             $dados=[
                'id'=>$id,
                'nome'=>trim($formulario['nome']),
                'comuna'=>trim($formulario['comuna']),
                'bairro'=>trim($formulario['bairro']),
                'rua'=>trim($formulario['rua']),
                'descricao'=>trim($formulario['descricao']),
                'estado'=>trim($formulario['estado']),
                'intervencao'=>trim($formulario['intervencao'])
             ];

          if (in_array("", $dados)) {
               if (empty($dados['nome'])) {
                  $dados['erro_nome']='Insira o nome, por favor.';
               }
               else {
                  $dados['erro_nome']='';
               }
               if (empty($dados['descricao'])) {
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
                   
                    $id= (isset($_SESSION['id_admin']))?$_SESSION['id_admin']:$_SESSION['id_comum'];                   
                    $actividade='A degradação ('.$info->nome.') foi Editada pelo usuario com id '.$id;
                    $relato=[
                       'actividade'=> $actividade, 
                       'id_usuario'=> $id
                    ];
                      $this->sessaoModel->armazenar($relato);

                    url::redireciona('degController/detalhes/'.$info->id);
             
          } 

          
     }
     else {
      $dados=[
          'nome'=>'',
          'descricao'=>'',
          'estado'=> '',
          'intervencao'=> '',
          'comuna'=> '',
          'bairro'=> '',
          'rua'=> '',
          'erro_nome'=>'',
          'erro_descricao'=>'',
          'erro_geral'=>'',
          'erro_estado'=> '',
          'erro_intervencao'=> '',
          'erro_comuna'=> '',
          'erro_bairro'=> '',
          'erro_rua'=> '',
       ];             
   }

   $this->view('Deg/deg-edit', $dados); 

     
   }

   
   //.........BUSCA DETALHES DE UMA DEGRADAÇÃO........
    
    public function detalhes($id){
      $dados=[
         'deg'=>$this->degModel->umaDeg($id),
         'capa'=>$this->degModel->umaimagemDeUmaDeg($id),
         'imagens'=>$this->degModel->todasImagensDeUmaDeg($id)
      ];

      $this->view('Deg/deg-detalhes', $dados);
    }

    //............ELIMINA UMA DEGRADAÇÃO................
    
    public function eliminarDeg($id){
        $info=$this->degModel->umaDeg($id);
        $this->degModel->eliminar($id);
        $id_us= (isset($_SESSION['id_admin']))?$_SESSION['id_admin']:$_SESSION['id_comum'];
        $actividade='A degradação ('.$info->nome.') foi eliminado pelo usuario '.$id_us;
        $dados=[
           'actividade'=> $actividade, 
           'id_usuario'=> $id_us
         ];
         $this->sessaoModel->armazenar($dados);
         $this->degModel-> eliminarImagensDeUmaDeg($id);
       
       $this->index();
     }
    
}