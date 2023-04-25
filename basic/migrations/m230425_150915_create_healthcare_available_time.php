<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_150915_create_healthcare_available_time
 */
class m230425_150915_create_healthcare_available_time extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_available_time', [
            'id' => Schema::TYPE_PK,
            'healthcare_id' => Schema::TYPE_INTEGER,
            'available_start_time' => 'varchar(8)',
            'available_end_time' => 'varchar(8)',
            'days_of_week' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_available_time');
    }
}
