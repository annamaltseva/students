<?php

use yii\db\Migration;

/**
 * Handles the creation of table `rating`.
 */
class m170505_093613_create_rating_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('rating', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->insert('rating', [
            'name' => 'Количественный',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
        $this->insert('rating', [
            'name' => 'Качественный',
            'created_at' => strtotime("now"),
            'updated_at' => strtotime("now"),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('rating');
    }
}
