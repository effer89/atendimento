<?php

namespace Atendimento\Controller;

use Doctrine\Common\Util\Debug;

class Auth extends Application
{
    private $view;

    private $em;

    public function __construct(\Aura\View\View $view, \Doctrine\ORM\EntityManager $entityManager)
    {
        $this->view = $view;
        $this->em = $entityManager;
    }

    public function index()
    {
        $usersService = new \Atendimento\Service\UsersService($this->em);
        $logins = $usersService->getLogins();

        $this->view->setData(array(
            'logins' => $logins
        ));
    }

    public function login()
    {
        if($this->isPost()){
            $usersService = new \Atendimento\Service\UsersService($this->em);
            $userData = $usersService->validate($this->getData());

            if($userData){
                $this->session('set', 'userData', $userData);

                if($userData->getUsertype() == \Atendimento\Enum\UserType::sac){
                    $this->redirect('/sac');
                }else{
                    $this->redirect('/client');
                }
            }
        }

        $this->redirect('/auth');
        exit;
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/');
    }
}