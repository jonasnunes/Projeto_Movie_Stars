<?php
    include_once("templates/header.php");
    include_once("dao/userDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken();
?>

    <div id="main-container" class="container-fluid">
        <h1>Edição de Perfil</h1>
    </div>

<?php include_once("templates/footer.php"); ?>