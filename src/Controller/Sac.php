<?php

namespace Atendimento\Controller;

use Atendimento\Service\TicketsService;
use Doctrine\Common\Util\Debug;

class Sac extends Application
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
        $userData = $this->getUserData();

        $ticketsService = new TicketsService($this->em);
        $tickets = $ticketsService->retrieveFromUser($userData->getId());

        $ticketsStandBy = $ticketsService->retrieveStandBy();

        $this->view->setData(array(
            'userData' => $userData,
            'tickets' => $tickets,
            'ticketsStandBy' => $ticketsStandBy,
        ));
    }

    public function viewTicket()
    {
        $userData = $this->getUserData();

        $data = $this->getData();

        $ticketsService = new TicketsService($this->em);
        $ticket = $ticketsService->retrieve((int)$data['ticket']);

        if(!$ticket){
            $this->redirect('/sac');
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
            $ticketsService->addMessage($data);

            $this->redirect('/sac/view-ticket?ticket='.$data['ticket']);
        }
    }

    public function setOwner()
    {
        $data = $this->getData();

        $userData = $this->getUserData();

        $data['user_id'] = $userData->getId();

        $ticketsService = new TicketsService($this->em);
        $ticketsService->setOwner($data);

        $this->redirect('/sac/view-ticket?ticket='.$data['ticket']);
    }
}