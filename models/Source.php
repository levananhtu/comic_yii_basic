<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "source".
 *
 * @property int $SourceID
 * @property string $SourceName
 * @property string $URL
 */
class Source extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SourceName'], 'required'],
            [['URL'], 'string'],
            [['SourceName'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'SourceID' => 'Source ID',
            'SourceName' => 'Source Name',
            'URL' => 'Url',
        ];
    }
}
