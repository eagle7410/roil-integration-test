<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_category".
 *
 * @property int $id
 * @property int|null $healthcare_category_id
 * @property string|null $text
 */
class HealthcareCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_category';
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

    public function getCoding() {
        return $this->hasMany(HealthcareCategoryCoding::class, ['healthcare_category_id' => 'id']);
    }
}
