<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'; ?>

<br><br><br><br>
<div class="container col-8 offset-2">
    <p><span class="error" style="display: <?$_SESSION['errors']['insert'] ? 'block' : 'none' ?>;">
        <?= $_SESSION['errors']['insert']?></span></p>
    <form action="insertPost.php" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-8">
                <div class="mb-3">
                    <label for="title" class="form-label">Название статьи</label>
                    <input type="text" class="form-control" id="title" name="title"
                        value="<?= $_SESSION['post']['title'] ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Текст статьи</label>
                    <textarea class="form-control" id="text"
                              name="text" rows="3"><?= $_SESSION['post']['text'] ?? '' ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Выберите файл-изображение</label>
                    <input class="form-control" type="file" name="image" id="image">
                </div>
                <button type="submit" class="btn btn-outline-info col-3 float-end" name="submitInsert">
                    Добавить</button>
            </div>
            <div class="col">
                <img src="" alt="" id="loadImage" class="w-100 rounded">
            </div>
        </div>
    </form>
</div>


<script>
    // Отображаем загруженное изображение на странице
    let loadImage = document.querySelector("#loadImage"),
        image = document.querySelector("#image");

    image.addEventListener('change', function (e) {
        loadImage.src = URL.createObjectURL(e.target.files[0]);
        loadImage.style.display = 'block';
        loadImage.onLoad = function () {
            URL.revokeObjectURL(e.target.src)
        };
    })
</script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'; ?>


