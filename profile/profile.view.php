<?php
use App\models\ShowData;
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
<br>

<div class="container mt-5 row col-6 offset-3">
    <p>Личный кабинет - <?= $user->name ?></p>
    <input type="hidden" value="<?= $user->id ?>" id="inputId">
    <button id="btn"><?= $user->name ?></button>
    <?php
    if ($posts && count($posts) > 0): ?>
        <div class="row ">
            <div class="main">
                <?php foreach ($posts as $post): ?>
                    <div class="card border-secondary mb-3">
                        <div class="card-header"><?= ShowData::showDate($post->created_at) ?></div>
                        <div class="card-body text-secondary">
                            <h5 class="card-title"><?= $post->title ?></h5>
                            <p class="card-text"><?= ShowData::showText($post->text) ?></p>
                            <div class="d-flex justify-content-between float-end">
                                <a href="/posts/show.php?id=<?= $post->id ?>" class="primary ">Подробнее...</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    <?php else: ?>
        <div>У вас пока нет статей...</div>
    <?php endif ?>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>


<!--                                <a href="/profile?user_id=--><?//= $post->user_id ?><!--"-->
<!--                                   class="user-name">--><?//= $post->user_name ?><!--</a>-->