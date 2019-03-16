<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comic_author".
 *
 * @property int $ComicAuthorID
 * @property int $AuthorID
 * @property int $ComicID
 */
class ComicAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comic_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['AuthorID', 'ComicID'], 'integer'],
            [['ComicID'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ComicAuthorID' => 'Comic Author ID',
            'AuthorID' => 'Author ID',
            'ComicID' => 'Comic ID',
        ];
    }
}
