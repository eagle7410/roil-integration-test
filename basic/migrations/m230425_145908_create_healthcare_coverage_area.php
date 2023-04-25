<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m230425_145908_create_healthcare_coverage_area
 */
class m230425_145908_create_healthcare_coverage_area extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('healthcare_coverage_area', [
            'id' => Schema::TYPE_PK,
            'healthcare_id' => Schema::TYPE_INTEGER,
            'value' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('healthcare_coverage_area');
    }
}
