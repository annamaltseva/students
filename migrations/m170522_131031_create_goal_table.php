<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goal`.
 */
class m170522_131031_create_goal_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goal', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        $this->insert('goal', [
            'id' => 1,
            'name' => 'Оценка',
        ]);

        $this->insert('goal', [
            'id' => 2,
            'name' => 'Допуск',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goal');
    }
}
