<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_type_coding".
 *
 * @property int $id
 * @property int|null $healthcare_type_id
 * @property string|null $system
 * @property string|null $code
 */
class HealthcareTypeCoding extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_type_coding';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_type_id'], 'integer'],
            [['system', 'code'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'healthcare_type_id' => 'Healthcare Type ID',
            'system' => 'System',
            'code' => 'Code',
        ];
    }
}
