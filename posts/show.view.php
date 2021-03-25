<?php
use App\models\ShowData;
include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>
<br>
<div class="container mt-5 row col-10 offset-1">
    <?php if ($post): ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-5">
                    <img src="/img/<?= $post->image ?>" alt="..." class="w-100 h-100 img-card">
                </div>
                <div class="col-md-7 d-flex flex-column align-items-between">
                    <div class="card-body">
                        <h5 class="card-title"><?= $post->title ?></h5>
                        <p class="card-text"><?= $post->text ?></p>
                        <div class="d-flex justify-content-between">
                            <div><small class="text-muted"><?= ShowData::showDate($post->created_at) ?>
                                </small></div>
                            <div><small class="text-muted"><?=$post->user_name?></small></div>
                        </div>
                    </div>
                    <?php if($user && $user->id === $post->user_id): ?>
                    <form action="deletePost.php" method="post" class="d-flex justify-content-end mb-3">
                        <input type="hidden" name="id" value="<?= $post->id ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm px-3 mx-3"
                                name="deleteBtn" id="deleteBtn"
                                onclick="return confirm('Вы действительно хотите удалить статью?');">
                            Удалить статью
                        </button>
                        <a href="edit.php?id=<?= $post->id ?>" class="btn btn-outline-info btn-sm px-3">
                            Изменить статью
                        </a>
                    </form>
                    <?php endif ?>
                </div>
            </div>
        </div>

<!--        Удаляем с подтверждением-->

    <?php else: ?>
        <div>Запрашиваемый ресурс не найден...</div>
    <?php endif ?>
</div>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>


