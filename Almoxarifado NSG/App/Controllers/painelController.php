<?php
    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;   
    
    session_start();

    class painelController extends Action{              
        //              ****PAINEIS****
        public function painel_materiais() {
            if(isset($_SESSION['filial']) == false) {
                header('Location:/?filial=invalido');
            }                        
            $material = Container::getModel('Material');
            $this->view->conexao = $material;            
            if (isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {                
                $this->view->materiais = $material->pesquisar($_GET['pesquisa']);
            }
            else {
                $this->view->materiais = $material->getAll();                       
            }
            $this->render('painel_materiais', 'layout_2');
        }

        public function painel_ferramentas() {   
            if(isset($_SESSION['filial']) == false) {
                header('Location:/?filial=invalido');
            }                     
            $ferramenta = Container::getModel('Ferramentas');
            $pendencias = Container::getModel('PendenciasFerramentas');
            $this->view->conexao = $ferramenta;                           
            $this->view->pendencias = $pendencias;                           
            if (isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {                
                $this->view->ferramenta = $ferramenta->pesquisar($_GET['pesquisa']);
            }
            else {
                $this->view->ferramenta = $ferramenta->getAll();                       
            }
            $this->render('painel_ferramentas', 'layout_2');
        }

        public function painel_historico() {
            if(isset($_SESSION['filial']) == false) {
                header('Location:/?filial=invalido');
            }
            $historico = Container::getModel('Historico');            
            if (isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {                
                $this->view->historico = $historico->pesquisar($_GET['pesquisa']);
            }
            else if(isset($_SESSION['filtro_historico']) && $_SESSION['filtro_historico'] != '') {
                $this->view->historico = $_SESSION['filtro_historico'];                
            }
            else {
                $n1 = getdate();               
                $mes = $n1['mon'];
                $dia = $n1['mday'];

                if(strlen($n1['mon']) == 1) {
                    $mes = '0'.$n1['mon'];
                }
                if(strlen($n1['mday']) == 1) {
                    $dia = '0'.$n1['mday'];
                }

                $dataAte = $n1['year'].'-'.$mes.'-'.$dia;                            
                $dataDe = date ( "Y-m-d", strtotime( "$dataAte -7 day "));                
                $_SESSION['dataDe']= $dataDe;              
                $_SESSION['dataAte'] = $dataAte;              
                $this->view->historico = $historico->getAll($dataDe, $dataAte);                                             
            }                     
            $this->render('painel_historico', 'layout_2');
        }

        public function painel_funcionarios() {
            $n1 = getdate();               
            $mes = $n1['mon'];
            $dia = $n1['mday'];

            if(strlen($n1['mon']) == 1) {
                $mes = '0'.$n1['mon'];
            }
            if(strlen($n1['mday']) == 1) {
                $dia = '0'.$n1['mday'];
            }

            $dataAte = $n1['year'].'-'.$mes.'-'.$dia;                            
            $dataDe = date ( "Y-m-d", strtotime( "$dataAte -7 day "));                
            $_SESSION['dataDe']= $dataDe;              
            $_SESSION['dataAte'] = $dataAte;   

            if(isset($_SESSION['filial']) == false) {
                header('Location:/?filial=invalido');
            }
            $this->view->conexaoFunc = $Funcionarios = Container::getModel('Funcionarios');

            if (isset($_GET['pesquisa']) && $_GET['pesquisa'] != '') {                
                $this->view->Funcionarios = $Funcionarios->pesquisar($_GET['pesquisa']);
            }
            else {
                $this->view->Funcionarios = $Funcionarios->getAll();                       
            }        
            $this->render('painel_funcionarios', 'layout_2');
        }
       
        
                                    // ****PAINEL MATERIAIS****

        public function novoMaterial() {
            $material = Container::getModel('Material');
            
            if($_POST['material'] == '' && $_POST['quantidade'] =='') {
                header('location:painel?enviado=erro');
            }
            else {
                $descriçaoMat = trim($_POST['material']);
                $material->__set('descriçao', $descriçaoMat);
                $material->__set('quantidade', $_POST['qtd-material']);                                        
                $material->novoMaterial();            
                
                header('location:painel_materiais?enviado=sucesso');
            }          
        }
        public function excluirMaterial() {
            $material = Container::getModel('Material');
            $descriçaoMat = trim($_POST['material']);
            $material->__set('descriçao', $descriçaoMat);            
            $retorno = $material->excluirMaterial();
            echo $retorno;
            if ($retorno >= '1') {
                header('location:/painel_materiais?excluido=sucesso');
            }
            else {
                header('location:/painel_materiais?excluido=erro');
            }
        }
        public function adicionarMaterial() {

            if($_POST['qtd-material'] != '' && $_POST['funcionarios'] != '0') {
                $material = Container::getModel('Material');                
                $material->__set('id', $_GET['id']);
                $material->__set('quantidade', $_POST['qtd-material']);
                    
                $material->adicionarMaterial();
                $n1 = $material->recuperarDados($_GET['id'], 'descriçao');
                $nomeMat = $n1[0]['descriçao'];                
                $historico = Container::getModel('Historico');
                $date = getdate();                
                
                $hora_registro = $date['hours'].':'.$date['minutes'];
                if (strlen($hora_registro) == '4') {
                    $hora_registro = $date['hours'].':0'.$date['minutes'];
                }                                                
                $historico->__set('data', $_POST['data']);
                $historico->__set('descriçao', $nomeMat);
                $historico->__set('tipo', 'M');
                $historico->__set('qtd',  $_POST['qtd-material']);
                $historico->__set('sd', 'Devolução');
                $historico->__set('funcionario',$_POST['funcionarios']);
                $historico->__set('agencia', $_POST['agencia']);
                $historico->__set('hora', $hora_registro);
                $historico->insert();
                
                header('location:/painel_materiais?adicionado=sucesso');
            }
            else {
                header('location:/painel_materiais?adicionado=erro');
            }
        }
        public function removerMaterial() {
            if($_POST['qtd-material'] != '') {
                $qtdAdd = $_POST['qtd-material'];
                $material = Container::getModel('Material');
                $material->__set('id', $_GET['id']);                
                $material->__set('quantidade', $_POST['qtd-material']);
                $n1 = $material->recuperarDados($_GET['id'], 'quantidade');
                $qtdAtual = $n1[0]['quantidade'];
                intval($qtdAdd);
                intval($qtdAtual);     
            
                            
                if($qtdAtual == '0') {
                    header('location:/painel_materiais?removido=erro');                    
                }     
                else if ($qtdAtual - $qtdAdd <= -1) {
                    header('location:/painel_materiais?removido=erro');             
                }
                else {
                $material->removerMaterial();
                $n1 = $material->recuperarDados($_GET['id'], 'descriçao');
                $nomeMat = $n1[0]['descriçao'];                
                $historico = Container::getModel('Historico');
                $date = getdate();                
                
                $hora_registro = $date['hours'].':'.$date['minutes'];
                if (strlen($hora_registro) == '4') {
                    $hora_registro = $date['hours'].':0'.$date['minutes'];
                }                                            
                $historico->__set('data', $_POST['data']);
                $historico->__set('descriçao', $nomeMat);
                $historico->__set('tipo', 'M');
                $historico->__set('qtd',  $_POST['qtd-material']);
                $historico->__set('sd', 'Saída');
                $historico->__set('funcionario',$_POST['funcionarios']);
                $historico->__set('agencia',$_POST['agencia']);
                $historico->__set('hora', $hora_registro);
                $historico->insert();                
                

                header('location:/painel_materiais?removido=sucesso');
                }
            }
            else {
                header('location:/painel_materiais?removido=erro');
            }
        }
        public function changeMaterial() {
            print_r($_POST);
            if($_POST['qtd-material'] != '' && $_POST['material'] != '') {
                $material = Container::getModel('Material');
                $material->__set('id', $_GET['id']);
                $descriçaoMat = trim( $_POST['material']);
                $material->__set('descriçao', $descriçaoMat);
                $material->__set('quantidade', $_POST['qtd-material']);                                        
                $material->changeMaterial();
                header('location:/painel_materiais?atualizado=sucesso');
            }
            else {
                header('location:/painel_materiais?atualizado=erro');
            }
        }
        public function pesquisar() {
            $material = Container::getModel('Material');
            $_POST['pesquisa'];
            $retorno = $material->pesquisar($_POST['pesquisa']);                      

            echo '<pre>';
            print_r($_POST);
            echo '</pre>';

            echo '<pre>';
            print_r($retorno);
            echo '</pre>';

            header("location:/painel_materiais?pesquisa=".$_POST['pesquisa']);
        }
        
                        // ****PAINEL DE FERRAMENTAS****

        public function novaFerramenta() {   
            $Ferramenta = Container::getModel('Ferramentas');            
            
            if($_POST['Ferramenta'] == '' && $_POST['quantidade'] =='') {
                header('location:painel_ferramentas?enviado=erro');
            }
            else {               
                $descriçaoFerr = trim($_POST['Ferramenta']);
                $Ferramenta->__set('descriçao', $descriçaoFerr);
                $Ferramenta->__set('quantidade', $_POST['qtd-Ferramenta']);                                        
                $Ferramenta->__set('funcionario', $_POST['funcionario']);    
                $Ferramenta->novaFerramenta();            
                
                header('location:painel_ferramentas?enviado=sucesso');
            }          
        }
        public function excluirFerramenta() {
            $Ferramenta = Container::getModel('Ferramentas');
            $descriçaoFerr = trim($_POST['Ferramenta']);
            $Ferramenta->__set('descriçao', $descriçaoFerr);            
            $retorno = $Ferramenta->validarExclusaoFerramenta();            
            echo $retorno;        
            if ($retorno == '1') {
                header('location:/painel_ferramentas?excluido=sucesso');
            }
            else if($retorno == '0') {
                  header('location:/painel_ferramentas?excluido=erro');
            }
            else {
                header('location:/painel_ferramentas?excluido='.$_POST['Ferramenta']);
            }
        }
        public function confirmExcluirFerramenta() {    
            foreach($_POST as $id_ferramenta) {
                $ferramenta = Container::getModel('Ferramentas');
                $ferramenta->excluirFerramenta($id_ferramenta);
            }
            header('location:/painel_ferramentas?excluido=sucesso');
        }
        public function adicionarFerramenta() {
                $auxiliar = null;
                $idPendencias = Array($_POST);
                $qtdPendencias = $_GET['qtdPendencias'];
                for ($x = 1; $x <= $qtdPendencias; $x++ ) {
                    unset($idPendencias['0']['agencia'.$x]);   
                }
                unset($idPendencias['0']['data']);                
                $id_pendencia = null;   
                            
                foreach($idPendencias as $valor) {                                        
                    echo '<pre>';
                    print_r($valor);
                    echo '</pre>';
                    $pendencia = Container::getModel('PendenciasFerramentas');                    
                    $ferramenta = Container::getModel('Ferramentas');
                    $n2 = $ferramenta->recuperarDados($_GET['id'], 'descriçao');
                    $nomeMat = $n2[0]['descriçao'];                                
                    $historico = Container::getModel('Historico');
                    $date = getdate();                                              
                    $hora_registro = $date['hours'].':'.$date['minutes'];
                    if (strlen($hora_registro) == '4') {
                        $hora_registro = $date['hours'].':0'.$date['minutes'];
                    }
                    $i = count($valor);   
                    $x = 0;        
                    foreach ($valor as $n2) {
                        $x++;
                        $id_pendencia = $n2;                        
                        $n1 = $pendencia->getPendenciaByID($id_pendencia);                     
                        echo '<pre>';
                        print_r($n1);
                        echo '</pre>';
                    
                        $auxiliar += $n1[0]['quantidade_pendente']; 
                        // INSERT NO HISTORICO                                
                        $historico->__set('data', $_POST['data']);
                        $historico->__set('descriçao', $nomeMat);
                        $historico->__set('tipo', 'F');
                        $historico->__set('qtd',  $n1[0]['quantidade_pendente']);
                        $historico->__set('sd', 'Devolução');
                        $historico->__set('funcionario', $n1[0]['funcionario']);
                        $historico->__set('agencia', $_POST['agencia'.$x]);
                        $historico->__set('hora', $hora_registro);
                        $historico->insert();
                        $pendencia->deletePendencia($id_pendencia);
                    }                                                                                               
                }                
                $ferramenta = Container::getModel('Ferramentas');
                $ferramenta->__set('id', $_GET['id']);
                $ferramenta->adicionarFerramenta($auxiliar);
                

                header('location:/painel_ferramentas?adicionado=sucesso');
        }
        public function removerFerramenta() {
            if($_POST['qtd-Ferramenta'] != '') {                        
                // instancia da Ferramenta e atualizaçao de dados
                $Ferramenta = Container::getModel('Ferramentas');
                $Ferramenta->__set('id', $_GET['id']);                
                $Ferramenta->__set('qtd_pendente', $_POST['qtd-Ferramenta']);                
                $n1 = $Ferramenta->recuperarDados($_GET['id'], 'quantidade');
                $n2 = $Ferramenta->recuperarDados($_GET['id'], 'qtd_pendente'); 
                $ferramentasPendentes = $n2['0']['qtd_pendente'];
                
                
                // transformando as strings do db em int
                $qtdAtual = $n1[0]['quantidade'];
                $qtdAdd = $_POST['qtd-Ferramenta'];   
                intval($qtdAdd);
                intval($qtdAtual);                             
                intval($ferramentasPendentes);          

                if($qtdAtual == '0') {
                    header('location:/painel_ferramentas?removido=erro');                    
                }     
                else if ($qtdAtual - $qtdAdd <= -1) {
                    header('location:/painel_ferramentas?removido=erro');             
                }
                else if ($ferramentasPendentes == $qtdAtual ) {
                    header('location:/painel_ferramentas?removido=erro');             
                }
                else {
                    $Ferramenta->removerFerramenta();
                    $n1 = $Ferramenta->recuperarDados($_GET['id'], 'descriçao');
                    $pendencias = Container::getModel('PendenciasFerramentas');

                    // INSERT NO HISTORICO
                    $nomeMat = $n1[0]['descriçao'];                
                    $historico = Container::getModel('Historico');
                    $date = getdate();                                              
                    $hora_registro = $date['hours'].':'.$date['minutes'];
                    if (strlen($hora_registro) == '4') {
                        $hora_registro = $date['hours'].':0'.$date['minutes'];
                    }                                                
                    $historico->__set('data', $_POST['data']);                                          
                    $historico->__set('descriçao', $nomeMat);
                    $historico->__set('tipo', 'F');
                    $historico->__set('qtd',  $_POST['qtd-Ferramenta']);
                    $historico->__set('sd', 'Saída');
                    $historico->__set('funcionario',$_POST['funcionarios']);
                    $historico->__set('agencia', $_POST['agencia']);
                    $historico->__set('hora', $hora_registro);
                    $historico->insert();
                    

                    // INSERT PENDENCIAS FERRAMENTAS
                   
                    $ferramentaAtual = $Ferramenta->recuperarDados($_GET['id'], '*');
                    $pendencias->__set('id_ferramenta', $ferramentaAtual['0']['id']);
                    $pendencias->__set('dia', $_POST['data']); 
                    $pendencias->__set('descriçao_ferramenta', $ferramentaAtual['0']['descriçao']);
                    $pendencias->__set('quantidade_pendente', $_POST['qtd-Ferramenta']);
                    $pendencias->__set('agencia', $_POST['agencia']);
                    $pendencias->__set('funcionario', $_POST['funcionarios']);
                    $pendencias->__set('hora', $hora_registro);                    
                  
                    $pendencias->novaPendencia();
                    header('location:/painel_ferramentas?removido=sucesso');

                }
            }
            else {
                header('location:/painel_ferramentas?removido=erro');
            }
        }
        public function changeFerramenta() {            
            if($_POST['qtd-Ferramenta'] != '' && $_POST['Ferramenta'] != '') {
                $Ferramenta = Container::getModel('Ferramentas');
                $pendencia = Container::getModel('PendenciasFerramentas');
                $ferrPendente = $pendencia->getFerramentaByID($_GET['id']);      
                $instaciaUser = Container::getModel('Usuario', 'users');
                $instaciaUser->__set('id', $_SESSION['id']);
                $usuario = $instaciaUser->recuperarUsuario();
                                    
                if($usuario['0']['tipo'] == 'User' &&  $_POST['qtd-Ferramenta'] == '0') {
                    header('location:/painel_ferramentas?atualizado=açao_bloqueada');
                }
                                                   
                else if(isset($ferrPendente['0']['quantidade_pendente']) && $_POST['qtd-Ferramenta'] < $ferrPendente['0']['quantidade_pendente']) {
                    header('location:/painel_ferramentas?atualizado=qtd_invalida');
                }
                else {
                    $Ferramenta->__set('id', $_GET['id']);
                    $descriçaoFerr = trim($_POST['Ferramenta']);
                    $Ferramenta->__set('descriçao', $descriçaoFerr);
                    $Ferramenta->__set('quantidade', $_POST['qtd-Ferramenta']);                                        
                    $Ferramenta->changeFerramenta();
                    header('location:/painel_ferramentas?atualizado=sucesso');
                }
            }
            else {
                header('location:/painel_ferramentas?atualizado=erro');
            }
        }
        public function pesquisarFerramenta() {
            $Ferramenta = Container::getModel('Ferramentas');
            $_POST['pesquisa'];
            $retorno = $Ferramenta->pesquisar($_POST['pesquisa']);                                 
       
            header("location:/painel_ferramentas?pesquisa=".$_POST['pesquisa']);
        }       
                    //      ****PAINEL HISTORICO****
         public function pesquisarHistorico () {
            $material = Container::getModel('Historico');
            $_POST['pesquisa'];
            $retorno = $material->pesquisar($_POST['pesquisa']);                      

            if ($_POST['pesquisa'] != '') {
                header("location:/painel_historico?pesquisa=".$_POST['pesquisa']);
            }
            else {
                header("location:/painel_historico?pesquisa=");
            }
        }
                     
        public function filtrarDataHistorico() {         
            $historico = Container::getModel('Historico');
            $filtro = $historico->filtrarData($_POST['data_historico_de'], $_POST['data_historico_ate']);            
            $_SESSION['filtro_historico'] = $filtro;     
            $_SESSION['dataDe'] = $_POST['data_historico_de'];
            $_SESSION['dataAte'] = $_POST['data_historico_ate'];

            header('location:/painel_historico');
        }

        // PAINEL FUNCIONARIOS
        public function novoFuncionario() {
           $funcionario = Container::getModel('Funcionarios');
           $funcionario->__set('nome', $_POST['nome']);
           $funcionario->__set('funçao', $_POST['funçao']);
           $funcionario->__set('contrato', $_POST['contrato']);
           $funcionario->__set('ctps', $_POST['ctps']);
           $funcionario->__set('telefone', $_POST['telefone']);
           $funcionario->novoFuncionario();
           header('location:/painel_funcionarios?novoFunc=sucesso');                  
        }
        public function desligarFuncionario() {
            $funcionario = Container::getModel('Funcionarios');
            $funcionario->__set('nome', $_POST['funcionarios']);
            $funcionario->desligarFuncionario();
            header('location:/painel_funcionarios?desligaFunc=sucesso');                  
        }
        public function pesquisarFuncionario() {
            $funcionario = Container::getModel('Funcionarios');
            $filtro = $_POST['pesquisa'];
            $pesquisa = $funcionario->pesquisar($filtro);            
            header("location:/painel_funcionarios?pesquisa=".$_POST['pesquisa']);            
        }
        public function editarFuncionario() {       
            $funcionario = Container::getModel('Funcionarios');
            $funcionario->__set('id', $_GET['id']);
            $funcionario->__set('nome', $_POST['nome']);
            $funcionario->__set('funçao', $_POST['funçao']);
            $funcionario->__set('contrato', $_POST['contrato']);
            $funcionario->__set('ctps', $_POST['ctps']);
            $funcionario->__set('telefone', $_POST['telefone']);
            $funcionario->atualizarFuncionario();
            header("location:/painel_funcionarios?atualizaçao=sucesso");
        }

       

    }
?>
