<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "page".
 *
 * @property int $PageID
 * @property int $ChapterID
 * @property int $PreviousPage
 * @property string $PageURL
 */
class Page extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'page';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ChapterID', 'PageURL'], 'required'],
            [['ChapterID', 'PreviousPage'], 'integer'],
            [['PageURL'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'PageID' => 'Page ID',
            'ChapterID' => 'Chapter ID',
            'PreviousPage' => 'Previous Page',
            'PageURL' => 'Page Url',
        ];
    }

    public static function getPageByChapterId($chapterId, $columns = null)
    {
        return Page::find()
            ->select($columns)
            ->where(["ChapterID" => $chapterId])
            ->asArray()
            ->all();

    }
}
