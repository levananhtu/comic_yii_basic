<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comic_genre".
 *
 * @property int $ComicGenreID
 * @property int $ComicID
 * @property int $GenreID
 */
class ComicGenre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comic_genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ComicID'], 'required'],
            [['ComicID', 'GenreID'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ComicGenreID' => 'Comic Genre ID',
            'ComicID' => 'Comic ID',
            'GenreID' => 'Genre ID',
        ];
    }
}
