<?php
/* @var $this yii\web\View */
/* @var $model array */
$previousChapter = $model["PreviousChapter"];
$currentChapter = $model["CurrentChapter"];
$nextChapter = $model["NextChapter"];
$comicName = $model["ComicName"];
$chapterNavigator = $this->render("_c_navigator", [
    "previousChapter" => $previousChapter,
    "currentChapter" => $currentChapter,
    "nextChapter" => $nextChapter,
    "comicName" => $comicName,
    "chapters" => $model["Chapters"],
]);
$this->title = $currentChapter;
?>
<?= $chapterNavigator ?>
    <div align="center">
        <?php foreach ($model["Pages"] as $page): ?>
            <img style="display: block" width="75%" height="75%" src="<?= $page["PageURL"] ?>">
        <?php endforeach; ?>
    </div>
<?= $chapterNavigator ?>