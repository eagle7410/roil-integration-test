<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_not_available".
 *
 * @property int $id
 * @property int|null $healthcare_id
 * @property string|null $description
 * @property string $start
 * @property string|null $end
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
            [['start', 'end', 'description'], 'required', 'message'=>'[Not avalible] Please enter a value for {attribute}.'],
            [['start', 'end'],'match','pattern'=>'/^(\d\d\d\d)\-(\d\d)\-(\d\d)T(\d\d):(\d\d)\:(\d\d)\.(\d\d\d)Z$/', 'on' => 'created'],
            [['start'], 'validateRange'],
        ];
    }

    public function validateRange()
    {
        if (!($this->start < $this->end)) {
            $this->addError('During start', '[Not Available] Incorrect time range from '.gmdate("Y-m-d\TH:i:s\Z", $this->start).' to '.gmdate("Y-m-d\TH:i:s\Z", $this->end));
        }
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
