<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_not_available_during".
 *
 * @property int $id
 * @property int|null $healthcare_not_available_id
 * @property string $start
 * @property string|null $end
 */
class HealthcareNotAvailableDuring extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_not_available_during';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_not_available_id'], 'integer'],
            [['start'], 'required'],
            [['start', 'end'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'healthcare_not_available_id' => 'Healthcare Not Available ID',
            'start' => 'Start',
            'end' => 'End',
        ];
    }
}
