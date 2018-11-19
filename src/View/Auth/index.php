<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
    }

    .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
    .form-signin .checkbox {
        font-weight: 400;
    }
    .form-signin .form-control {
        position: relative;
        box-sizing: border-box;
        height: auto;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }
    .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }
    .logins {
        position: absolute;
        top: 0;
        left: 0;
    }
    .logins p {
        margin-bottom: 0;
    }
</style>

<div class="logins">
    <?php foreach($this->logins as $login):?>
        <p><?php echo $login->getLogin();?> : <?php echo $login->getPassword();?></p>
    <?php endforeach?>
</div>

<form class="form-signin" method="post" action="<?php echo baseUrl;?>/auth/login">
    <img class="mb-4" src="<?php echo baseUrl;?>/images/bootstrap-solid.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input name="login" type="login" id="inputLogin" class="form-control" placeholder="Login" required autofocus value="cliente1">
    <label for="inputPassword" class="sr-only">Password</label>
    <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Password" required value="123">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>
