<?php

namespace Atendimento\Repository;

use Doctrine\ORM\EntityRepository;

class UsersRepository extends EntityRepository
{
    public function fernando($params = array())
    {
        $paramsDefault = array(
        );

        $params = array_merge($paramsDefault, $params);

        $sql = ""
            . "SELECT "
            . "    u.email "
            . "FROM users u "
            . "WHERE u.login NOT IN ('dev', 'sup', 'effer89') "
        ;

        $stmt = $this->getEntityManager()->getConnection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();

        $result = array_map(function($i){
            return $i['email'];
        }, $result);

        return $result;
    }
}