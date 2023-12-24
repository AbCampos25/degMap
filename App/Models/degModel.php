<?php
class degModel{

  private $db;

  public function __construct(){
      $this->db=new database();
  }

  public function jaExiste($dados) {
    $this->db->query("SELECT * FROM deg WHERE nome=:nome AND comuna=:comuna AND bairro=:bairro AND rua=:rua");
    $this->db->bind(':nome', $dados['nome']);
    $this->db->bind(':comuna', $dados['comuna']);
    $this->db->bind(':bairro', $dados['bairro']);
    $this->db->bind(':rua', $dados['rua']);
    $this->db->resultados();

        if ($this->db->totalResultados()>0) {
            return true;
        }
        else {
            return false;
        }
  }

  public function armazenar($dados, $fotos=array()){

            $this->db->query("INSERT INTO deg(nome,descricao,comuna,bairro,rua,estado,intervencao,altitude,longitude,fk_usuario_id) 
            VALUES (:nome,:descricao,:comuna,:bairro,:rua,:estado,:intervencao,:altitude,:longitude,:fk_usuario_id)
            ");
            $this->db->bind(':nome', $dados['nome']);
            $this->db->bind('descricao', $dados['descricao']);
            $this->db->bind(':comuna', $dados['comuna']);
            $this->db->bind(':bairro', $dados['bairro']);
            $this->db->bind(':rua', $dados['rua']);
            $this->db->bind(':estado', $dados['estado']);
            $this->db->bind(':intervencao', $dados['intervencao']);
            $this->db->bind(':altitude', $dados['altitude']);
            $this->db->bind(':longitude', $dados['longitude']);
            $this->db->bind(':fk_usuario_id', $dados['id_usuario']);
       
           if ($this->db->executa()) {

            $id_deg=$this->db->ultimoId();
            
            if (count($fotos)>0) {
                for ($i=0; $i <count($fotos) ; $i++) { 
                  $nome_foto=$fotos[$i];
                  $this->db->query("INSERT INTO imagens(nome,fk_deg_id) VALUES (:n,:id)" );
                  $this->db->bind(':n',$nome_foto);
                  $this->db->bind(':id',$id_deg);
                  $this->db->executa();
                
                  }
                }
            
               return true;
           }  

           else
               return false;
        
  }


  public function actualizar($dados){
      $this->db->query("UPDATE deg SET nome=:nome,descricao=:descricao,comuna=:comuna,bairro=:bairro,rua=:rua,estado=:estado,intervencao=:intervencao WHERE id=:id");
      $this->db->bind(':id', $dados['id']);
      $this->db->bind(':nome', $dados['nome']);
      $this->db->bind(':descricao', $dados['descricao']);
      $this->db->bind(':comuna', $dados['comuna']);
      $this->db->bind(':bairro', $dados['bairro']);
      $this->db->bind(':rua', $dados['rua']);
      $this->db->bind(':estado', $dados['estado']);
      $this->db->bind(':intervencao', $dados['intervencao']); 
      $this->db->executa();
  }

  public function eliminar($id){
    $this->db->query("DELETE FROM deg WHERE id=:id");
    $this->db->bind(':id', $id);
    $this->db->executa();
  }
  public function eliminarDegsDeUmUsuario($id){
    $this->db->query("DELETE FROM deg WHERE fk_usuario_id=:id");
    $this->db->bind(':id', $id);
    $this->db->executa();
  }

  public function umaDeg($id){
    $this->db->query("SELECT * FROM deg WHERE id=:id");
    $this->db->bind(':id', $id);
        return $this->db->resultado();
  }

  public function todasDeg(){
    $this->db->query("SELECT * FROM deg ORDER BY data_registo DESC");
        return $this->db->resultados();
  }

  public function todasDegDeUmUsuario($id){
    $this->db->query("SELECT * FROM deg WHERE fk_usuario_id=:id_usuario ORDER BY data_registo DESC");
    $this->db->bind(':id_usuario', $id);
        return $this->db->resultados();
  }

  
  public function eliminarImagensDeUmaDeg($id){
    $this->db->query("DELETE FROM imagens WHERE fk_deg_id=:id");
    $this->db->bind(':id', $id);
    $this->db->executa();
  }

  public function umaImagemDeUmaDeg($id){
    $this->db->query("SELECT * FROM imagens WHERE fk_deg_id=:id");
    $this->db->bind(':id', $id);
        return $this->db->resultado();
  }

  public function todasImagensDeUmaDeg($id){
    $this->db->query("SELECT nome FROM imagens WHERE fk_deg_id=:id");
    $this->db->bind(':id', $id);
        return $this->db->resultados();
  }

}