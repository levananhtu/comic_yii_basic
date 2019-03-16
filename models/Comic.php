<?php

namespace app\models;

use Yii;

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
}
