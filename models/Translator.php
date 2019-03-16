<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "translator".
 *
 * @property int $TranslatorID
 * @property string $TranslatorName
 */
class Translator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'translator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TranslatorName'], 'required'],
            [['TranslatorName'], 'string', 'max' => 127],
            [['TranslatorName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'TranslatorID' => 'Translator ID',
            'TranslatorName' => 'Translator Name',
        ];
    }

    public function getComics()
    {
        return $this->hasMany(Comic::className(), ["ComicID" => "ComicID"])
            ->via("comicTranslators");
    }

    public function getComicTranslators()
    {
        return $this->hasMany(ComicTranslator::className(), ["TranslatorID" => "TranslatorID"]);
    }

}
