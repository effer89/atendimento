<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 18/11/18
 * Time: 01:07
 */

namespace Atendimento\Factory;

use Atendimento\Entity\Tickets;
use Atendimento\Entity\TicketsMessages;

class Ticket {

    private $em;

    private $subject;

    private $userId;

    private $message;

    public function __construct(\Doctrine\ORM\EntityManager $em, $subject, $userId, $message)
    {
        $this->em = $em;

        $this->subject = $subject;

        $this->userId = $userId;

        $this->message = $message;

        $user = $this->em->getRepository('Atendimento\Entity\Users')->findOneBy(array('id' => $this->userId));

        $tickets = new Tickets();
        $tickets->setSubject($this->subject);

        $ticketsMessages = new TicketsMessages();
        $ticketsMessages->setTicketId($tickets);
        $ticketsMessages->setUserId($user);
        $ticketsMessages->setMessage($this->message);

        $this->em->persist($tickets);
        $this->em->persist($ticketsMessages);
        $this->em->flush();
    }
}