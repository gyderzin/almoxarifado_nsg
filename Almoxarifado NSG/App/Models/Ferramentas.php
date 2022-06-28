<?php
namespace App\Models;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Model;

class Ferramentas extends Model {
    private $id;
    private $descriçao;
    private $quantidade;    
    private $qtd_pendente;    
    private $funcionario;    

    public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function getAll() {
        $query = 'select id, descriçao, quantidade, qtd_pendente, funcionario from ferramentas order by descriçao';
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function novaFerramenta() {
        $query = 'insert into ferramentas (descriçao,quantidade,funcionario) values (?,?,?)';
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array($this->__get('descriçao'), $this->__get('quantidade'), $this->__get('funcionario')));      
    }
    public function validarExclusaoFerramenta() {
        $query = 'SELECT id, descriçao, quantidade, funcionario FROM ferramentas WHERE descriçao like ?';
        $stmt = $this->db->prepare($query);      
        $stmt->execute(array($this->__get('descriçao')));
        
        if($stmt->rowCount() == 1) {
        $query = 'DELETE FROM ferramentas WHERE descriçao like ?';
        $stmt = $this->db->prepare($query);      
        $stmt->execute(array($this->__get('descriçao')));
        
        return $stmt->rowCount();
        }
        else {
            return $stmt->rowCount();
        }       
    }
    public function excluirFerramenta($id) {
        $query = 'DELETE FROM ferramentas WHERE id like ?';
        $stmt = $this->db->prepare($query);      
        $stmt->execute(array($id));
    }
    public function recuperarDados($id, $param) {
        $query = "select $param from ferramentas where id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($id));
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function adicionarFerramenta($quantidade) {
        $query = 'UPDATE `ferramentas` SET qtd_pendente = qtd_pendente - ? WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($quantidade, $this->__get('id')));
    }
    public function removerFerramenta() {
        $query = 'UPDATE `ferramentas` SET qtd_pendente = qtd_pendente + ?  WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->__get('qtd_pendente'), $this->__get('id')));
    }    
    public function changeFerramenta() {
        $query = 'UPDATE `ferramentas` SET descriçao = ? , quantidade = ? WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($this->__get('descriçao'), $this->__get('quantidade'), $this->__get('id')));
    }   
    public function pesquisar($pesquisa) {
        $query = "SELECT id, descriçao, quantidade, qtd_pendente, funcionario   FROM ferramentas WHERE descriçao LIKE ? order by descriçao";
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array('%'.$pesquisa.'%'));
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function recuperarFerramenta($descriçao) {
        $query = "SELECT * FROM ferramentas WHERE descriçao = ?";
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array($descriçao));

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function novaPendencia() {
        $query = '
        INSERT INTO 
            pendencias_ferramentas
        (id_ferramenta, descriçao_ferramenta, quantidade_pendente, funcionario, dia)
        VALUES
            ()
        ';
    }
}
?>