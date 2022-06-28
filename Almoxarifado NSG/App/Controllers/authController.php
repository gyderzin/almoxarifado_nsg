<?php
    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;        

    class authController extends Action{      
        
        public function autenticar() {
            // instancia da classe usuario e do database
            $usuario = Container::getModel('Usuario','users');

            // atribuindo valores aos atr da classe 
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);            

            // verificando se o usuario existe no database
            $retorno = $usuario->autenticação();

            if($usuario->__get('id') != '' && $usuario->__get('nome') != '') {
                session_start();
                $_SESSION['id'] = $usuario->__get('id');
                $_SESSION['nome'] = $usuario->__get('nome');
                $_SESSION['email'] = $usuario->__get('email');

                header('location:/seleciona_filial');
            }
            else {
                header('location:/?login=invalido');
            }                    
        }
        public function validarFilial() {
           session_start();        
           $_SESSION['filial'] = $_POST['filial'];
           header('location:/painel_materiais');
        }
        
     
    }
        
    



?>

