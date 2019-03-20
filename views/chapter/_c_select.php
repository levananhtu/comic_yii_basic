<?php
/* @var $chapters array */
/* @var $comicName string */
?>
<select class="form-control form-control-sm col-4" onchange="window.location.href=$(this).val()" title="">
    <?php foreach ($chapters as $chapter):
        $chapterName = $chapter["ChapterName"]; ?>
        <?php if ($chapterName == $currentChapter): ?>
        <option value="<?= \yii\helpers\Url::toRoute(
            [
                "chapter/index",
                "chapter" => $chapterName,
                "comic" => $comicName
            ]) ?>" selected="selected">
            <?= $chapterName ?>
        </option>
    <?php else: ?>
        <option value="<?= \yii\helpers\Url::toRoute(
            [
                "chapter/index",
                "chapter" => $chapterName,
                "comic" => $comicName
            ]) ?>">
            <?= $chapterName ?>
        </option>
    <?php endif; ?>
    <?php endforeach; ?>
</select>
