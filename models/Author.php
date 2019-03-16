<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $AuthorID
 * @property string $AuthorName
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AuthorName'], 'required'],
            [['AuthorName'], 'string', 'max' => 127],
            [['AuthorName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'AuthorID' => 'Author ID',
            'AuthorName' => 'Author Name',
        ];
    }

    public function getComics()
    {
        return $this->hasMany(Comic::className(), ["ComicID" => "ComicID"])
            ->via("comicAuthors");
    }

    public function getComicAuthors()
    {
        return $this->hasMany(ComicAuthor::className(), ["AuthorID" => "AuthorID"]);
    }

}
