<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_152618_create_healthcare_not_available
 */
class m230425_152618_create_healthcare_not_available extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_not_available', [
            'id' => Schema::TYPE_PK,
            'healthcare_id' => Schema::TYPE_INTEGER,
            'description' => Schema::TYPE_STRING,
            'start' => Schema::TYPE_TIMESTAMP . " NOT NULL",
            'end' => Schema::TYPE_TIMESTAMP. " NOT NULL",
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_not_available');
    }
}
