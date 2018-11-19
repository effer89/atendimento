<?php

namespace Atendimento\Controller;

use Atendimento\Service\TicketsService;

class Client extends Application
{
    private $view;

    private $em;

    public function __construct(\Aura\View\View $view, \Doctrine\ORM\EntityManager $entityManager)
    {
        parent::__construct();
        $this->view = $view;
        $this->em = $entityManager;
    }

    public function index()
    {
        $userData = $this->getUserData();

        $ticketsService = new TicketsService($this->em);
        $tickets = $ticketsService->retrieveFromUser($userData->getId());

        $this->view->setData(array(
            'userData' => $userData,
            'tickets' => $tickets,
        ));
    }

    public function newTicket()
    {
        $userData = $this->getUserData();

        if($this->isPost()){
            $data = $this->getData();
            $data['user_id'] = $userData->getId();

            $ticketsService = new TicketsService($this->em);
            $ticketsService->create($data);

            $this->redirect('/client');
        }

        $this->view->setData(array(
            'userData' => $userData,
        ));
    }

    public function viewTicket()
    {
        $userData = $this->getUserData();

        $data = $this->getData();

        $ticketsService = new TicketsService($this->em);
        $ticket = $ticketsService->retrieve((int)$data['ticket']);

        if(!$ticket){
            $this->redirect('/client');
        }

        $this->view->setData(array(
            'userData' => $userData,
            'ticket' => $ticket,
        ));
    }

    public function saveTicketMessage()
    {
        if($this->isPost()) {

            $userData = $this->getUserData();

            $data = $this->getData();

            $data['user_id'] = $userData->getId();

            $ticketsService = new TicketsService($this->em);
            $ticket = $ticketsService->addMessage($data);

            $this->redirect('/client/view-ticket?ticket='.$data['ticket']);
        }
    }
}