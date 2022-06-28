<?php
    namespace App\Controllers;

    //os recursos do miniframework
    use MF\Controller\Action;
    use MF\Model\Container;        

    class indexController extends Action{      

        public function index() {                
            $this->view->emailEmUso = 'NAO'; 
            $this->view->infoInvalida = false;
            $this->render('index');           
        }
        public function seleciona_filial(){
            session_start();
            if(isset($_SESSION['id']) == false ) {
                header('Location:/?login=invalido');
            }
            else if (isset($_SESSION['id']) && $_SESSION['id'] != '') {                
                $this->render('seleciona_filial');
            }
            
        }
        public function inscreverse() {
            $this->render('inscreverse');
        }
        public function registrar() {                              
            $usuario = Container::getModel('Usuario', 'users');
            $usuario->__set('nome', $_POST['nome']);
            $usuario->__set('email', $_POST['email']);
            $usuario->__set('senha', $_POST['senha']);
            $usuario->__set('tipo', 'User');
            // validar dados            
            if($usuario->validarDados() == true) {                
                // verificar se o email esta em uso
                 if (count($usuario->getUsuarioPorEmail()) <= 0) {                   
                    $usuario->salvar();
                    header('location: /');
                 }                 
                 else if (count($usuario->getUsuarioPorEmail()) <= 1) {                    
                 header('location:/inscreverse?usuarioExiste=sim');
                }
            }
            if ($usuario->validarDados() == false) {                
                header('location:/inscreverse?faltaInfo=sim');
            }
        }
        public function logout() {
            session_start();
            session_destroy();

            header('Location:/');
        }
     
    }
        
    



?>