<?php

use yii\db\Migration;

/**
 * Handles the creation of table `competence_level`.
 */
class m170505_080205_create_competence_level_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('competence_level', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'level_value' => $this->integer()->notNull(),
            'order_field' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->insert('competence_level', [
            'name' => '0 - низкий',
            'level_value' => 0,
            'order_field' => 1,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('competence_level', [
            'name' => '3 - пороговый',
            'level_value' => 3,
            'order_field' => 2,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('competence_level', [
            'name' => '4 - средний',
            'level_value' => 4,
            'order_field' => 3,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('competence_level', [
            'name' => '5 - повышенный',
            'level_value' => 5,
            'order_field' => 4,
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('competence_level');
    }
}
