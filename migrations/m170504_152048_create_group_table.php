<?php

use yii\db\Migration;

/**
 * Handles the creation of table `group`.
 * Has foreign keys to the tables:
 *
 * - `user`
 */
class m170504_152048_create_group_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('group', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-group-user_id',
            'group',
            'user_id'
        );

        // add foreign key for table `user`
        $this->addForeignKey(
            'fk-group-user_id',
            'group',
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
        // drops foreign key for table `user`
        $this->dropForeignKey(
            'fk-group-user_id',
            'group'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            'idx-group-user_id',
            'group'
        );

        $this->dropTable('group');
    }
}
