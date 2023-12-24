<?php
class usuarioModel{

  private $db;

  public function __construct(){
      $this->db=new database();
  }

  public function existeEmail($email){
    $this->db->query(" SELECT * FROM usuarios WHERE email=:email");
    $this->db->bind(':email', $email);
    $this->db->executa();

    if ($this->db->totalResultados()>0) {
        return true;
    }
    else
        return false;
  }

  public function armazenar($dados){
      $this->db->query("INSERT INTO usuarios(nome,telefone,email,senha) VALUES (:nome,:telefone,:email,:senha)");
      $this->db->bind(':nome', $dados['nome']);
      $this->db->bind(':telefone', $dados['telefone']);
      $this->db->bind(':email', $dados['email']);
      $this->db->bind(':senha', $dados['senha']);
 
     if ($this->db->executa()) {
         return true;
     } 
     else 
         return false;
  }
  public function actualizar($dados){
      $this->db->query("UPDATE usuarios SET nome=:nome,telefone=:telefone,email=:email WHERE id=:id");
      $this->db->bind(':id', $dados['id']);
      $this->db->bind(':nome', $dados['nome']);
      $this->db->bind(':telefone', $dados['telefone']);
      $this->db->bind(':email', $dados['email']); 
       $this->db->executa();
  }

  public function eliminar($id){
    $this->db->query("DELETE FROM usuarios WHERE id=:id");
    $this->db->bind(':id', $id);
    $this->db->executa();

  }

  public function umUsuario($id){
    $this->db->query("SELECT * FROM usuarios WHERE id=:id");
    $this->db->bind(':id', $id);
        return $this->db->resultado(); 
  }


  public function todosUsuarios(){
    $this->db->query("SELECT * FROM usuarios ORDER BY nome");
        return $this->db->resultados();
  }

  public function loginValido($email,$senha){
    $this->db->query("SELECT * FROM usuarios WHERE email=:email");
    $this->db->bind(':email', $email);
      if ($this->db->resultado()) {
        $info=$this->db->resultado();
        if ( md5($senha)==$info->senha) {
            return $info;
        }
        else
            return false;
      }
      else {
          return false;
      }
  
  
  }

}