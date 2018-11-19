<?php

namespace Atendimento\Controller;

class Application
{
    public function __construct()
    {
        $this->isLogged();
    }

    /**
     * Metodo usado para fazer os redirects
     */
    public function redirect($to)
    {
        header('Location: '.baseUrl.$to);
        exit;
    }

    /**
     * Verifica se a requisicao e post
     */
    public function isPost()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            return true;
        }

        return false;
    }

    /**
     * Retorna os parametros submetidos pelo request GET/POST
     */
    public function getData()
    {
        if($this->isPost()){
            return $_POST;
        }

        return $_GET;
    }

    /**
     * Metodo responsavel por salvar e recuperar items da sessao
     * @param string $method (get/set)
     * @param $name
     * @param * $value
     * @return mixed
     */
    public function session($method = 'set', $name, $value = null)
    {
        if($method == 'set'){
            $_SESSION[$name] = serialize($value);
        }else{
            if(isset($_SESSION[$name])){
                return unserialize($_SESSION[$name]);
            }

            return false;
        }
    }

    /**
     * Retorna os dados do usuario logado
     */
    public function getUserData()
    {
        return $this->session('get', 'userData');
    }

    /**
     * Se nao possuir sessao ativa, joga para a tela de login
     */
    public function isLogged()
    {
        if(!$this->getUserData()){
            $this->redirect('/');
        }
    }
}