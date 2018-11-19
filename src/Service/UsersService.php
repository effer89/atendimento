<?php

namespace Atendimento\Service;

class UsersService {

    private $em;

    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validate($data)
    {
        $result = $this->em->getRepository('Atendimento\Entity\Users')->findOneBy(array(
            'login' => $data['login'],
            'password' => $data['password']
        ));

        if($result){
            return $result;
        }

        return false;
    }

    public function getLogins()
    {
        $result = $this->em->getRepository('Atendimento\Entity\Users')->findBy(array(
            'status' => 1
        ));

        return $result;
    }
}