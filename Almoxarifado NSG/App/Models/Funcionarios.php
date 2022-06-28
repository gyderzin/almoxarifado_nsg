<?php
namespace App\Models;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Model;

class Funcionarios extends Model {
    private $id;
    private $nome;      
    private $funçao;  
    private $contrato;  
    private $ctps;  
    private $telefone;  

    public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function getAll() {
        $query = 'SELECT * FROM `funcionarios` order by nome';
        $stmt =  $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function ferramentasFuncionario() {
        $query = 'SELECT * FROM `ferramentas` WHERE funcionario = ?';
        $stmt =  $this->db->prepare($query);
        $stmt->execute(array($this->__get('nome')));
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function historicoFuncionario($dataDe, $dataAte) {        
        $query = 'SELECT id, DATE_FORMAT(data, "%d/%m/%Y") as data, descriçao, tipo, qtd, sd, funcionario, hora FROM `historico` WHERE funcionario = ? AND data BETWEEN ? AND ?';
        $stmt =  $this->db->prepare($query);
        $stmt->execute(array($this->__get('nome'), $dataDe, $dataAte));
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);        
    }
    public function novoFuncionario() {
        $query = 'INSERT INTO funcionarios (nome, funçao, contrato, ctps, telefone) VALUES(?, ?, ?, ?, ?)';
        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $this->__get('nome'), 
                $this->__get('funçao'),
                $this->__get('contrato'),
                $this->__get('ctps'),
                $this->__get('telefone'),
                )
        );
    }
    public function desligarFuncionario() {
        $query = 'DELETE FROM funcionarios WHERE nome = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $this->__get('nome'), 
            )
        );
    }
    public function pesquisar($pesquisa) {
        $query = "SELECT * FROM funcionarios WHERE nome LIKE ?";
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array('%'.$pesquisa.'%'));
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function atualizarFuncionario() {
        $query = "UPDATE funcionarios SET nome = ?, funçao = ?, contrato = ?, ctps = ?, telefone = ? WHERE id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $this->__get('nome'),
                $this->__get('funçao'),
                $this->__get('contrato'),
                $this->__get('ctps'),
                $this->__get('telefone'),
                $this->__get('id')
            )
        );
    }
}
?>