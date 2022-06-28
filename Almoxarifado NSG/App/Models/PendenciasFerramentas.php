<?php
namespace App\Models;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Model;

class PendenciasFerramentas extends Model {
    private $id;
    private $id_ferramenta;
    private $descriçao_ferramenta;    
    private $quantidade_pendente;    
    private $agencia;
    private $funcionario;    
    private $dia;
    private $hora;

    public function __get($atributo) {
        return $this->$atributo;
    }
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
    public function getAll() {
        $query = 
        'SELECT 
            id, id_ferramenta, descriçao_ferramenta, quantidade_pendente, agencia,funcionario, DATE_FORMAT(dia, "%d/%m/%Y") as dia, hora
        FROM 
            pendencias_ferramentas ORDER BY id';

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }  
    public function novaPendencia() {
        $query = '
        INSERT INTO 
            pendencias_ferramentas
        (id_ferramenta, descriçao_ferramenta, quantidade_pendente, agencia, funcionario,dia, hora)
        VALUES
            (?,?,?,?,?,?,?)
        ';
        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $this->__get('id_ferramenta'),
                $this->__get('descriçao_ferramenta'),
                $this->__get('quantidade_pendente'),
                $this->__get('agencia'),
                $this->__get('funcionario'),
                $this->__get('dia'),
                $this->__get('hora')
            )
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function deletePendencia($id) {
        $query = 'DELETE FROM pendencias_ferramentas WHERE id = ?';
        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $id
            )
        );
    }
    public function getFerramentaByID($id) {
        $query = 
        'SELECT 
            id, id_ferramenta, descriçao_ferramenta, quantidade_pendente, agencia, funcionario, DATE_FORMAT(dia, "%d/%m/%Y") as dia, hora
         FROM
             pendencias_ferramentas
        WHERE 
            id_ferramenta = ?';

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $id
            )
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getPendenciaByID($id) {
        $query = 
        'SELECT 
            id, id_ferramenta, descriçao_ferramenta, quantidade_pendente, agencia, funcionario, DATE_FORMAT(dia, "%d/%m/%Y") as dia, hora
         FROM
             pendencias_ferramentas
        WHERE 
            id = ?';

        $stmt = $this->db->prepare($query);
        $stmt->execute(
            array(
                $id
            )
        );
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
?>