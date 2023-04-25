<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_152907_create_healthcare_not_available_during
 */
class m230425_152907_create_healthcare_not_available_during extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_not_available_during', [
            'id' => Schema::TYPE_PK,
            'healthcare_not_available_id' => Schema::TYPE_INTEGER,
            'start' => Schema::TYPE_TIMESTAMP . " NOT NULL",
            'end' => Schema::TYPE_TIMESTAMP,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_not_available_during');
    }
}
