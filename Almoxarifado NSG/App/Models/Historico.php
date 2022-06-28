<?php
namespace App\Models;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Model;
     
class Historico extends Model {                      
    private $id;
    private $data;
    private $descriçao;      
    private $tipo;
    private $qtd;
    private $sd;
    private $funcionario;
    private $agencia = '';
    private $hora;

    public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function insert() {
        $query =
        'insert into historico(
            data, descriçao, tipo, qtd, sd, funcionario, agencia, hora)
        VALUES(
            ?,?,?,?,?,?,?,?
        )';
        $stmt = $this->db->prepare($query);   
        $stmt->execute(array(
            $this->__get('data'),
            $this->__get('descriçao'),
            $this->__get('tipo'), 
            $this->__get('qtd'), 
            $this->__get('sd'), 
            $this->__get('funcionario'), 
            $this->__get('agencia'), 
            $this->__get('hora'),
        ));        
    }
    public function getAll($de, $ate) {
        $query = 'SELECT id, DATE_FORMAT(data, "%d/%m/%Y") as data, descriçao, tipo, qtd, sd, funcionario, agencia, hora FROM `historico` WHERE data BETWEEN ? AND ?';
        $stmt =  $this->db->prepare($query);
        $stmt->execute(array($de, $ate));
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function pesquisar($pesquisa) {
        $query = "SELECT id, DATE_FORMAT(data, '%d/%m/%Y') as data, descriçao, tipo, qtd, sd, funcionario, agencia, hora FROM historico WHERE descriçao LIKE ? AND data BETWEEN ? AND ?";
        $stmt = $this->db->prepare($query);        
        $stmt->execute(array('%'.$pesquisa.'%', $_SESSION['dataDe'], $_SESSION['dataAte']));
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function filtrarData($de, $ate) {
        $query = "SELECT  id, DATE_FORMAT(data, '%d/%m/%Y') as data, descriçao, tipo, qtd, sd, funcionario, agencia, hora FROM historico WHERE data BETWEEN ? AND ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute(array($de, $ate));

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>
