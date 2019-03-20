<?php

namespace app\controllers;

use app\models\Chapter;
use Yii;
use yii\web\Response;

class ChapterController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $chapterName = \Yii::$app->request->getQueryParam("chapter");
        $comicName = \Yii::$app->request->getQueryParam("comic");
        $model = Chapter::getChapterDetail($comicName, $chapterName);
        if ($model == null) {
            Yii::$app->response->statusCode = 404;
        }
        $model["CurrentChapter"] = $chapterName;
        $model["ComicName"] = $comicName;
        return $this->render('index', ["model" => $model]);
    }

}
