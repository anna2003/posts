<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
    <br>
    <div class="container mt-5 row col-4 offset-4">
        <h1 class="fs-5">Авторизация </h1>
        <form action="login.php" method="post" name="formAuth" id="formAuth">
            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?= $_SESSION['email'] ?? '' ?>">
            </div>
            <div class="form-group mb-3">
                <label for="password">Пароль</label>
                <input type="password" class="form-control" id="password" name="password"
                       value="<?= $_SESSION['password'] ?? '' ?>">
            </div>
            <p><span class="error" style="display: <?= $_SESSION['errors']['auth'] ? 'block' : 'none' ?>" >
                    <?= $_SESSION['errors']['auth']?>
                </span></p>
            <button type="submit" class="btn btn-info w-100" name="submit">
                Пройти авторизацию </button>
        </form>
    </div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>