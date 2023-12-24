<?php

  class database{

    private $db;   
    private $declaracao; 
  
    
    public function __construct(){

      $opcoes=[
        PDO::ATTR_PERSISTENT =>true,
        PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION
      ];
      try{
        $this->db = new PDO('mysql:host=localhost;port=3308;dbname=bd_degmap','root','',$opcoes);
        
        } catch (PDOException $e){
        echo " erro de banco de dados: ".$e->getMessage();
        exit();
        }
        catch(Exception $e){
          echo " erro genérico  : ".$e->getMessage();
          exit();
        }
      }
     
      public function query($sql){
        $this->declaracao=$this->db->prepare($sql);

    }

    public function bind($parametro, $valor, $tipo=null){
          if (is_null($tipo)) :
            switch ( true) :
              case is_int($valor):
                $tipo= PDO::PARAM_INT;
                break;
              case is_bool($valor):
                $tipo= PDO::PARAM_BOOL;
                break;  
              case is_null($valor):
                $tipo= PDO::PARAM_NULL;
                break;     
             default:
              $tipo= PDO::PARAM_STR;
                break;
            endswitch;
          endif;

          $this->declaracao->bindValue($parametro, $valor, $tipo);
    } 

    public function executa(){
     return $this->declaracao->execute();
    }

    public function resultado(){
      $this->executa();
      return $this->declaracao->fetch(PDO::FETCH_OBJ);
     }

     public function resultados(){
      $this->executa();
      return $this->declaracao->fetchAll(PDO::FETCH_OBJ);
     }

     public function totalResultados(){
      return $this->declaracao->rowCount();
     }

     public function ultimoId(){
      return $this->db->lastInsertId();
     }

}



