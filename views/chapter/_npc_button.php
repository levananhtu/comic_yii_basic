<?php
/* @var $chapter string */
/* @var $comic string */
/* @var $title string */
?>
<?php if ($chapter != null): ?>
    <button type="button"
            class="btn btn-flat flat-default txt-muted waves-effect col-2"
            data-toggle="tooltip"
            data-placement="top"
            title="<?= $chapter ?>">
        <a href="<?= \yii\helpers\Url::toRoute(
            [
                "chapter/index",
                "chapter" => $chapter,
                "comic" => $comic
            ]) ?>">
            <?= $title ?>
        </a>
    </button>
<?php else: ?>
    <button type="button"
            class="btn btn-flat flat-default txt-muted waves-effect col-2 disabled"
            data-toggle="tooltip"
            data-placement="top"
            title="">
        <?= $title ?>
    </button>
<?php endif; ?>
