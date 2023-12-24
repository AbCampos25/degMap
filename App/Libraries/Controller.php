<?php

//CLASSE CONTROLADORA...
//CLASSE RESPONSAVEL PELAS VIEWS E OS MODELS.
class Controller{
    
     //METODO QUE RETORNA OS MODEL
    public function model($model){
       
      //REQUERENDO O ARQUIVO $model 
      require_once '../App/Models/'.$model.'.php';
      
      //RETORNANDO UMA INSTANCIA DA CLASSE DO ARQUIVO REQUERIDO
      return new $model;

    }
    
    //METODO QUE TRAZ AS VIEWS E INCLUI OS SEUS RESPETIVOS DADOS SE NECESSARIO
    public function view($view, $dados=[]){
           
        //VARIAVEL QUE RECEBE O CAMINHO DA VIEW
        $arquivo=('../App/Views/'.$view.'.php');

        //VERIFICANDO SE O ARQUIVO EXISTE
        if (file_exists($arquivo)) {

            //SE O ARQUIVO EXISTE, E REQUERIDO
            require_once $arquivo;
            
        }

        //SE NAO EXISTE LANCAR UMA  MENSAGEM OU REDIRECIONAR PARA UMA OUTRA PAGINA
        else 
            die ('Erro!!');
        
    }
}