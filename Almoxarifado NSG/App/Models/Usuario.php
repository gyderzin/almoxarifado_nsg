<?php
namespace App\Models;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Model;

class Usuario extends Model {
     private $id;
     private $nome;
     private $email;
     private $senha;
     private $tipo;

     public function __get($atributo) {
          return $this->$atributo;
     }
     public function __set($atributo, $valor) {
          $this->$atributo = $valor;
     }

     public function salvar() {
          $query = 'insert into usuarios (nome, email, senha,tipo) values(:nome, :email, :senha, :tipo)';
          $stmt = $this->db->prepare($query);
          $stmt->bindValue(':nome', $this->nome);
          $stmt->bindValue(':email', $this->email);
          $stmt->bindValue(':senha', $this->senha);
          $stmt->bindValue(':tipo', $this->tipo);
          $stmt->execute();
          
          return $this;
     }
     public function autenticação() {
        $query = 'select id, nome, email, senha from usuarios where email = :email and senha = :senha';
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

        if(isset($usuario['id']) != '' && isset($usuario['nome']) != '') {
            $this->__set('id', $usuario['id']);
            $this->__set('nome', $usuario['nome']);
        }
        return $this;
     }

     public function validarDados() {
          $permissao = true;

          if(strlen($this->__get('nome')) <= 0) {
              $permissao = false;
          }          
          if(strlen($this->__get('email')) <= 0) {
              $permissao = false;
          }
          
          if(strlen($this->__get('senha')) <= 0) {
              $permissao = false;
          }

          return $permissao;
      }
      public function getUsuarioPorEmail() {
          $query = 'select nome, email from usuarios where email = :email';
          $stmt = $this->db->prepare($query);
          $stmt->bindValue(':email', $this->__get('email'));
          $stmt->execute();

          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      }      
      public function recuperarUsuario() {
          $query = 'select id, nome, email, tipo from usuarios where id = :id';
          $stmt = $this->db->prepare($query);
          $stmt->bindValue(':id', $this->__get('id'));
          $stmt->execute();

          return $stmt->fetchAll(\PDO::FETCH_ASSOC);
      }
}
?>