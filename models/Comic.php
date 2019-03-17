<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "comic".
 *
 * @property int $ComicID
 * @property int $FinishStatusID
 * @property string $ComicName
 * @property string $CreatedDate
 * @property string $Description
 * @property double $Rate
 * @property int $View
 * @property string $Thumbnail
 * @property int $SourceID
 */
class Comic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FinishStatusID', 'ComicName'], 'required'],
            [['FinishStatusID', 'View', 'SourceID'], 'integer'],
            [['ComicName', 'Description', 'Thumbnail'], 'string'],
            [['CreatedDate'], 'safe'],
            [['Rate'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ComicID' => 'Comic ID',
            'FinishStatusID' => 'Finish Status ID',
            'ComicName' => 'Comic Name',
            'CreatedDate' => 'Created Date',
            'Description' => 'Description',
            'Rate' => 'Rate',
            'View' => 'View',
            'Thumbnail' => 'Thumbnail',
            'SourceID' => 'Source ID',
        ];
    }

    public function getSource()
    {
        return $this->hasOne(Source::className(), ["SourceID" => "SourceID"]);
    }

    public function getChapters()
    {
        return $this->hasMany(Chapter::className(), ["ComicID" => "ComicID"]);
    }

    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ["GenreID" => "GenreID"])
            ->via("comicGenres");
    }

    public function getComicGenres()
    {
        return $this->hasMany(ComicGenre::className(), ["ComicID" => "ComicID"]);
    }

    public function getTranslators()
    {
        return $this->hasMany(Translator::className(), ["TranslatorID" => "TranslatorID"])
            ->via("comicTranslators");

    }

    public function getComicTranslators()
    {
        return $this->hasMany(ComicTranslator::className(), ["ComicID" => "ComicID"]);
    }

    public function getAuthors()
    {
        return $this->hasMany(Author::className(), ["AuthorID" => "AuthorID"])
            ->via("comicAuthors");

    }

    public function getComicAuthors()
    {
        return $this->hasMany(ComicAuthor::className(), ["ComicID" => "ComicID"]);
    }

    public function getFinishStatus()
    {
        return $this->hasMany(FinishStatus::className(), ["FinishStatusID" => "FinishStatusID"]);
    }

    public static function getComicDetailByAuthorName($authorName)
    {
        $authorID = Author::getAuthorIdByAuthorName($authorName);
        if ($authorID == null) {
            return null;
        }
        $comics = Author::findOne($authorID)
            ->getComics()
            ->select(["ComicID", "ComicName", "Description", "Thumbnail"])
            ->asArray()
            ->all();
        if (empty($comics)) {
            return null;
        }

        for ($i = 0; $i < count($comics); $i++) {
            $comicId = $comics[$i]["ComicID"];
            $genres = Comic::findOne($comicId)
                ->getGenres()
                ->select(["GenreName"])
                ->asArray()
                ->all();
            $comics[$i]["GenreCount"] = count($genres);
            $comics[$i]["Genres"] = $genres;
            unset($comics[$i]["ComicID"]);
        }
        return $comics;
    }

    public static function getComicDetailByGenreName($genreName, $offset = null, $limit = null)
    {
        $genreID = Genre::getGenreIdByGenreName($genreName);
        if ($genreID == null) {
            return null;
        }
        $comics = Genre::findOne($genreID)
            ->getComics()
            ->select(["ComicID", "ComicName", "Description", "Thumbnail"])
            ->offset($offset)
            ->limit($limit)
            ->asArray()
            ->all();
        if (empty($comics)) {
            return null;
        }
        return self::getComicItem($comics);
    }

    public static function getComicDetailByTranslatorName($translatorName, $offset = null, $limit = null)
    {
        $translatorID = Translator::getTranslatorIdByTranslatorName($translatorName);
        if ($translatorID == null) {
            return null;
        }
        $comics = Translator::findOne($translatorID)
            ->getComics()
            ->select(["ComicID", "ComicName", "Description", "Thumbnail"])
            ->offset($offset)
            ->limit($limit)
            ->asArray()
            ->all();
        if (empty($comics)) {
            return null;
        }
        return self::getComicItem($comics);
    }

    private static function getComicItem($comics)
    {
        for ($i = 0; $i < count($comics); $i++) {
            $comicId = $comics[$i]["ComicID"];
            $genres = Comic::findOne($comicId)
                ->getGenres()
                ->select(["GenreName"])
                ->asArray()
                ->all();
            $comics[$i]["GenreCount"] = count($genres);
            $comics[$i]["Genres"] = $genres;
            unset($comics[$i]["ComicID"]);
        }
        return $comics;

    }

    public static function getComicByComicName($comicName, $columns = null)
    {
        return Comic::find()
            ->select($columns)
            ->where(["ComicName" => $comicName])
            ->asArray()
            ->one();
    }

    public static function getComicDetail($comicName)
    {
        $comic = Comic::getComicByComicName($comicName);
        if ($comic == null) {
            return null;
        }
        $rawComic = Comic::findOne($comic["ComicID"]);
        $sourceName = $rawComic
            ->getSource()
            ->select(["SourceName"])
            ->asArray()
            ->one();
        $finishStatusName = $rawComic
            ->getFinishStatus()
            ->select(["FinishStatusName"])
            ->asArray()
            ->one();
        $authorsName = $rawComic
            ->getAuthors()
            ->select(["AuthorName"])
            ->asArray()
            ->all();
        $translatorsName = $rawComic
            ->getTranslators()
            ->select(["TranslatorName"])
            ->asArray()
            ->all();
        $genresName = $rawComic
            ->getGenres()
            ->select(["GenreName"])
            ->asArray()
            ->all();
        $chaptersName = $rawComic
            ->getChapters()
            ->select(["ChapterName", "SubmitDate"])
            ->asArray()
            ->all();
        $comic = ArrayHelper::merge($comic, $sourceName,
            $finishStatusName,
            ["Authors" => $authorsName],
            ["Translators" => $translatorsName],
            ["Genres" => $genresName],
            ["Chapters" => $chaptersName]);
        unset($comic["SourceID"], $comic["FinishStatusID"], $comic["ComicID"]);
        return $comic;
    }
}
