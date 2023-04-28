<?php
namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Healthcare extends \yii\db\ActiveRecord {
	
 	public static function tableName()
    {
        return 'healthcare';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'inserted_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];   
    }

	public function rules()
    {
        return [
            [['division_id'], 'required'],
            [['division_id', 'speciality_type', 'license_id', 'comment', 'providing_condition', 'status', 'legal_entity_id'], 'string'],
            [['inserted_at', 'updated_at'], 'safe'],
			[['is_active'], 'boolean'],
			
		];
    }
    
    public function getType()
    {
        return $this->hasOne(HealthcareType::class, ['healthcare_id' => 'id']);
    }
    
    public function getCategory()
    {
        return $this->hasOne(HealthcareCategory::class, ['healthcare_id' => 'id']);
    }
		
    public function getCoverage_area() 
    {
        return $this->hasMany(HealthcareCoverageArea::class, ['healthcare_id' => 'id']);
    }

    public function getAvailable_time() 
    {
        return $this->hasMany(HealthcareAvailableTime::class, ['healthcare_id' => 'id']);
    }

    public function getNot_available() 
    {
        return $this->hasMany(HealthcareNotAvailable::class, ['healthcare_id' => 'id']);
    }
}