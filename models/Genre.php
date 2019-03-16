<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $GenreID
 * @property string $GenreName
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['GenreName'], 'required'],
            [['GenreName'], 'string', 'max' => 127],
            [['GenreName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'GenreID' => 'Genre ID',
            'GenreName' => 'Genre Name',
        ];
    }

    public function getComics()
    {
        return $this->hasMany(Comic::className(), ["ComicID" => "ComicID"])
            ->via("comicGenres");
    }

    public function getComicGenres()
    {
        return $this->hasMany(ComicGenre::className(), ["GenreID" => "GenreID"]);
    }

    public static function getGenreIdByGenreName($genreName)
    {
        $genreId = Genre::find()
            ->where(["GenreName" => $genreName])
            ->asArray()
            ->one();
        if (empty($genreId)) {
            return null;
        }
        return $genreId;
    }
}
