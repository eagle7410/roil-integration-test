<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_not_available".
 *
 * @property int $id
 * @property int|null $healthcare_id
 * @property string|null $description
 */
class HealthcareNotAvailable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_not_available';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
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
            'description' => 'Description',
        ];
    }

    public function getDuring()
    {
        return $this->hasOne(HealthcareNotAvailableDuring::class, ['healthcare_not_available_id' => 'id']);
    }
}
