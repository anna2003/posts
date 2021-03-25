<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
    <br>
    <div class="container mt-5 row col-4 offset-4">
        <h1 class="fs-5">Регистрация </h1>
        <form action="register.php" method="post">
            <div class="form-group mb-3">
                <label for="name">Имя:</label>
                <input type="text" class="form-control" id="name" name="name"
                       value="<?= $_SESSION['name'] ?? '' ?>">
                <span class="error" style="display: <?= $_SESSION['errors']['name'] ? 'block' : 'none' ?>" >
                    <?= $_SESSION['errors']['name']?>
                </span>
            </div>
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                       value="<?= $_SESSION['email'] ?? '' ?>">
                <span class="error" style="display: <?= $_SESSION['errors']['email'] ? 'block' : 'none' ?>" >
                    <?= $_SESSION['errors']['email']?>
                </span>
            </div>
            <div class="form-group mb-3">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password"
                       value="<?= $_SESSION['password'] ?? '' ?>">
                <span class="error" style="display: <?= $_SESSION['errors']['password'] ? 'block' : 'none' ?>" >
                    <?= $_SESSION['errors']['password']?>
                </span>
            </div>
            <p><span class="error" style="display: <?= $_SESSION['errors']['register'] ? 'block' : 'none' ?>" >
                    <?= $_SESSION['errors']['register'] ?? '' ?>
                </span></p>
            <button type="submit" class="btn btn-info w-100" name="submit"> Зарегистрироваться </button>
        </form>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>