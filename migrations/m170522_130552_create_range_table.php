<?php

use yii\db\Migration;

/**
 * Handles the creation of table `range`.
 * Has foreign keys to the tables:
 *
 * - `control`
 * - `user`
 */
class m170522_130552_create_range_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('range', [
            'id' => $this->primaryKey(),
            'control_id' => $this->integer()->notNull(),
            'rating' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'start_rating' => $this->decimal(6,2)->notNull(),
            'end_rating' => $this->decimal(6,2),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `control_id`
        $this->createIndex(
            'idx-range-control_id',
            'range',
            'control_id'
        );

        // add foreign key for table `control`
        $this->addForeignKey(
            'fk-range-control_id',
            'range',
            'control_id',
            'control',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            'idx-range-user_id',
            'range',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-range-user_id',
            'range',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // drops foreign key for table `control`
        $this->dropForeignKey(
            'fk-range-control_id',
            'range'
        );

        // drops index for column `control_id`
        $this->dropIndex(
            'idx-range-control_id',
            'range'
        );

        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-range-user_id',
            'range'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-range-user_id',
            'range'
        );

        $this->dropTable('range');
    }
}
