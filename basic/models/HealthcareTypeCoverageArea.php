<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_type_coverage_area".
 *
 * @property int $id
 * @property int|null $healthcare_id
 * @property string|null $value
 */
class HealthcareTypeCoverageArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_type_coverage_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_id'], 'integer'],
            [['value'], 'string', 'max' => 255],
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
            'value' => 'Value',
        ];
    }
}
