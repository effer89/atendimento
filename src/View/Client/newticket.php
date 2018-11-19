<div class="card">
    <div class="card-header">
        Olá <?php echo $this->userData->getName();?>! <span style="float: right"><a href="<?php echo baseUrl;?>/auth/logout">Sair</a></span>
    </div>
    <div class="card-body">
        <p class="card-text"><a href="<?php echo baseUrl;?>/client">< Voltar</a></p>

        <h5 class="card-title">Novo Ticket</h5>

        <p class="card-text">

            <form method="post" action="<?php echo baseUrl;?>/client/new-ticket">
                <div class="form-group row">
                    <label for="subject" class="col-sm-2 col-form-label">Assunto</label>
                    <div class="col-sm-10">
                        <input name="subject" type="text" class="form-control" id="subject" placeholder="Ex.: Problemas com pagamento" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea name="message" class="form-control" id="message" rows="3" required></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>

        </p>
    </div>
</div>