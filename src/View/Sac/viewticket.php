<div class="card">
    <div class="card-header">
        Olá <?php echo $this->userData->getName();?>! <span style="float: right"><a href="<?php echo baseUrl;?>/auth/logout">Sair</a></span>
    </div>
    <div class="card-body">
        <p class="card-text"><a href="<?php echo baseUrl;?>/sac">< Voltar</a></p>

        <h5 class="card-title">Ticket: <?php echo $this->ticket->getSubject();?></h5>

        <hr>

        <?php foreach($this->ticket->getMessages() as $message):?>

            <?php if($message->getUserId()->getUserType() == 1):?>
                <!-- atendente -->
                <p class="card-text text-primary">
                    <span class="badge badge-dark"><?php echo $message->getUserId()->getName();?></span>
                    <?php echo $message->getMessage();?>
                </p>
            <?php else:?>
                <!-- cliente -->
                <p class="card-text text-info">
                    <span class="badge badge-light"><?php echo $message->getUserId()->getName();?></span>
                    <?php echo $message->getMessage();?>
                </p>
            <?php endif;?>

            <?php $textColor = $message->getUserId()->getUserType() == 2 ? 'text-primary' : 'text-info'?>
        <?php endforeach;?>

        <?php if($this->ticket->getHasOwner()):?>
            <form method="post" action="<?php echo baseUrl;?>/client/save-ticket-message">
                <div class="input-group mb-3">
                    <input name="message" type="text" class="form-control" placeholder="Escreva sua mensagem aqui." aria-label="Escreva sua mensagem aqui." aria-describedby="basic-addon2">
                    <input name="ticket" type="hidden" value="<?php echo $this->ticket->getId();?>">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Enviar</button>
                    </div>
                </div>
            </form>
        <?php else:?>
            <div class="alert alert-warning" role="alert">
                Este ticket ainda não foi adotado! <a href="<?php echo baseUrl;?>/sac/set-owner?ticket=<?php echo $this->ticket->getId();?>">Clique para adotar!</a>
            </div>
        <?php endif;?>

    </div>
</div>