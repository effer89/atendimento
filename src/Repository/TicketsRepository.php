<?php

namespace Atendimento\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;

class TicketsRepository extends EntityRepository
{
    public function retrieveFromUser($params = array())
    {
        $paramsDefault = array(
            'user_id' => null
        );

        $params = array_merge($paramsDefault, $params);

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('Atendimento\Entity\Tickets', 'a');
        $rsm->addFieldResult('a', 'id', 'id');
        $rsm->addFieldResult('a', 'subject', 'subject');
        $rsm->addFieldResult('a', 'rating', 'rating');
        $rsm->addFieldResult('a', 'finalized', 'finalized');
        $rsm->addFieldResult('a', 'status', 'status');
        $rsm->addFieldResult('a', 'created', 'created');
        $rsm->addFieldResult('a', 'updated', 'updated');

        $sql = 'SELECT '
            . '    t.id, t.subject, t.rating, t.finalized, t.status, t.created, t.updated '
            . 'FROM tickets t '
            . 'INNER JOIN tickets_messages tm ON tm.ticket_id = t.id '
            . 'WHERE t.status = 1 AND tm.user_id = :user_id '
            . 'GROUP BY t.id '
            . 'ORDER BY t.created DESC '
        ;

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter('user_id', $params['user_id']);

        return $query->getResult();
    }

    public function retrieveStandBy($params = array())
    {
        $paramsDefault = array(
        );

        $params = array_merge($paramsDefault, $params);

        $rsm = new ResultSetMapping();
        $rsm->addEntityResult('Atendimento\Entity\Tickets', 'a');
        $rsm->addFieldResult('a', 'id', 'id');
        $rsm->addFieldResult('a', 'subject', 'subject');
        $rsm->addFieldResult('a', 'rating', 'rating');
        $rsm->addFieldResult('a', 'finalized', 'finalized');
        $rsm->addFieldResult('a', 'status', 'status');
        $rsm->addFieldResult('a', 'created', 'created');
        $rsm->addFieldResult('a', 'updated', 'updated');

        $sql = 'SELECT '
            . '    t.id, t.subject, t.rating, t.finalized, t.status, t.created, t.updated '
            . 'FROM tickets t '
            . 'INNER JOIN tickets_messages tm ON tm.ticket_id = t.id '
            . 'WHERE t.status = 1 AND t.has_owner = false '
            . 'GROUP BY t.id '
            . 'ORDER BY t.created DESC '
        ;

        $query = $this->_em->createNativeQuery($sql, $rsm);

        return $query->getResult();
    }
}