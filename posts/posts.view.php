<?php
use App\models\ShowData;
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
<br>
<div class="container mt-5">
    <?php if($user): ?>
    <a href="new.php" class="btn btn-outline-primary my-3 px-3">
        Добавить статью
    </a>
    <?php endif ?>
    <div class="row ">
        <div class="main col-md-8">
            <?php foreach ($posts as $post): ?>
                <div class="card border-secondary mb-3">
                    <div class="card-header"><?= ShowData::showDate($post->created_at) ?></div>
                    <div class="card-body text-secondary">
                        <h5 class="card-title"><?= $post->title ?></h5>
                        <p class="card-text"><?= ShowData::showText($post->text) ?></p>
                        <div class="d-flex justify-content-between">
                            <a href="/profile?user_id=<?= $post->user_id ?>" class="user-name">
                                <?= $post->user_name ?></a>
                            <a href="/posts/show.php?id=<?= $post->id ?>" class="primary">Подробнее...</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/sidebar.php' ?>
    </div>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>


<!--<td>--><? //= date_format(new DateTime($post->created_at), 'd.m.Y') ?><!--</td>-->
<!--<td>--><? //= date('d.m.Y', strtotime($post->created_at)) ?><!--</td>-->