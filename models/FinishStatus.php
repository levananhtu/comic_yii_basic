<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "finish_status".
 *
 * @property int $FinishStatusID
 * @property string $FinishStatusName
 */
class FinishStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'finish_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FinishStatusName'], 'required'],
            [['FinishStatusName'], 'string', 'max' => 127],
            [['FinishStatusName'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FinishStatusID' => 'Finish Status ID',
            'FinishStatusName' => 'Finish Status Name',
        ];
    }
}
