<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_available_time".
 *
 * @property int $id
 * @property int|null $healthcare_id
 * @property string|null $available_start_time
 * @property string|null $available_end_time
 * @property string|null $days_of_week
 */
class HealthcareAvailableTime extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_available_time';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_id'], 'integer'],
            [['available_start_time', 'available_end_time'], 'string', 'max' => 8],
            [['days_of_week'], 'string', 'max' => 255],
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
            'available_start_time' => 'Available Start Time',
            'available_end_time' => 'Available End Time',
            'days_of_week' => 'Days Of Week',
        ];
    }
}
