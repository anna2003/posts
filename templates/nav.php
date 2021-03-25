<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary mb-5">
    <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarCollapse" aria-controls="navbarCollapse"
            aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="container d-flex justify-content-between">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">POSTS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts">Статьи</a>
                </li>
            </ul>
            <div class="navbar-nav fs-6">
                <a class="nav-link align-items-center" href="/profile?user_id=<?= $user->id ?>"
                   style="display: <?= $user ? 'inline' : 'none' ?>">
                    <?= $user ? $user->name : '' ?></a>
                <a class="nav-link align-items-center" href="/register"
                   style="display: <?= $user ? 'none' : 'inline' ?>"> Регистрация </a>
                <a class="nav-link align-items-center"
                   href="/auth"><?= $user ? 'Выйти' : 'Авторизация' ?></a>
            </div>
        </div>
    </div>
</nav>


