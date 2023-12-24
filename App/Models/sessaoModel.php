<?php
class sessaoModel{

  private $db;

  public function __construct(){
      $this->db=new database();
  }

  public function armazenar($dados){

      $this->db->query("INSERT INTO sessoes (actividade , fk_usuario_id) VALUES (:actividade,:fk_usuario_id)");
      $this->db->bind(':actividade', $dados['actividade']);
      $this->db->bind(':fk_usuario_id', $dados['id_usuario']);
       
           if ($this->db->executa()) {
            
               return true;
           }  

           else
               return false;
        
  }

  public function eliminar($id){
    $this->db->query("DELETE FROM sessoes WHERE id=:id");
    $this->db->bind(':id', $id);
    $this->db->executa();

  }
  public function eliminarSessoesDeUmUsuario($id){
    $this->db->query("DELETE FROM sessoes WHERE fk_usuario_id=:id");
    $this->db->bind(':id', $id);
    $this->db->executa();

  }

  public function umaSessao($id){
    $this->db->query("SELECT * FROM sessoes WHERE id=:id");
    $this->db->bind(':id', $id);
       return $this->db->resultado();
  }
  
  public function TodasSessoesDeUmUsuario($id){
    $this->db->query("SELECT * FROM sessoes WHERE fk_usuario_id=:id_usuario ORDER BY data_registo DESC");
    $this->db->bind(':id_usuario', $id);
        return $this->db->resultados();
  }
  public function TodasSessoes(){
    $this->db->query("SELECT * FROM sessoes ORDER BY data_registo DESC");
        return $this->db->resultados();
  }

}