<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_144654_create_healthcare_category_coding
 */
class m230425_144654_create_healthcare_category_coding extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_category_coding', [
            'id' => Schema::TYPE_PK,
            'healthcare_category_id' => Schema::TYPE_INTEGER,
            'system' => Schema::TYPE_STRING,
            'code' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_category_coding');
    }
}
