<?php
namespace App\Models;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Model;

class Material extends Model {
    private $id;
    private $descriçao;
    private $quantidade;    

    public function __get($atributo) {
        return $this->$atributo;        
    }
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function novoMaterial() {
        $query = 'insert into materiais (descriçao,quantidade) values (?,?)';
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array($this->__get('descriçao'), $this->__get('quantidade')));      
    }
    public function getAll() {
        $query = 'select id, descriçao, quantidade from materiais order by descriçao';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function excluirMaterial() {
        $query = 'DELETE FROM materiais WHERE descriçao like ?';
        $stmt = $this->db->prepare($query);      
        $stmt->execute(array($this->__get('descriçao')));
        
        return $stmt->rowCount();
    }
    public function recuperarDados($id,$param) {
        $query = "select $param from materiais where id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($id));
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function adicionarMaterial() {
        $query = 'UPDATE `materiais` SET quantidade = quantidade + ? WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->__get('quantidade'), $this->__get('id')));
    }
    public function removerMaterial() {
        $query = 'UPDATE `materiais` SET quantidade = quantidade - ? WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->__get('quantidade'), $this->__get('id')));
    }    
    public function changeMaterial() {
        $query = 'UPDATE `materiais` SET descriçao = ? , quantidade = ? WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->__get('descriçao'), $this->__get('quantidade'), $this->__get('id')));
    }   
    public function pesquisar($pesquisa) {
        $query = "SELECT id, descriçao, quantidade FROM materiais WHERE descriçao LIKE ? order by descriçao";
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array('%'.$pesquisa.'%'));
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}
?>