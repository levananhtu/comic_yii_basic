<?php
/* @var $this yii\web\View */
/* @var $previousChapter string */
/* @var $currentChapter string */
/* @var $nextChapter array */
/* @var $comicName string */
/* @var $chapters array */
?>
<div class="row float-xl-none" align="center">
    <?= $this->render("_npc_button", [
        "chapter" => $previousChapter,
        "comic" => $comicName,
        "title" => "Chương trước"
    ]) // render button chương trước     ?>
    <?= $this->render("_c_select", [
        "chapters" => $chapters,
        "comicName" => $comicName,
        "currentChapter" => $currentChapter
    ]) // render select chương     ?>
    <?= $this->render("_npc_button", [
        "chapter" => $nextChapter,
        "comic" => $comicName,
        "title" => "Chương sau"
    ]) // render button chương sau     ?>
</div>
