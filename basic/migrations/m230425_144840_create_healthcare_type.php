<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_144840_create_healthcare_type
 */
class m230425_144840_create_healthcare_type extends Migration
{
   /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_type', [
            'id' => Schema::TYPE_PK,
            'healthcare_id' => Schema::TYPE_INTEGER,
            'text' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_type');
    }
}
