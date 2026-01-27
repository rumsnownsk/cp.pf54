<div class="adminContent">
    <div class="container">
        <h2>Создание объекта:</h2>

        <form action="/build/create" method="post" enctype="multipart/form-data">

            <?= get_csrf_token() ?>

            <div class="form-group form-group__correct">
                <div class="form-group__label">
                    <label for="photoWork">Фотография объекта</label>
                    <p class="help-block">(только одна картинка!!!)</p>
                </div>
                <div class="form-group__data">

                    <input name="photoWork" class="form-control" id="photoWork" type="file">
                </div>
            </div>

            <div class="form-group">
                <div class="form-group__label">
                    <label for="inputTitleWork">Название объекта</label>
                    <p class="help-block">(улица, номер дома)</p>
                </div>
                <div class="form-group__data">
                    <input name="title" id="inputTitleWork" type="text" class="form-control" value=""
                           title="">
                    <p class="help-block redMarker">обязательное поле</p>
                </div>
            </div>


            <div class="form-group">
                <div class="form-group__label">
                    <label for="selectCategoryIdWork">Категория</label>
                </div>
                <div class="form-group__data">
                    <select name="category_id" id="selectCategoryIdWork" title="">
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['id'] ?>" <?= formOldSelect($category['id']) ?> >
                                <?= $category['title'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <p class="help-block redMarker">обязательное поле</p>
                </div>
            </div>
            <div class="form-group">
                <div class="form-group__label">
                    <label for="inputPublishWork">Разместить на сайте?</label>
                </div>
                <div class="form-group__data">
                    <input name="publish"
                           id="inputPublishWork"
                           type="checkbox"
                           class="form-check"
                           title="test"
                    >
                </div>
            </div>

            <div class="form-group">
                <div class="form-group__label">
                    <label for="inputTimeCreate">Дата создания:</label>
                </div>
                <div class="form-group__data">
                    <input name="timeCreate"
                           id="inputTimeCreate"
                           type="date"
                           value="<?= date('Y-m-d') ?>"
                    >
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">Сохранить</button>
            </div>
        </form>
        <?= session()->remove('form_data'); ?>
        <?= session()->remove('form_errors'); ?>
    </div>
</div>




