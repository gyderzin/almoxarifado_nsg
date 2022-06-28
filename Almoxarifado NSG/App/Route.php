<?php

    namespace App;
    
    use MF\init\bootstrap;

    class Route extends bootstrap{

        protected function initRoutes() {
            
            // index

            $routes['home'] = array(                
                'route' => '/',
                'controller' => 'indexController',
                'action' => 'index'
            );
            $routes['inscreverse'] = array(
                'route' => '/inscreverse',
                'controller' => 'indexController',
                'action' => 'inscreverse'
            );
            $routes['registrar'] = array(
                'route' => '/registrar',
                'controller' => 'indexController',
                'action' => 'registrar'
            );
            $routes['seleciona_filial'] = array(
                'route' => '/seleciona_filial',
                'controller' => 'indexController',
                'action' => 'seleciona_filial'
            );
            $routes['validarFilial'] = array(
                'route' => '/validarFilial',
                'controller' => 'authController',
                'action' => 'validarFilial'
            );            
            $routes['autenticar'] = array(
                'route' => '/autenticar',
                'controller' => 'authController',
                'action' => 'autenticar'
            );
            $routes['logout'] = array(
                'route' => '/logout',
                'controller' => 'indexController',
                'action' => 'logout'
            );

            // paineis
            $routes['painel_materiais'] = array(
                'route' => '/painel_materiais',
                'controller' => 'painelController',
                'action' => 'painel_materiais'
            );
            $routes['painel_ferramentas'] = array(
                'route' => '/painel_ferramentas',
                'controller' => 'painelController',
                'action' => 'painel_ferramentas'
            );
            $routes['painel_historico'] = array(
                'route' => '/painel_historico',
                'controller' => 'painelController',
                'action' => 'painel_historico'
            );     
            $routes['painel_funcionarios'] = array(
                'route' => '/painel_funcionarios',
                'controller' => 'painelController',
                'action' => 'painel_funcionarios'
            );         
            
            // materiais

            $routes['novoMaterial'] = array(
                'route' => '/novoMaterial',
                'controller' => 'painelController',
                'action' => 'novoMaterial'
            );
            $routes['excluirMaterial'] = array(
                'route' => '/excluirMaterial',
                'controller' => 'painelController',
                'action' => 'excluirMaterial'
            );
            $routes['adicionarMaterial'] = array(
                'route' => '/adicionarMaterial',
                'controller' => 'painelController',
                'action' => 'adicionarMaterial'
            );
            $routes['removerMaterial'] = array(
                'route' => '/removerMaterial',
                'controller' => 'painelController',
                'action' => 'removerMaterial'
            );
            $routes['changeMaterial'] = array(
                'route' => '/changeMaterial',
                'controller' => 'painelController',
                'action' => 'changeMaterial'
            );
            $routes['pesquisar'] = array(
                'route' => '/pesquisar',
                'controller' => 'painelController',
                'action' => 'pesquisar'
            );
            
            // ferramentas

            $routes['novaFerramenta'] = array(
                'route' => '/novaFerramenta',
                'controller' => 'painelController',
                'action' => 'novaFerramenta'
            );
            $routes['excluirFerramenta'] = array(
                'route' => '/excluirFerramenta',
                'controller' => 'painelController',
                'action' => 'excluirFerramenta'
            );
            $routes['confirmExcluirFerramenta'] = array(
                'route' => '/confirmExcluirFerramenta',
                'controller' => 'painelController',
                'action' => 'confirmExcluirFerramenta'
            );
            $routes['adicionarFerramenta'] = array(
                'route' => '/adicionarFerramenta',
                'controller' => 'painelController',
                'action' => 'adicionarFerramenta'
            );
            $routes['removerFerramenta'] = array(
                'route' => '/removerFerramenta',
                'controller' => 'painelController',
                'action' => 'removerFerramenta'
            );
            $routes['changeFerramenta'] = array(
                'route' => '/changeFerramenta',
                'controller' => 'painelController',
                'action' => 'changeFerramenta'
            );
            $routes['pesquisarFerramenta'] = array(
                'route' => '/pesquisarFerramenta',
                'controller' => 'painelController',
                'action' => 'pesquisarFerramenta'
            );
            $routes['pesquisarHistorico'] = array(
                'route' => '/pesquisarHistorico',
                'controller' => 'painelController',
                'action' => 'pesquisarHistorico'
            );  

            // painel funcionarios
            
            $routes['novoFuncionario'] = array(
                'route' => '/novoFuncionario',
                'controller' => 'painelController',
                'action' => 'novoFuncionario'
            ); 
            $routes['desligarFuncionario'] = array(
                'route' => '/desligarFuncionario',
                'controller' => 'painelController',
                'action' => 'desligarFuncionario'
            );           
            $routes['pesquisarFuncionario'] = array(
                'route' => '/pesquisarFuncionario',
                'controller' => 'painelController',
                'action' => 'pesquisarFuncionario'
            ); 
            $routes['editarFuncionario'] = array(
                'route' => '/editarFuncionario',
                'controller' => 'painelController',
                'action' => 'editarFuncionario'
            );          

            // historio
            $routes['filtrarDataHistorico'] = array(
                'route' => '/filtrarDataHistorico',
                'controller' => 'painelController',
                'action' => 'filtrarDataHistorico'
            );          
            
            $this->setRoutes($routes);
        }

       
    }

?>