<?php
    include_once("templates/header.php");

    // Verifica se o usuário está autenticado
    include_once("models/user.php");
    include_once("dao/userDAO.php");

    $user = new User();

    $userDao = new UserDAO($conn, $BASE_URL);

    $userData = $userDao->verifyToken(true);
?>

    <div id="main-container" class="container-fluid">

        <div class="offset-md-4 col-md-4 new-movie-container">

            <h1 class="page-title">Adicionar Filme</h1>
            <p class="page-description">Adicione sua crítica e compartihe com o mundo!</p>

            <form id="add-movie-form" action="<?=$BASE_URL?>movie-process.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="type" value="create">

                <div class="form-group">

                    <label for="title">Título</label>
                    <input class="form-control" type="text" id="title" name="title" placeholder="Digite o título do seu filme">

                </div>

                <div class="form-group">

                    <label for="image">Imagem</label>
                    <input class="form-control-image" type="file" id="image" name="image">

                </div>

                <div class="form-group">

                    <label for="length">Duração</label>
                    <input class="form-control" type="text" id="length" name="length" placeholder="Digite a duração do filme">

                </div>

                <div class="form-group">

                    <label for="category">Categoria</label>
                    <select name="category" id="category" class="form-control">
                        <option value="">Selecione</option>
                        <option value="Ação">Ação</option>
                        <option value="Drama">Drama</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Ficção">Ficção</option>
                        <option value="Romance">Romance</option>
                    </select>

                </div>

                <div class="form-group">

                    <label for="trailer">Trailer</label>
                    <input type="text" class="form-control" id="trailer" name="trailer" placeholder="Insira o link do trailer">

                </div>

                <div class="form-group">

                    <label for="description">Descrição</label>
                    <textarea style="resize: none;" class="form-control" id="description" name="description" placeholder="Insira uma descrição sobre o filme" rows="5"></textarea>

                </div>

                <input type="submit" class="btn card-btn" value="Adicionar filme">

            </form>

        </div>

    </div>

<?php include_once("templates/footer.php"); ?>