<?php
namespace models;

use Yii;

class Healthcare extends \yii\db\ActiveRecord {
	
 	public static function tableName()
    {
        return 'healthcare';
    }

	public $id;
	public $division_id;
    public $speciality_type; 		
    public $license_id;
    public $comment;
    public $providing_condition;
    public $status;	
    public $is_active;
    public $legal_entity_id;
    public $inserted_at; 		
    public $inserted_by;     		
    public $updated_at;      		
    public $updated_by;     	
	
	public function rules()
    {
        return [
            [['division_id'], 'required'],
            [[
				'division_id', 'speciality_type', 'license_id', 'comment', 'providing_condition', 'status', 'legal_entity_id'
				]], 'string'],
			['is_active', 'bolean'],
		];
    }
		
}