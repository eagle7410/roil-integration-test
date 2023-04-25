<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_type".
 *
 * @property int $id
 * @property int|null $healthcare_id
 * @property string|null $text
 */
class HealthcareType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'healthcare_id' => 'Healthcare ID',
            'text' => 'Text',
        ];
    }

    public function getCoding()
    {
        return $this->hasOne(HealthcareTypeCoding::class, ['healthcare_type_id' => 'id']);
    }
}
