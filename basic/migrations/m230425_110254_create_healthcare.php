<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_110254_create_healthcare
 */
class m230425_110254_create_healthcare extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare', [
            'id' => Schema::TYPE_PK,
            //data in request
            'division_id' => Schema::TYPE_STRING . ' NOT NULL',
            'speciality_type' => Schema::TYPE_STRING,
            'license_id' => Schema::TYPE_STRING,
            'comment' => Schema::TYPE_STRING,
            'providing_condition' => Schema::TYPE_STRING,
            'status' => Schema::TYPE_STRING,
            'is_active' => Schema::TYPE_BOOLEAN,
            //data adding in responce
            'legal_entity_id' =>  Schema::TYPE_STRING,
            'inserted_at' => Schema::TYPE_TIMESTAMP,
            'inserted_by' => Schema::TYPE_STRING,
            'updated_at'  => Schema::TYPE_TIMESTAMP,
            'updated_by'  => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare');
    }   

}
