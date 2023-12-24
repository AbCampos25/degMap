<?php
class paginasController extends Controller{

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


   public function mapa(){

      $this->view('Paginas/mapa', $dados=[]);

  }
   public function sobre(){

      $this->view('Paginas/sobre');

  }

  
   public function ajuda(){

      $this->view('Paginas/ajuda');

  }
   public function politicaDePrivacidade(){

      $this->view('Paginas/politica-privacidade');

  }
   public function termos(){

      $this->view('Paginas/termos');

  }

}