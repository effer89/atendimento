<?php

namespace Atendimento\Controller;

class Index extends Application
{
    private $view;

    public function __construct(\Aura\View\View $view, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->view = $view;
    }

    public function index()
    {
//        $usersService = new \Atendimento\Service\UsersService();
//        $this->view->setData(array('fernando' => 'fernandes'));
        $this->redirect('/auth');
    }
}