<?php

use yii\db\Migration;

class m170531_074614_add_delele_range_relation_from_control_result_table extends Migration
{
    public function up()
    {
        // drops foreign key for table `range`
        $this->dropForeignKey(
            'fk-control_result-range_id',
            'control_result'
        );

    }

    public function down()
    {
        // add foreign key for table `range`
        $this->addForeignKey(
            'fk-control_result-range_id',
            'control_result',
            'range_id',
            'range',
            'id',
            'CASCADE'
        );
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
