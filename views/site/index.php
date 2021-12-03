<?php

/* @var $this yii\web\View */
/* @var array $tags */

use yii\bootstrap4\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index" style="padding-top: 100px;">

    <div class="body-content">

        <?= Html::beginForm() ?>

        <div class="row">
            <div class="form-group col">
                <label for="includeTags">Выбрать по тегам</label>
                <?= Html::dropDownList('includeTags', null, $tags, ['multiple' => true, 'id' => 'includeTags', 'class' => 'form-control']) ?>
            </div>
            <div class="form-group col">
                <label for="excludeTags">Исключить теги</label>
                <?= Html::dropDownList('excludeTags', null, $tags, ['multiple' => true, 'id' => 'excludeTags', 'class' => 'form-control']) ?>
            </div>
        </div>
        <div class="row">
            <?= Html::submitButton('Скачать CSV', ['class' => 'btn btn-primary']) ?>
        </div>
        <?= Html::endForm() ?>
    </div>
</div>
