<div class="adminContent">
    <div class="container">
        <h2>Редактирование объекта № <?= $work['id'] ?></h2>

        <form action="/build/<?= $work['id'] ?>" method="post" enctype="multipart/form-data">

            <?= get_csrf_token() ?>
            <div class="form-group form-group__correct">
                <div class="form-group__label">
                    <label for="photoWork">Фотография объекта</label>
                    <p class="help-block">(только одна картинка!!!)</p>
                </div>
                <div class="form-group__data">
                    <img src="/images/works/<?= $work['photoName'] ?>" alt="" style="width: 300px;">
                    <input name="photoWork" class="form-control" id="photoWork" type="file">
                    <p class="help-block redMarker">При выборе другого изображения текущая фотография будет утрачена</p>
                </div>
            </div>

            <div class="form-group">
                <div class="form-group__label">
                    <label for="inputTitleWork">Название объекта</label>
                    <p class="help-block">(улица, номер дома)</p>
                </div>
                <div class="form-group__data">
                    <input name="title" id="inputTitleWork" type="text" class="form-control" value="<?= $work['title'] ?>"
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
                            <option value="<?= $category['id'] ?>" <?= formOldSelect($category['id'], $work) ?> >
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
                           <?= formOldCheckbox($work['publish']) ?>
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
                           value="<?= date('Y-m-d', $work['timeCreate']) ?>"
                    >
                </div>
            </div>

            <!--        <div class="form-group">-->
            <!--            <div class="form-group__label">-->
            <!--                <label for="inputLatitudeWork">Географическая широта</label>-->
            <!--                <p class="help-block">(в формате ХХ.ХХХХХХ)</p>-->
            <!--            </div>-->
            <!--            <div class="form-group__data">-->
            <!--                <input name="lat" id="inputLatitudeWork"-->
            <!--                       type="text"-->
            <!--                       pattern='\d{2}.\d{6}'-->
            <!--                       placeholder="XX.XXXXXX"-->
            <!--                       min="-90.000000" max="90.000000"-->
            <!--                       class="form-control inputCoordinate"-->
            <!--                       value="--><? //= old('lat', $work) ?><!--"-->
            <!--                       title="">-->
            <!--            </div>-->
            <!--        </div>-->
            <!---->
            <!--        <div class="form-group">-->
            <!--            <div class="form-group__label">-->
            <!--                <label for="inputLongitudeWork">Географическая долгота</label>-->
            <!--                <p class="help-block">(в формате ХХ.ХХХХХХ)</p>-->
            <!--            </div>-->
            <!--            <div class="form-group__data">-->
            <!--                <input name="lon" id="inputLongitudeWork"-->
            <!--                       type="text"-->
            <!--                       pattern='\d{2}.\d{6}'-->
            <!--                       min="-180.000000" max="180.000000"-->
            <!--                       placeholder="XX.XXXXXX"-->
            <!--                       class="form-control inputCoordinate"-->
            <!--                       value="--><? //= oldInfo('lon', $work) ?><!--"-->
            <!--                       title="">-->
            <!--            </div>-->
            <!--        </div>-->


            <!--        <div class="form-group">-->
            <!--            <div class="form-group__label">-->
            <!--                <label for="inputDateWork">Дата создания:</label>-->
            <!--            </div>-->
            <!--            <div class="form-group__data" style="width: 300px;">-->
            <!---->
            <!--                <input name="timeCreate" id="inputDateWork" type="date" class="form-control" value="-->
            <? //= oldDate("timeCreate", $work) ?><!--"-->
            <!--                       title="">-->
            <!--                <p class="help-block redMarker">обязательное поле</p>-->
            <!--            </div>-->
            <!--        </div>-->



            <div class="form-group">
                <button class="btn btn-success" type="submit">Сохранить</button>
            </div>
        </form>
        <?= session()->remove('form_data'); ?>
        <?= session()->remove('form_errors'); ?>
    </div>
</div>




