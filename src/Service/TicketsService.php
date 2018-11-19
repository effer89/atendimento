<?php

namespace Atendimento\Service;

use Atendimento\Entity\Tickets;
use Atendimento\Entity\TicketsMessages;
use Atendimento\Factory\TicketFactory;
use Doctrine\Common\Util\Debug;

class TicketsService {

    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function retrieveFromUser($userId)
    {
        return $this->em->getRepository('Atendimento\Entity\Tickets')->retrieveFromUser(array('user_id' => $userId));
    }

    public function retrieveStandBy()
    {
        return $this->em->getRepository('Atendimento\Entity\Tickets')->retrieveStandBy(array('has_owner' => false));
    }

    public function retrieve($ticketId)
    {
        return $this->em->getRepository('Atendimento\Entity\Tickets')->findOneBy(array('id' => $ticketId));
    }

    public function create($params)
    {
        TicketFactory::create($this->em, $params['subject'], $params['user_id'], $params['message']);
    }

    public function addMessage($params)
    {
        $ticket = $this->em->getRepository('Atendimento\Entity\Tickets')->findOneBy(array('id' => $params['ticket']));
        $user = $this->em->getRepository('Atendimento\Entity\Users')->findOneBy(array('id' => $params['user_id']));

        $ticketsMessages = new TicketsMessages();
        $ticketsMessages->setTicketId($ticket);
        $ticketsMessages->setUserId($user);
        $ticketsMessages->setMessage($params['message']);

        $this->em->persist($ticketsMessages);
        $this->em->flush();
    }

    public function setOwner($params)
    {
        $ticket = $this->em->getRepository('Atendimento\Entity\Tickets')->findOneBy(array('id' => $params['ticket']));
        $user = $this->em->getRepository('Atendimento\Entity\Users')->findOneBy(array('id' => $params['user_id']));

        $ticket->setHasOwner(true);

        $ticketsMessages = new TicketsMessages();
        $ticketsMessages->setTicketId($ticket);
        $ticketsMessages->setUserId($user);
        $ticketsMessages->setMessage('Olá, meu nome é '.$user->getName().' em que possa ajudar?');

        $this->em->persist($ticket);
        $this->em->persist($ticketsMessages);
        $this->em->flush();
    }
}