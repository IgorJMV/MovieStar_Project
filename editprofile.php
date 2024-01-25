<?php

    require_once("templates/header.php");
    require_once("models/User.php");
    require_once("dao/UserDAO.php");

    $userDao = new UserDAO($conn, $BASE_URL);
    $user = new User();

    $userData = $userDao->verifyByToken(true);

    $fullName = $user->getFullName($userData);

    if($userData->getImage() == ""){
        $userData->setImage("user.png");
    }

?>

    <div id="main-container" class="container-fluid">
        <div class="col-md-12">
            <form action="<?= $BASE_URL ?>user_process.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="type" value="update">
                <div class="row">
                    <div class="col-md-4">
                        <h1><?= $fullName ?></h1>
                        <p class="page-description">Altere seus dados no formulário abaixo:</p>
                        <div class="form-group">
                            <label for="name">Nome:</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Digite o seu nome" value="<?= $userData->getName() ?>">
                        </div>
                        <div class="form-group">
                            <label for="lastname">Sobrenome:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Digite o seu sobrenome" value="<?= $userData->getLastname() ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="text" readonly class="form-control disabled" id="email" name="email" placeholder="Digite o seu email" value="<?= $userData->getEmail() ?>">
                        </div>
                        <input type="submit" class="btn form-btn" value="Alterar">
                    </div>
                    <div class="col-md-4">
                        <div id="profile-image-container" style="background-image: url('<?= $BASE_URL ?>img/users/<?= $userData->getImage() ?>')"></div>
                        <div class="form-group">
                            <label for="image">Foto:</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="form-group">
                            <label for="bio">Sobre você:</label>
                            <textarea class="form-control" name="bio" id="bio" rows="5" placeholder="Conte quem você é, o que faz e onde trabalha..."><?= $userData->getBio() ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php require_once("templates/footer.php"); ?>