<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_144243_create_healthcare_category
 */
class m230425_144243_create_healthcare_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_category', [
            'id' => Schema::TYPE_PK,
            'healthcare_category_id' => Schema::TYPE_INTEGER,
            'text' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_category');
    }
}
