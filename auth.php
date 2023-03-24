<?php
    include_once("templates/header.php");
?>

    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <div class="row" id="auth-row">
                <div class="col-md-4" id="login-container">
                    <h2>Entrar</h2>
                    <form action="<?=$BASE_URL?>auth-process.php" method="POST">
                        <input type="hidden" name="type" value="login">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" placeholder="Digite seu e-mail" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input class="form-control" type="password" placeholder="Digite sua senha" id="password" name="password" required>
                        </div>
                        <input type="submit" class="btn card-btn" value="Entrar">
                    </form>
                </div>
                <div class="col-md-4" id="register-container">
                    <h2>Criar Conta</h2>
                    <form action="<?=$BASE_URL?>auth-process.php" method="POST">
                        <input type="hidden" name="type" value="register">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input class="form-control" type="email" placeholder="Ex.: fulano@moviestar.com" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input class="form-control" type="text" placeholder="Digite seu nome" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome</label>
                            <input class="form-control" type="text" placeholder="Digite seu sobrenome" id="lastname" name="lastname">
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input class="form-control" type="password" placeholder="Digite sua senha" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="confirm-password">Confirmação de senha</label>
                            <input class="form-control" type="password" placeholder="Confirme sua senha" id="confirm-password" name="confirm-password" required>
                        </div>
                        <input type="submit" class="btn card-btn" value="Registrar">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include_once("templates/footer.php"); ?>