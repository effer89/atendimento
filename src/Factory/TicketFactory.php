<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 18/11/18
 * Time: 01:07
 */

namespace Atendimento\Factory;

class TicketFactory {

    public static function create(\Doctrine\ORM\EntityManager $em, $subject, $userId, $message)
    {
        return new Ticket($em, $subject, $userId, $message);
    }
}