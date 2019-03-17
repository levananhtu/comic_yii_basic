<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "chapter".
 *
 * @property int $ChapterID
 * @property int $ComicID
 * @property int $PreviousChapter
 * @property string $SubmitDate
 * @property string $ChapterName
 */
class Chapter extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chapter';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ComicID', 'SubmitDate', 'ChapterName'], 'required'],
            [['ComicID', 'PreviousChapter'], 'integer'],
            [['SubmitDate'], 'safe'],
            [['ChapterName'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ChapterID' => 'Chapter ID',
            'ComicID' => 'Comic ID',
            'PreviousChapter' => 'Previous Chapter',
            'SubmitDate' => 'Submit Date',
            'ChapterName' => 'Chapter Name',
        ];
    }

    public function getComics()
    {
        return $this->hasOne(Comic::className(), ["ComicID" => "ComicID"]);
    }

    public function getPages()
    {
        return $this->hasMany(Page::className(), ["ChapterID" => "ChapterID"]);
    }

    public static function getChapterDetail($comicName, $chapterName)
    {
        $comicId = Comic::getComicByComicName($comicName, ["ComicID"]);
        if ($comicId == null) {
            return null;
        }
        $currentChapter = Chapter::getChapterByChapterNameAndComicId($chapterName, $comicId, ["ChapterID", "PreviousChapter"]);
        if ($currentChapter == null) {
            return null;
        }
        $nextChapter = Chapter::find()
            ->select(["ChapterName"])
            ->where(["ChapterID" => $currentChapter["PreviousChapter"]])
            ->asArray()
            ->one();

        $previousChapter = Chapter::getChapterByPreviousChapter($currentChapter["ChapterID"], ["ChapterName"]);
        $chapters = Chapter::find()
            ->select(["ChapterName"])
            ->where(["ComicID" => $comicId])
            ->asArray()
            ->all();
        $page = Page::getPageByChapterId($currentChapter["ChapterID"], ["PageURL"]);
        return [
            "PreviousChapter" => $previousChapter == null ? null : $previousChapter["ChapterName"],
            "NextChapter" => $nextChapter == null ? null : $nextChapter["ChapterName"],
            "Chapters" => $chapters,
            "Pages" => $page
        ];
    }

    public static function getChapterByChapterNameAndComicId($chapterName, $comicId, $columns = null)
    {
        return Chapter::find()
            ->select($columns)
            ->where(
                [
                    "ChapterName" => $chapterName,
                    "ComicID" => $comicId
                ]
            )
            ->asArray()
            ->one();

    }

    public static function getChapterByPreviousChapter($previousChapter, $columns = null)
    {
        return Chapter::find()
            ->select($columns)
            ->where(["PreviousChapter" => $previousChapter])
            ->asArray()
            ->one();
    }
}
