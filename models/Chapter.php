<?php

namespace app\models;

use Yii;

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

}
