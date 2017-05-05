<?php

use yii\db\Migration;

/**
 * Handles the creation of table `year`.
 */
class m170505_083225_create_year_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('year', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
        $this->insert('year', [
            'name' => '2017',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('year', [
            'name' => '2018',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('year', [
            'name' => '2019',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('year', [
            'name' => '2020',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('year');
    }
}
