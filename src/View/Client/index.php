<div class="card">
    <div class="card-header">
        Olá <?php echo $this->userData->getName();?>! <span style="float: right"><a href="<?php echo baseUrl;?>/auth/logout">Sair</a></span>
    </div>
    <div class="card-body">
        <h5 class="card-title">Meus Tickets</h5>

        <p class="card-text">

            <?php if(count($this->tickets) > 0):?>
                <div class="list-group">
                    <?php foreach($this->tickets as $ticket):?>
                        <a href="<?php echo baseUrl;?>/client/view-ticket?ticket=<?php echo $ticket->getId();?>" class="list-group-item list-group-item-action">
                            <span class="badge badge-secondary"><?php echo $ticket->getCreated()->format('d/m/Y H:i');?></span>
                            <?php echo $ticket->getSubject();?>
                        </a>
                    <?php endforeach;?>
                </div>
            <?php else:?>
                <div class="alert alert-primary" role="alert">
                    Nenhum ticket ativo encontrado.
                </div>
            <?php endif;?>

        </p>
        <a href="<?php echo baseUrl;?>/client/new-ticket" class="btn btn-primary">Novo Ticket</a>
    </div>
</div>