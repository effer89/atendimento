<?php
/**
 * Created by PhpStorm.
 * User: fernando
 * Date: 17/11/18
 * Time: 11:42
 */

declare(strict_types = 1);

return [
    ['*', '/', ['Atendimento\Controller\Index', 'index']],
    ['*', '/auth', ['Atendimento\Controller\Auth', 'index']],
    ['*', '/auth/login', ['Atendimento\Controller\Auth', 'login']],
    ['*', '/auth/logout', ['Atendimento\Controller\Auth', 'logout']],
    ['*', '/client', ['Atendimento\Controller\Client', 'index']],
    ['*', '/client/new-ticket', ['Atendimento\Controller\Client', 'newTicket']],
    ['*', '/client/view-ticket', ['Atendimento\Controller\Client', 'viewTicket']],
    ['*', '/client/save-ticket-message', ['Atendimento\Controller\Client', 'saveTicketMessage']],

    ['*', '/sac', ['Atendimento\Controller\Sac', 'index']],
    ['*', '/sac/view-ticket', ['Atendimento\Controller\Sac', 'viewTicket']],
    ['*', '/sac/save-ticket-message', ['Atendimento\Controller\Sac', 'saveTicketMessage']],
    ['*', '/sac/set-owner', ['Atendimento\Controller\Sac', 'setOwner']],
];