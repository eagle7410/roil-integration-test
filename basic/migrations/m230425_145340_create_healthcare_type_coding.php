<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_145340_create_healthcare_type_coding
 */
class m230425_145340_create_healthcare_type_coding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_type_coding', [
            'id' => Schema::TYPE_PK,
            'healthcare_type_id' => Schema::TYPE_INTEGER,
            'system' => Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_type_coding');
    }
}
