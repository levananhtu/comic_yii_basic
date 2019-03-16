<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comic_translator".
 *
 * @property int $ComicTranslatorID
 * @property int $TranslatorID
 * @property int $ComicID
 */
class ComicTranslator extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comic_translator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['TranslatorID', 'ComicID'], 'integer'],
            [['ComicID'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ComicTranslatorID' => 'Comic Translator ID',
            'TranslatorID' => 'Translator ID',
            'ComicID' => 'Comic ID',
        ];
    }
}
