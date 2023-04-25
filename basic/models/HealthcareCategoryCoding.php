<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "healthcare_category_coding".
 *
 * @property int $id
 * @property int|null $healthcare_category_id
 * @property string|null $system
 * @property string|null $code
 */
class HealthcareCategoryCoding extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'healthcare_category_coding';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['healthcare_category_id'], 'integer'],
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
            'healthcare_category_id' => 'Healthcare Category ID',
            'system' => 'System',
            'code' => 'Code',
        ];
    }
}
